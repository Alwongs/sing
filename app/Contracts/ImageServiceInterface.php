<?php

namespace App\Contracts;

interface ImageServiceInterface
{
    public function saveInStorage($request): string;
    public function saveAvatarInStorage($request): string;

    public function removeFromStorage(string $request): bool;
    public function removeAvatarFromStorage(string $request): bool;

    public function prepearData(array $data, string $imageName): array;
}
