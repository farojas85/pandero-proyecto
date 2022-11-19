<?php

namespace App\Http\Traits;

use App\Models\Pandero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait PanderoTrait
{
    public function activos(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Pandero::select('id','descripcion','monto','fecha_inicio','es_activo')
            ->where('es_activo',1)
            ->orWhere(DB::Raw("upper(descripcion)",'like','%'.$buscar.'%'))
            // ->where(function($query) use($buscar){
            // })
            ->paginate($paginacion)
        ;
    }

    public function inactivos(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Pandero::select('id','descripcion','monto','es_activo')
            ->where('es_activo',0)
            ->where(function($query) use($buscar){
                $query->where(DB::Raw("upper(descripcion)",'like','%'.$buscar.'%'));
            })
            ->paginate($paginacion)
        ;
    }

    public function todos(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Pandero::select('id','descripcion','monto','es_activo')
            ->where(function($query) use($buscar){
                $query->where(DB::Raw("upper(descripcion)",'like','%'.$buscar.'%'));
            })
            ->paginate($paginacion)
        ;
    }
}
