<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TipoDocumento;
use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;

trait UserTrait
{
    public function habilitados(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;

        return User::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres')
        ->where(function($query) use($buscar) {
            $query->where(DB::Raw("upper(name)"),'like','%'.$buscar.'%')
                ->orWhere(DB::Raw("upper(email)"),'like','%'.$buscar.'%')
                ->orWhereHas('persona',function($q) use($buscar){
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

        return User::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres')
        ->where(function($query) use($buscar) {
            $query->where(DB::Raw("upper(name)"),'like','%'.$buscar.'%')
                ->orWhere(DB::Raw("upper(email)"),'like','%'.$buscar.'%')
                ->orWhereHas('persona',function($q) use($buscar){
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

        return User::with('persona:id,numero_documento,apellido_paterno,apellido_materno,nombres')
        ->where(function($query) use($buscar) {
            $query->where(DB::Raw("upper(name)"),'like','%'.$buscar.'%')
                ->orWhere(DB::Raw("upper(email)"),'like','%'.$buscar.'%')
                ->orWhereHas('persona',function($q) use($buscar){
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
        if($digitos == 8)
        {

            $factory = new DniFactory();
            $cs = $factory->create();

            $persona = $cs->get($request->numero_documento);
            if (!$persona) {
                return null;
            }

            return  json_encode($persona);
        }
        else if($digitos == 11) {

            $factory = new RucFactory();
            $cs = $factory->create();

            $persona = $cs->get($request->numero_documento);

            if (!$persona) {
                return null;
            }

            return json_encode($persona);
        }
    }
}
