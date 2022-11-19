<?php

use App\Http\Controllers\Api\PanderoController;
use App\Http\Controllers\Api\ParticipanteController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //TIPO ACCESOS
    Route::get('participantes-habilitados',[ParticipanteController::class,'habilitados']);
    Route::get('participantes-eliminados',[ParticipanteController::class,'eliminados']);
    Route::get('participantes-todos',[ParticipanteController::class,'todos']);
    Route::get('participantes-mostrar',[ParticipanteController::class,'show']);
    Route::get('participantes-listar',[ParticipanteController::class,'listar']);
    Route::post('participantes-actualizar',[ParticipanteController::class,'update']);
    Route::post('participantes-eliminar',[ParticipanteController::class,'destroy']);
    Route::post('participantes-eliminar-permanente',[ParticipanteController::class,'eliminarPermanente']);
    Route::post('participantes-restaurar',[ParticipanteController::class,'restaurar']);

    //PANDEROS
    Route::get('panderos-activos',[PanderoController::class,'activos']);
    Route::get('panderos-inactivos',[PanderoController::class,'inactivos']);
    Route::get('panderos-todos',[PanderoController::class,'todos']);
    Route::get('panderos-mostrar',[PanderoController::class,'show']);
    Route::get('panderos-listar',[PanderoController::class,'listar']);
    Route::post('panderos-actualizar',[PanderoController::class,'update']);
    Route::post('panderos-inhabilitar',[PanderoController::class,'inhabilitar']);
    Route::post('panderos-habilitar',[PanderoController::class,'habilitar']);
    //Route::post('panderos-restaurar',[PanderoController::class,'restaurar']);
});
