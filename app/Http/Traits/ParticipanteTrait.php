<?php
namespace App\Http\Traits;

use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TipoDocumento;
use App\Models\Persona;
use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;


trait ParticipanteTrait
{
    public function habilitados(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Participante::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres,telefono')
        ->where(function($query) use($buscar) {
            $query->whereHas('persona',function($q) use($buscar){
                    $q->where(DB::Raw('upper(numero_documento)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(concat(apellido_paterno,' ',apellido_materno))")
                                ,'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(nombres)")
                                ,'like','%'.$buscar.'%');
                });
        })->paginate($paginacion)
        ;
    }

    public function eliminados(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Participante::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres,telefono')
        ->where(function($query) use($buscar) {
            $query->whereHas('persona',function($q) use($buscar){
                    $q->where(DB::Raw('upper(numero_documento)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(concat(apellido_paterno,' ',apellido_materno))")
                                ,'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(nombres)")
                                ,'like','%'.$buscar.'%');
                });
        })
        ->onlyTrashed()
        ->paginate($paginacion)
        ;
    }
    public function todos(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return Participante::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres,telefono')
        ->where(function($query) use($buscar) {
            $query->whereHas('persona',function($q) use($buscar){
                    $q->where(DB::Raw('upper(numero_documento)'),'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(concat(apellido_paterno,' ',apellido_materno))")
                                ,'like','%'.$buscar.'%')
                    ->orWhere(DB::Raw("upper(nombres)")
                                ,'like','%'.$buscar.'%');
                });
        })
        ->withTrashed()
        ->paginate($paginacion)
        ;
    }

    public function verificarNumeroDocumento(Request $request)
    {
        //VALIDAMOS EL TIPO DE DOCUMENTO
        $regla = [ 'tipo_documento_id' => 'required'];
        $mensaje = [ 'required' => '* Dato Obligatorio'];

        $this->validate($request,$regla,$mensaje);

        //VALIDAMOS EL NUMERO DE DOCUMENTO POR LONGITUD
        $tipoDocumento = TipoDocumento::select('longitud')
                                    ->where('id',$request->tipo_documento_id)->first();
        $digitos =$tipoDocumento->longitud;

        $regla = [
            'tipo_documento_id' => 'required',
            'numero_documento' => 'digits:'.$digitos
        ];
        $mensaje = [ 'required' => '* Dato Obligatorio',
                    'digits' => 'Ingrese '.$digitos.' dígitos'];
        $this->validate($request,$regla,$mensaje);

        $persona = null;

        $persona = Persona::select(
            'tipo_documento_id','numero_documento', 'nombres', 'apellido_paterno',
            'apellido_materno', 'sexo_id', 'telefono', 'direccion'
        )->where('dni', $request->numero_documento)
        ->first();

        if($persona)
        {
            $persona['tipo'] = 0;
        }

        if(!$persona)
        {
            if($digitos == 8)
            {
                $factory = new DniFactory();
                $cs = $factory->create();

                $persona = $cs->get($request->numero_documento);

                if(!$persona) {
                    return null;
                }
                if($persona)
                {
                    $persona->tipo = 1;
                }

                $persona =  json_encode($persona);

            }
            else if($digitos == 11) {

                $factory = new RucFactory();
                $cs = $factory->create();

                $persona = $cs->get($request->numero_documento);

                if(!$persona) {
                    return null;
                }

                if($persona)
                {
                    $persona->tipo = 2;
                }

                $persona = json_encode($persona);

            }
        }

        return $persona;
    }
}
