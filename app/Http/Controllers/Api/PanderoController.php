<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pandero\StorePanderoRequest;
use App\Models\Pandero;
use Illuminate\Http\Request;
use App\Http\Traits\PanderoTrait;

class PanderoController extends Controller
{

    use PanderoTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePanderoRequest $request)
    {
        $request->validated();

        $pandero = new Pandero();
        $pandero->descripcion = $request->descripcion;
        $pandero->monto = $request->monto;
        $pandero->fecha_inicio = $request->fecha_inicio;
        $pandero->es_activo = 1;
        $pandero->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Pandero registrado satisfactoriamente'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pandero  $pandero
     * @return \Illuminate\Http\Response
     */
    public function show(Pandero $pandero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pandero  $pandero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pandero $pandero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pandero  $pandero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pandero $pandero)
    {
        //
    }
}
