<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterListController;
use App\Http\Controllers\FavoriteCharacterController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('home');
Route::get('search/name/{name}', [SearchController::class, 'searchByName'])->name('search-by-name');
Route::apiResource('lists', CharacterListController::class);
Route::apiResource('favorites', FavoriteCharacterController::class);



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
