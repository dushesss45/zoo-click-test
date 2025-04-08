<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/documentation', fn () => view('docs'));
Route::get('/docs/api-docs.json', fn () => response()->file(storage_path('api-docs/api-docs.json')));
