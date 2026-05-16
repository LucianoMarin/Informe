<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;


class CargoController extends Controller
{
    public function index(){

    $mostrar=Cargo::all();

    return response()->json($mostrar);

    }

    public function store(Request $request){

        $cargo=new Cargo;

        $valores=$request->validate([
            'tipo_cargo'=>'required|unique:cargos,tipo_cargo'
        ]);


        $cargo->tipo_cargo=$valores['tipo_cargo'];

        $cargo->save();


        return response()->json(['mensaje'=>'Cargo Agregado'],201);


    }


    public function delete($id){
    $valor=Cargo::where('id',$id)->first();

    if(!$valor){

        return response()->json(['mensaje'=>'Id a eliminar no encontrado'],404);
    }
        $aux=$valor['tipo_cargo'];
        $valor->delete();


        return response()->json(['mensaje'=>'Se elimino '.$aux],200);

    }

    public function edit(Request $request, $id){
        $valor=Cargo::where('id',$id)->first();

        $validar=$request->validate([

            'tipo_cargo'=>'required|unique:cargos,tipo_cargo'
        ]);

        if(!$valor){

            return response()->json(['mensaje'=>'Id no encontrado, no se puede modificar Cargo'],404);

        }

            $valor->tipo_cargo=$validar['tipo_cargo'];

            $valor->save();

            return response()->json(['mensaje'=>'Se modifico correctamente el Cargo'],200);

    }
}
