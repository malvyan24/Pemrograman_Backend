<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


#membuat route untuk register dan login auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

#membuat route baru untuk student dengan method post
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

#method get
Route::get('/animals', [AnimalController::class, 'index']);

#method post
Route::post('/animals', [AnimalController::class, 'store']);

#method put
Route::put('/animals/{id}', [AnimalController::class, 'update']);

#method delete
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);
