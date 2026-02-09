<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Contracts\ImageServiceInterface;

class ImageCleanupController extends Controller
{
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function show()
    {
        $usedImages = Post::whereNotNull('image_name')->pluck('image_name')->toArray();  
        list($forgottenFiles, $forgottenCount) = $this->imageService->findUnusedImages($usedImages);

        return view('admin.settings.file-manage', compact('forgottenFiles', 'forgottenCount'));
    }    

    public function delete(Request $request)
    {
        // $usedImages = Post::whereNotNull('image_name')->pluck('image_name')->toArray();  
        // list($forgottenFiles, $forgottenCount) = $this->imageService->findUnusedImages($usedImages);
        // $deletedCount = 0;        
        // foreach ($forgottenFiles as $dir) {
        //     foreach ($dir as $file) {
        //         Storage::disk('public')->delete($file);
        //         $deletedCount++;
        //     }
        // }
        // return redirect()->route('admin.cleanup.images')
        //     ->with('success', "Успешно удалено {$deletedCount} неиспользуемых изображений.");



        try {
            $usedImages = Post::whereNotNull('image_name')
                ->pluck('image_name')
                ->toArray();

            list($forgottenFiles, $forgottenCount) = $this->imageService->findUnusedImages($usedImages);

            if ($forgottenCount === 0) {
                return redirect()->route('admin.cleanup.images')
                    ->with('info', 'Нет неиспользуемых изображений для удаления.');
            }

            $allFilesToDelete = [];
            foreach ($forgottenFiles as $files) {
                $allFilesToDelete = array_merge($allFilesToDelete, $files);
            }

            if (!empty($allFilesToDelete)) {
                $deletedCount = count($allFilesToDelete);
                Storage::disk('public')->delete($allFilesToDelete);

                \Log::info('Удалены неиспользуемые изображения (массово)', [
                    'count' => $deletedCount,
                    'files' => array_slice($allFilesToDelete, 0, 50),
                ]);
            }

            return redirect()->route('admin.cleanup.images')
                ->with('success', "Успешно удалено {$deletedCount} из {$forgottenCount} неиспользуемых изображений.");

        } catch (\Exception $e) {
            \Log::critical('Критическая ошибка при очистке изображений', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.cleanup.images')
                ->with('error', 'Произошла ошибка при удалении файлов. Администратор уведомлён.');
        }
    }
}
