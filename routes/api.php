<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;


Route::get('/', function(){
    return response()->json([
        'sucess' => true
    ]);
});

Route::get('/livros', [LivrosController::class,'index']);
Route::get('/livros/{id}', [LivrosController::class,'show']);
Route::post('/livros', [LivrosController::class,'store']);
Route::delete('/livros/{id}', [LivrosController::class,'destroy']);
Route::put('/livros/{id}', [LivrosController::class, 'update']);
