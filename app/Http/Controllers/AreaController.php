<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Area;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    
    public function index(){
        
        $mostrar=Area::all();

        if($mostrar->count()<=0){

        return response()->json(['mensaje'=>'No existen registros de Area']);

        }

        return response()->json($mostrar);

        
    }



    public function store(Request $request){


    try{


        $area=new Area;

        $validador=Validator::make($request->all(),[
            'nombre_area'=>'required|unique:areas,nombre_area'
        ]);


        if($validador->fails()){

        return response()->json([
            'mensaje'=>'El area ya existe',
            'errores'=>$validador->errors()],422);
        }


        $area->nombre_area=$request->nombre_area;

        $area->save();

       return response()
       ->json([
            'mensaje' => 'Area agregada correctamente',
            'nombre_area'=> $area->nombre_area
             ], 200);

    }catch(QueryException $e){

          return response()
       ->json([
           'mensaje' => 'Imposible agregar el Area, los valores estan parametrisados',
        ], 500);

    }


    }




    public function delete($id){
        
        $valor=Area::where('id',$id)->first();

        if(!$valor){

            return response()->json(['mensaje'=>'Id a eliminar no encontrado'],404);
        }

        $valor->delete();

        $aux=$valor['nombre_area'];

      return response()
        ->json([
             'mensaje'=>'Se elimino correctamente ',
             'nombre_area'=>$aux
        ],200);

    }





    public function edit(Request $request, $id){
    
    try{

        $modificar=Area::where('id', $id)->first();


        if(!$modificar){
            
        return response()
       ->json(['mensaje' => 'No se encontro el id a modificar'], 404);

        }

        $validar=Validator::make($request->all(),[
            'nombre_area' => 'required|unique:areas,nombre_area,' 

        ]);


        

        if($validar->fails()){


            return response()->json([
                'mensaje'=>'Area duplicado'
            ],402);
        }

        $auxNombreArea=$modificar->nombre_area;

        !$request->exists('nombre_area')?
        $modificar->nombre_area=$modificar->nombre_area:
        $modificar->nombre_area=$request->nombre_area;

    
        $modificar->save();
        

        return response()
       ->json([
        'mensaje' => 'Area modificada correctamente',
        'nombre_area'=>'Se cambio area: '.$auxNombreArea." Por: ".$request->nombre_area
       ], 201);


     
        }

  catch(QueryException $ex){

       return response()
       ->json([
           'mensaje' => 'Imposible agregar el Area, los valores estan parametrisados',
        ], 500);

  }

    }


}
