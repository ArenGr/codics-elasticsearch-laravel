<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Test Route
Route::get('/users/', function () {
    return response()
        ->json(\App\Models\User::all());
});



//Search Route
Route::post('/search/by-name/', [\App\Http\Controllers\SearchController::class, 'searchByName']);
Route::post('/search/by-surname/', [\App\Http\Controllers\SearchController::class, 'searchBySurname']);
Route::post('/search/by-fullname/', [\App\Http\Controllers\SearchController::class, 'searchByFullname']);

//Filter Route
Route::post('/filter/', [\App\Http\Controllers\FilterController::class, 'filter']);

