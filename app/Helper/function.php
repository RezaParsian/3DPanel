<?php

use Illuminate\Http\UploadedFile;

/**
 * @param UploadedFile|null $file
 * @param string $path
 * @return string|null
 */
function uploadFile(?UploadedFile $file, string $path = "uploads/"): ?string
{
    if (!$file)
        return null;

    $imageName = uniqid() . "." . $file->getClientOriginalExtension();
    $file->move(public_path($path), $imageName);

    return $path . $imageName;
}