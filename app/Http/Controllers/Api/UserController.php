<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Persona;

class UserController extends Controller
{
    use UserTrait;
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
    public function store(StoreUserRequest $request)
    {
        //return $request;
        $request->validated();

        $persona = Persona::create([
            'tipo_documento_id' => $request->tipo_documento_id,
            'numero_documento' => $request->numero_documento,
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'sexo_id' => $request->sexo_id,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        // $archivo = $request->file('foto');
        // $nombre_foto = $request->numero_documento.'.'.$archivo->getClientOriginalExtension();

        // if($nombre_foto)
        // {
        //     Storage::disk('profile')->put($nombre_foto,File::get($archivo));
        // }

        $user = User::create([
            'persona_id' => $persona->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($persona->numero_documento),
            //'foto' => $nombre_foto
        ]);

        $usuario = User::find($user->id);

        $usuario->roles()->sync($request->role_id);

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario registrado satisfactoriamente'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
