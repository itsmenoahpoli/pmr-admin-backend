<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilesServerController;

Route::get('/', function () {
    return now();
});

Route::get('/files', [FilesServerController::class, 'getFile'])->name('files-server.get-file');
