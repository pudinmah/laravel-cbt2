<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UjianController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registter
Route::post('/register',[AuthController::class,'register']);

//login
Route::post('/login',[AuthController::class,'login']);


// logout
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');


// CREATE UJIAN
Route::post('/create-ujian',[UjianController::class,'createUjian'])->middleware('auth:sanctum');

// GET SOAL UJIAN
Route::get('/get-soal-ujian',[UjianController::class,'getListSoalByKategori'])->middleware('auth:sanctum');

// POST JAWABAN
Route::post('/answers',[UjianController::class,'jawabSoal'])->middleware('auth:sanctum');
