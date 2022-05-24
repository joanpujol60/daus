<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\JugadorsController;
use App\Http\Controllers\JugadesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user',function (Request $request){
   return $request->user(); 
});    

Route::get('/jugadors',[JugadorsController::class, 'index']);
Route::get('/jugades',[JugadesController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/jugadors/add', [JugadorsController::class, 'store']);//Registrar
Route::put('/jugadors/update/{id}', [JugadorsController::class, 'update']);//Actualizar
Route::post('/jugadors/{id}/jugades', [JugadesController::class, 'store']);//Registrar Jugada
Route::delete('/jugadors/{id}/jugades', [JugadesController::class, 'destroy']);//Eliminar Jugades