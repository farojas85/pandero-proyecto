<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Participante\StoreParticipanteRequest;
use App\Http\Traits\ParticipanteTrait;
use App\Models\Participante;
use App\Models\Persona;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    use ParticipanteTrait;
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
    public function store(StoreParticipanteRequest $request)
    {
        $request->validated();

        $persona = new Persona();
        $persona->tipo_documento_id = $request->tipo_documento_id;
        $persona->numero_documento = $request->numero_documento;
        $persona->nombres = $request->nombres;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->sexo_id = $request->sexo_id;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->save();

        $participante = Participante::create([
            'persona_id' => $persona->id
        ]);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Participante registrado satisfactoriamente'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Participante::with('persona')->where('id', $request->id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participante $participante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participante  $participante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participante $participante)
    {
        //
    }
}
