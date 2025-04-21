<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FilesHelper
{
    public function getFileByPath($path)
    {
        return Storage::disk('public')->get($path);
    }

    public function uploadFile($uploadDir, $filename, $file)
    {
        return Storage::disk('public')->putFileAs(
            $uploadDir,
            $file,
            $filename
        );
    }
}
