<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;


class CargoController extends Controller
{
    public function index(){

    $mostrar=Cargo::all();

    if($mostrar->count()<=0){

        return response()->json(['mensaje'=>'No existen registros de Cargo']);

    }

    return response()->json($mostrar);

    }




    public function store(Request $request){


    try{

        $cargo=new Cargo;


        $validar=Validator::make($request->all(),[

            'tipo_cargo'=>'required|unique:cargos,tipo_cargo'
        ]);
       

        if($validar->fails()){

          $error=$validar->errors();

         return response()->json(
                ['mensaje'=>'Error, al ingresar Cargo',
                 'Error:'=>$error
                 ],402);

        }

        $cargo->tipo_cargo=$request->tipo_cargo;

        $cargo->save();


        return response()->json([
            'mensaje'=>'Cargo Agregado',
            'tipo_cargo'=>$cargo->tipo_cargo
            ],201);


    }catch(QueryException $ex){

        return response()->json([
            'mensaje'=>'Error al agregar Cargo'
            ],500);


    }
    }




    public function delete($id){
    $valor=Cargo::where('id',$id)->first();

    if(!$valor){

        return response()->json([
            'mensaje'=>'Id a eliminar no encontrado'
            ],404);
    }
        $aux=$valor['tipo_cargo'];
        $valor->delete();


        return response()->json([
            'mensaje'=>'Se elimino '.$aux
            ],200);

    }





    public function edit(Request $request, $id){
        $modificar=Cargo::where('id',$id)->first();



        $validar=Validator::make($request->all(),[
            'tipo_cargo'=>'required|unique:cargos,tipo_cargo'
            ]);

            if(!$modificar){

                return response()->json(['mesaje'=>'Id no encontrado'],404);
            }
          

            if($validar->fails()){
                return response()->json(['mensaje'=>'Error al modificar cargo',
                'Errores: '=> $validar->errors()
                ],500);

            }

                !$request->exists('tipo_cargo')?
                $modificar->tipo_cargo:
                $modificar->$request->tipo_cargo;
        

            $valor->tipo_cargo=$request->tipo_cargo;

            $valor->save();

            return response()->json(['mensaje'=>'Se modifico correctamente el Cargo'],200)
            ;
        ;

    }
}
