<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Cargo;

class AreaController extends Controller
{
    
    public function index(){
        
        $data=Area::all();
        return response()->json($data);

    }

    public function store(Request $request){

      $area=new Area;

       $valores=$request->validate([
            'nombre_area'=>'required|unique:areas,nombre_area'   
        ]);

        $area->nombre_area=$valores['nombre_area'];

        $area->save();

       return response()
       ->json(['mensaje' => 'Area agregada correctamente'], 200);


    }


    public function delete($id){
        
        $valor=Area::where('id',$id)->first();

        if(!$valor){

            return response()->json(['mensaje'=>'Id a eliminar no encontrado'],404);
        }

        $valor->delete();

        $aux=$valor['nombre_area'];

      return response()
        ->json(['mensaje'=>'Se elimino correctamente '.$aux],200);

    }



    public function edit(Request $request, $id){

        $area=Area::where('id', $id)->first();


        if(!$area){
        return response()
       ->json(['mensaje' => 'No se pudo modificar el Area'], 404);

        }
        
         $request->validate([
        'nombre_area' => 'required|unique:areas,nombre_area,' . $id
        ]);

        
            $area->nombre_area = $request->nombre_area;
        $area->save();


        return response()
       ->json(['mensaje' => 'Area modificada correctamente'], 201);


        }




}
