<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('/adm')->name('admin.')->group(function () {
    Route::resource('/documents', Admin\DocumentController::class)
        ->only('index', 'show');

    Route::resource('/users', Admin\UserController::class)
        ->only('index', 'create', 'store', 'show', 'edit', 'update');
});

Route::prefix('/usr')->name('user.')->group(function () {
    Route::resource('/documents', User\DocumentController::class)
        ->only('index', 'create', 'store');

    Route::get('/documents/{document}/download-input', [User\DownloadDocumentController::class, 'input']);
    Route::get('/documents/{document}/download-output', [User\DownloadDocumentController::class, 'output']);
});
