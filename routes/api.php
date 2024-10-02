<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects', [PageController::class, 'allProjects']);
Route::get('/tutte-le-tecnologie', [PageController::class, 'allTechs']);
Route::get('/tutti-i-tipi', [PageController::class, 'allTypes']);
Route::get('/progetto-da-slug/{slug}', [PageController::class, 'projectBySlug']);
Route::get('/progetti-da-tipo/{type}', [PageController::class, 'projectsByType']);
Route::get('/progetti-da-tecnologia/{tech}', [PageController::class, 'projectsByTech']);
