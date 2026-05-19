<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;


class CargoController extends Controller
{
    public function index()
    {

        $mostrar = Cargo::all();

        if ($mostrar->count() <= 0) {

            return response()->json(['mensaje' => 'No existen registros de Cargo']);
        }

        return response()->json($mostrar);
    }


    public function store(Request $request)
    {


        try {

            $cargo = new Cargo;


            $validar = Validator::make($request->all(), [

                'tipo_cargo' => 'required|unique:cargos,tipo_cargo'
            ]);


            if ($validar->fails()) {

                $error = $validar->errors();

                return response()->json(
                    [
                        'mensaje' => 'Error, al ingresar Cargo',
                        'Error:' => $error
                    ],
                    402
                );
            }

            $cargo->tipo_cargo = $request->tipo_cargo;

            $cargo->save();


            return response()->json([
                'mensaje' => 'Cargo Agregado',
                'tipo_cargo' => $cargo->tipo_cargo
            ], 201);
        } catch (QueryException $ex) {

            return response()->json([
                'mensaje' => 'Error al agregar Cargo'
            ], 500);
        }
    }


    public function delete($id)
    {

        $valor = Cargo::find($id);

        if ($valor == null) {

            return response()->json([
                'mensaje' => 'Id a eliminar no encontrado'
            ], 404);
        }
        
        $aux = $valor['tipo_cargo'];
        
        $valor->delete();


        return response()->json([
            'mensaje' => 'Se elimino ' . $aux
        ], 200);
    }



    public function edit(Request $request, $id)
    {
        $buscar = Cargo::find($id);

        if ($buscar == null) {
            return response()->json([

                'mensaje' => 'Error al editar Cargo',
                'error' => 'Id a editar no encontrado'
            ], 404);
        }

        $validar = Validator::make($request->all(), [
            'tipo_cargo' => 'required|unique:cargos,tipo_cargo'
        ]);


        if ($validar->fails()) {


            return response()->json([
                'mensaje' => 'Cargo duplicado'
            ], 402);
        }


        if ($request->filled('tipo_cargo')) {
            $buscar->tipo_cargo = $request->tipo_cargo;
        }

        $buscar->save();

        return response()->json([
            'mensaje' => 'Cargo modificado correctamente',
            'data ' => $buscar
        ], 200);;;
    }
}
