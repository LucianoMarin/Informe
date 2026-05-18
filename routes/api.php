<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DepartamentoController;


/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

*/



/* CRUD AREAS */
Route::get('/areas',[AreaController::class,'index']);
Route::post('/areas',[AreaController::class,'store']);
Route::delete('/areas/{id}',[AreaController::class,'delete']);
Route::patch('/areas/{id}',[AreaController::class,'edit']);


/* CRUD CARGOS */
Route::post('/cargos',[CargoController::class,'store']);
Route::get('/cargos',[CargoController::class,'index']);
Route::delete('/cargos/{id}',[CargoController::class,'delete']);
Route::patch('/cargos/{id}',[CargoController::class,'edit']);

/* CRUD CONTRATOS */
Route::post('/contratos',[ContratoController::class,'store']);
Route::get('/contratos',[ContratoController::class,'index']);
Route::delete('/contratos/{id}',[ContratoController::class,'delete']);
Route::patch('/contratos/{id}',[ContratoController::class,'edit']);

/* CRUD DEPARTAMENTOS */
Route::post('/departamentos',[DepartamentoController::class,'store']);
Route::get('/departamentos',[DepartamentoController::class,'index']);
Route::delete('/departamentos/{id}',[DepartamentoController::class,'delete']);
Route::patch('/departamentos/{id}',[DepartamentoController::class,'edit']);