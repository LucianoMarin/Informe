<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ContratoController extends Controller
{
    public function index(){
        $mostrar=Contrato::all();

        if($mostrar->count()<=0){

        return response()->json(['mensaje'=>'No existen registros de contratos']);

        }

        return response()->json($mostrar);


    }


    public function store(Request $request){



    $contrato=new Contrato;

    $validar=Validator::make($request->all(),[
        'nombre_contrato'=>'required',
        
        Rule::unique('contratos')->where(function ($query) use ($request) {
            return $query->where('grado', $request->grado);
        }),
        
        'grado'=>'nullable'
    ]);


        if($validar->fails()){

        $error=$validar->errors();
  

            if($error->has('nombre_contrato')){

            
          return response()->json(
                ['mensaje'=>'Error, al ingresar Nombre Contrato',
                 'Error:'=>$error
                 ],402);

            }

            if($error->has('grado')){   


             return response()->json(
                ['mensaje'=>'Error, al ingresar Grado',
                 'Error:'=>$error
                 ],402);

            }
        }


        $contrato->nombre_contrato=str::upper($request->nombre_contrato);
        $contrato->grado=str::upper($request->grado);

        $contrato->save();

        return response()->json($contrato); 

    
    }


    public function edit(Request $request, $id){
        
        $modificar=Contrato::where('id',$id)->first();
        

        if(!$modificar){

            return response()->json(['mensaje'=>'Id no encontrado, no se modifico el contrato'],404);
        }

        $validar=Validator::make($request->all(),
            [
            'nombre_contrato'=>'required',
        
            Rule::unique('contratos')->where(function ($query) use ($request) {
            return $query->where('grado', $request->grado);
        }),

        'grado'=>'nullable'
        
        ]);



         if($validar->fails()){

        $error=$validar->errors();
  

            if($error->has('nombre_contrato')){

                return response()->json([
                    'mensaje'=>'Error al agregar nombre_contrato'
                ],422);

            }

            if($error->has('grado')){


                 return response()->json([
                    'mensaje'=>'Error al agregar grado'
                ],422);

            }
        }
  

        $auxContrato=$modificar->nombre_contrato;
        $auxGrado=$modificar->grado;

        !$request->exists('nombre_contrato')?
        $modificar->nombre_contrato=str::upper($auxContrato):
        $modificar->nombre_contrato=str::upper($request->nombre_contrato);


        !$request->exists('grado')?$modificar->grado=str::upper($auxGrado)
        :$modificar->grado=str::upper($request->grado);


        $modificar->save();

        return response()
        ->json(['mensaje'=>'Se cambio la informacion de Contrato ',
            'Nombre contrato'=>'Se cambio: '.$auxContrato.' Por: '.$modificar->nombre_contrato,
            'Grado'=>'Se cambio: '.$auxGrado.' Por: '.$modificar->grado,
        ],200);

    }


    public function delete($id){
    
        $buscar=Contrato::where('id',$id)->first();
        
        if(!$buscar){

            return response()->json([
                'mensaje'=>'No se encontro contrato para eliminar, id incorrecto'
                ],404);

        }

             $auxContrato=$buscar['nombre_contrato'];
             $auxGrado=$buscar['grado'];
             $buscar->delete();

        return response()->json([
            'mensaje'=>'Se elimino Contrato',
            'nombre_contrato: '=>$auxContrato,
            'grado: '=>$auxGrado
            ],200);
    

    }
}
