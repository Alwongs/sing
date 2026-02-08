<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class ImageCleanupController extends Controller
{
    public function show()
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

        $forgottenFiles = [];
        $forgottenCount = 0;
        foreach ($imageDirs as $imageDir) {

            $allFiles = Storage::disk('public')->files($imageDir['path']); // from Storage

            $usedImages = Post::whereNotNull('image_name') // from DB
                ->pluck('image_name')
                ->toArray();      

            $usedImagesPrepeared = $this->buildFullPath($imageDir, $usedImages);

            $forgottenFilesInDir = array_filter($allFiles, function ($file) use ($usedImagesPrepeared) {
                return !in_array($file, $usedImagesPrepeared);
            });      

            $forgottenFiles[$imageDir['title']] = $forgottenFilesInDir;

                    // dd($forgottenFiles);

            $forgottenCount += count($forgottenFilesInDir);
        }

        // dd($forgottenFiles);

        return view('admin.settings.file-manage', compact('forgottenFiles', 'forgottenCount'));
    }

    private function buildFullPath($dir, $fileNames)
    {
        $result = [];
        foreach ($fileNames as $file_name) {
            $usedImagesPrepeared[] = $dir . '/' . $file_name;
        }  
        return $result;
    }

    

    public function delete(Request $request)
    {
        $imageDirectory = config('images.paths.originals');

        $allFiles = Storage::disk('public')->files($imageDirectory);
        $usedImages = Post::whereNotNull('image_name')->pluck('image_name')->toArray();

        $orphanedFiles = array_filter($allFiles, function ($file) use ($usedImages) {
            return !in_array($file, $usedImages);
        });

        $deletedCount = 0;
        foreach ($orphanedFiles as $file) {
            Storage::disk('public')->delete($file);
            $deletedCount++;
        }

        return redirect()->route('admin.cleanup.images')
            ->with('success', "Успешно удалено {$deletedCount} неиспользуемых изображений.");
    }
}
