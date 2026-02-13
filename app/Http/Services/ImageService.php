<?php

namespace App\Http\Services;

use App\Contracts\ImageServiceInterface;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Auth;

class ImageService implements ImageServiceInterface
{  
    public static function transliterate($string): string
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'i',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'kh',  'ц' => 'tc',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'iu',  'я' => 'ia',
            '’' => '_',   '.' => '_',   ' ' => '_',
            
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'I',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'Kh',  'Ц' => 'Tc',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Shch',
            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Iu',  'Я' => 'Ia',
        );

        return strtolower(strtr($string, $converter));
    }  

    public function saveInStorage($request): string
    {
        $originalsPath = config('images.paths.originals');
        $previewsPath = config('images.paths.previews');

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));

            $extention = $request->file('image')->getClientOriginalExtension();
            $newImageName = now()->format('Ymd_His') . '-' . self::transliterate($request->title) . '.' . $extention;
    
            if (!File::exists(Storage::path($originalsPath))) {
                Storage::makeDirectory($originalsPath);
            }     
    
            if (!File::exists(Storage::path($previewsPath))) {
                Storage::makeDirectory($previewsPath);
            }            
            
            $image->scale(height: 900);
            $image->save(Storage::path($originalsPath) . '/' . $newImageName);
    
            $image->scale(height: 150);
            $image->save(Storage::path($previewsPath) . '/' . $newImageName);

            return $newImageName;
        } else {
            return null;
        }
    }

    public function removeFromStorage($imageName)
    {
        $originalsPath = config('images.paths.originals') . '/' . $imageName;
        $previewsPath = config('images.paths.previews') . '/' . $imageName;       

        if (File::exists(Storage::path($originalsPath))) {
            Storage::delete($originalsPath);
        }
        if (File::exists(Storage::path($previewsPath))) {
            Storage::delete($previewsPath);
        }
    }  

    public function prepearData($data, $newImageName): array
    {
        $data['image_name'] = $newImageName;
        return $data;
    }   
    
    public function findUnusedImages($usedImages)
    {
        $imageDirs = $this->getImageDirs();
        $forgottenFiles = [];
        $forgottenCount = 0;
        foreach ($imageDirs as $imageDir) {
            $allFiles = Storage::disk('public')->files($imageDir['path']);  
            $usedImagesPrepeared = $this->buildFullPath($imageDir, $usedImages);
            $forgottenFilesInDir = array_filter($allFiles, function ($file) use ($usedImagesPrepeared) {
                return !in_array($file, $usedImagesPrepeared);
            });      
            $forgottenFiles[$imageDir['title']] = $forgottenFilesInDir;
            $forgottenCount += count($forgottenFilesInDir);
        }  
        return [$forgottenFiles, $forgottenCount];
    }

    private function buildFullPath($dir, $fileNames)
    {
        $result = [];
        foreach ($fileNames as $fileName) {
            $result[] = $dir['path'] . '/' . $fileName;
        }  
        return $result;
    }    

    private function getImageDirs()
    {
        $imageDirs = [];
        foreach (config('images.paths', []) as $title => $path) {
            if (!empty($path)) {
                $imageDirs[] = [
                    'title' => $title,
                    'path'  => $path
                ];
            }
        }   
        return $imageDirs;   
    }

    public function removeUnusedImages($usedImages)
    {
        list($forgottenFiles, $forgottenCount) = $this->findUnusedImages($usedImages);
        if ($forgottenCount === 0) {
            return [0, 0, 'no_files'];
        }
        $allFilesToDelete = [];
        foreach ($forgottenFiles as $files) {
            foreach ($files as $file) {
                if (Storage::disk('public')->exists($file)) {
                    $allFilesToDelete[] = $file;
                }
            }
        }            
        $deletedCount = 0;
        if (!empty($allFilesToDelete)) {
            $batchSize = 500;
            $chunks = array_chunk($allFilesToDelete, $batchSize);
            foreach ($chunks as $chunk) {
                Storage::disk('public')->delete($chunk);
                $deletedCount += count($chunk);
            }
            \Log::info('Удалены неиспользуемые изображения (пачками)', [
                'count' => $deletedCount,
                'total_found' => $forgottenCount,
                'chunks' => count($chunks),
                'files' => array_slice($allFilesToDelete, 0, 50),
            ]);
        }
        return [$deletedCount, $forgottenCount, 'success'];       
    }
}
