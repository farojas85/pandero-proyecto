<?php
use App\Http\Controllers\Api\TipoDocumentoController;
use App\Http\Controllers\Api\SexoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){

    //TIPO ACCESOS
    Route::get('tipo-documentos-habilitados',[TipoDocumentoController::class,'habilitados']);
    Route::get('tipo-documentos-eliminados',[TipoDocumentoController::class,'eliminados']);
    Route::get('tipo-documentos-todos',[TipoDocumentoController::class,'todos']);
    Route::get('tipo-documentos-mostrar',[TipoDocumentoController::class,'show']);
    Route::get('tipo-documentos-listar',[TipoDocumentoController::class,'listar']);
    Route::post('tipo-documentos-actualizar',[TipoDocumentoController::class,'update']);
    Route::post('tipo-documentos-eliminar',[TipoDocumentoController::class,'destroy']);
    Route::post('tipo-documentos-eliminar-permanente',[TipoDocumentoController::class,'eliminarPermanente']);
    Route::post('tipo-documentos-restaurar',[TipoDocumentoController::class,'restaurar']);

    //SEXOS
    Route::get('sexos-activos',[SexoController::class,'activos']);
    Route::get('sexos-inactivo',[SexoController::class,'inactivo']);
    Route::get('sexos-todos',[SexoController::class,'todos']);
    Route::get('sexos-mostrar',[SexoController::class,'show']);
    Route::get('sexos-listar',[SexoController::class,'listar']);
    Route::post('sexos-actualizar',[SexoController::class,'update']);
    Route::post('sexos-eliminar',[SexoController::class,'destroy']);
    Route::post('sexos-inhabilitar',[SexoController::class,'inhabilitar']);
    Route::post('sexos-habilitar',[SexoController::class,'habilitar']);

});
