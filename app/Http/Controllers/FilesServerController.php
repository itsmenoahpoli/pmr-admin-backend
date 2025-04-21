<?php

namespace App\Http\Controllers;

use App\Traits\FilesHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilesServerController extends Controller
{
    use FilesHelper;

    public function getFile(Request $request)
    {
        $path = $request->query('path');
        $file = $this->getFileByPath($path);

        return response($file, Response::HTTP_OK)->header('Content-Type', 'image/jpeg');
    }
}
