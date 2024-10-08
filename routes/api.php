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
Route::get('/technologies', [PageController::class, 'allTechs']);
Route::get('/types', [PageController::class, 'allTypes']);
Route::get('/project/{slug}', [PageController::class, 'projectBySlug']);
Route::get('/projects-by-type/{slug}', [PageController::class, 'projectsByType']);
Route::get('/projects-by-tech/{slug}', [PageController::class, 'projectsByTech']);
