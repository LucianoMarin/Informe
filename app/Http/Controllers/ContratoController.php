<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ContratoController extends Controller
{
    public function index(){
        $mostrar=Contrato::all();

        return response()->json($mostrar);


    }


    public function store(Request $request){
    
    $contrato=new Contrato;

    $valores=$request->validate([
        'nombre_contrato'=>'required',
        
           Rule::unique('contratos')->where(function ($query) use ($request) {
            return $query->where('grado', $request->grado);
        }),
        'grado'=>'nullable'
        ]);

        $contrato->nombre_contrato=str::upper($valores['nombre_contrato']);
        $contrato->grado=str::upper($request->grado);

        $contrato->save();

    return response()->json($contrato); 
    
    }


    public function edit(Request $request, $id){
        
        $modificar=Contrato::where('id',$id)->first();
        

        if(!$modificar){

            return response()->json(['mensaje'=>'Id no encontrado, no se modifico el contrato'],404);
        }

        $validado=$request->validate([
       'nombre_contrato'=>'required',
        
           Rule::unique('contratos')->where(function ($query) use ($request) {
            return $query->where('grado', $request->grado);
        }),
        'grado'=>'nullable'

        ]);


        $aux=$modificar->nombre_contrato;
        $auxGrado=$modificar->grado;

        !$request->exists('nombre_contrato')?$modificar->nombre_contrato=str::upper($aux)
        :$modificar->nombre_contrato=str::upper($validado['nombre_contrato']);


        !$request->exists('grado')?$modificar->grado=str::upper($auxGrado)
        :$modificar->grado=str::upper($request->grado);



        $modificar->save();

        return response()
        ->json(['mensaje'=>'Se cambio la informacion de Contrato ',
            'Nombre contrato'=>'Se cambio: '.$aux.' Por: '.$modificar->nombre_contrato,
            'Grado'=>'Se cambio: '.$auxGrado.' Por: '.$modificar->grado,
        ],200);

    }


    public function delete(){

    }
}
