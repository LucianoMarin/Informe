<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    public function index(){
        $mostrar=Departamento::all();

        return $mostrar->count()<=0?
        response()->json(['mensaje'=>'No existen registros de departamentos']):
        response()->json($mostrar);

    }

    public function store(Request $request){
    
    $departamento=new Departamento();

    $validar=Validator::make($request->all(),[
        'nombre_departamento'=>'required|unique:departamentos,nombre_departamento'
    ]);


        if($validar->fails()){
            $error=$validar->errors();
        
            if($error->has('nombre_departamento')){

                return response()->json(
                ['mensaje'=>'Error, al ingresar Departamento',
                 'Error:'=>$error
                 ],402);
            }

        }

        $departamento->nombre_departamento=$request->nombre_departamento;

        $departamento->save();


        return response()->json([
        'mensaje'=>'Se agrego exitosamente el Departamento',
        'nombre_departamento'=>$departamento->nombre_departamento
        ],201);


    }

    public function edit(){}


    public function delete(){}
}
