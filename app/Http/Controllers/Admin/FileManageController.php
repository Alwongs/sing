<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Contracts\ImageServiceInterface;

class FileManageController extends Controller
{
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $usedImages = array_merge(
            Post::whereNotNull('image_name')->pluck('image_name')->toArray(), 
            User::whereNotNull('image_name')->pluck('image_name')->toArray()             
        );     

        list($forgottenFiles, $forgottenCount) = $this->imageService->findUnusedImages($usedImages);

        return view('admin.settings.file-manage', compact('forgottenFiles', 'forgottenCount'));
    }    

    public function deleteUnusedImages(Request $request)
    {
        try {
            $usedImages = Post::whereNotNull('image_name')
                ->pluck('image_name')
                ->toArray();

            list($deletedCount, $forgottenCount, $status) = $this->imageService->removeUnusedImages($usedImages);

            if ($status === 'no_files') {
                return redirect()->route('admin.settings.file-manage')
                    ->with('info', 'Нет неиспользуемых изображений для удаления.');
            }

            return redirect()->route('admin.settings.file-manage')
                ->with('success', "Успешно удалено {$deletedCount} из {$forgottenCount} неиспользуемых изображений.");             

        } catch (\Exception $e) {
            \Log::critical('Критическая ошибка при очистке изображений', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.settings.file-manage')
                ->with('error', 'Произошла ошибка при удалении файлов. Администратор уведомлён.');
        }
    }
}
