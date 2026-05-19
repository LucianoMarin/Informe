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

        $validar=Validator::make($request->all(),[
            'nombre_area'=>'required|unique:areas,nombre_area'
        ]);


        if($validar->fails()){

          $error=$validar->errors();

        return response()->json(
                ['mensaje'=>'Error, al ingresar Area',
                 'Error:'=>$error
                 ],402);

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
        
           
      $buscar = Contrato::find($id); 

        if($buscar==null){

            return response()->json(['mensaje'=>'Id a eliminar no encontrado'],404);
        }

        $buscar->delete();

        $aux=$buscar['nombre_area'];

      return response()
        ->json([
             'mensaje'=>'Se elimino correctamente ',
             'nombre_area'=>$aux
        ],200);

    }


    public function edit(Request $request, $id){

        $buscar=Area::find($id);

        
        if($buscar==null){
        return response()->json([
        
            'mensaje'=>'Error al editar Area',
            'error'=>'Id a editar no encontrado'
                ],404);

        }

        $validar=Validator::make($request->all(),[
            'nombre_area' => 'required|unique:areas,nombre_area,' 

        ]);


        
        if($validar->fails()){


            return response()->json([
                'mensaje'=>'Area duplicado'
            ],402);
        }

      
        if ($request->filled('nombre_area')) {
        $buscar->nombre_area = $request->nombre_area;
        
        }
        
        
        $buscar->save();

       

        return response()->json([
        'mensaje'=>'Area modificado correctamente',
        'data '=> $buscar
                ],200);


     
        }


    


}
