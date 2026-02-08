<?php

namespace App\Contracts;

interface ImageServiceInterface
{
    public function saveInStorage($request): string;
    public function prepearData(array $data, string $imageName): array;
}
