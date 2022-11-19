<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SexoController;
use App\Http\Controllers\Api\TipoAccesoController;
use App\Http\Controllers\Api\TipoDocumentoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::post('logout',[LoginController::class,'logout']);
    Route::apiResource('tipo-accesos',TipoAccesoController::class);
    Route::apiResource('roles',RoleController::class);
    Route::apiResource('usuarios',UserController::class);
    Route::apiResource('menus',MenuController::class);
    Route::apiResource('tipo-documentos',TipoDocumentoController::class);
    Route::apiResource('sexos',SexoController::class);

    require __DIR__.'/rutaSistema.php';
    require __DIR__.'/rutaConfiguraciones.php';
});
