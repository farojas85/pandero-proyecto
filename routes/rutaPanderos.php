<?php

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
});
