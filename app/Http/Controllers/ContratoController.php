<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use Illuminate\Validation\Rule;

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

        $contrato->nombre_contrato=$valores['nombre_contrato'];
        $contrato->grado=$request->grado;

        $contrato->save();

    return response()->json($contrato); 
    
    }


    public function edit(){}


    public function delete(){

    }
}
