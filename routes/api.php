<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// NAZAIRE SALOMON SAGNA 03 SEPTEMBRE
// ROUTES POUR L'AUTHENTIFICATION

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// CETTE ROUTE EST PROTEGEE CAR POUR SE DECONNECTER FAUT AVOIR UN TOKEN DE CONNEXION D'ABORD
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// ROUTE POUR AJOUT EQUIPEMENTS
Route::apiResource('equipements', EquipementController::class);

