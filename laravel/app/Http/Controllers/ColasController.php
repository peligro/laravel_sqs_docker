<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EjemploJob;
use App\Models\Ejemplo;
class ColasController extends Controller
{
    public function colas_index()
    {
        $datos=Ejemplo::orderBy('id', 'desc')->get();
        return view("colas.index")->with(['datos'=>$datos]);
    }
    public function colas_enviar()
    {
        return view("colas.enviar");
    }
    public function colas_enviar_post(Request $request)
    {
        $validate = $request->validate(
            [
                'mensaje'=>'required|min:6',
            ],
            [
                'mensaje.required'=>'El campo mensaje está vacío',
                'mensaje.min'=>'El campo mensaje debe tener al menos 6 caracteres'
            ]);
            EjemploJob::dispatch($request->mensaje); 
            
            return redirect()->route('colas_enviar')->with(['css'=>'success', 'mensaje'=>'Se creó el registro exitosamente']);
    }
}
