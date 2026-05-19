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
    public function index()
    {
        $mostrar = Contrato::all();

        if ($mostrar->count() <= 0) {

            return response()->json(['mensaje' => 'No existen registros de contratos']);
        }

        return response()->json($mostrar);
    }

    


    public function store(Request $request)
    {



        $contrato = new Contrato;

        $validar = Validator::make($request->all(), [
            'nombre_contrato' => [
                'required',
                Rule::unique('contratos')->where(function ($query) use ($request) {
                    return $query->where('grado', $request->grado);
                }),
            ],
            'grado' => 'nullable'
        ]);


        if ($validar->fails()) {


            return response()->json([
                'mensaje' => 'Error al editar Contrato',
                'error' => $validar->errors()
            ], 422);
        }



        $contrato->nombre_contrato = Str::upper($request->nombre_contrato);
        $contrato->grado = Str::upper($request->grado);



        $contrato->save();

        return response()->json([
            'mensaje' => 'Contrato agregado correctamente',
            'contrado: ' => $contrato
        ]);
    }


    public function edit(Request $request, $id)
    {

        $buscar = Contrato::find($id);


        if ($buscar == null) {

            return response()->json([

                'mensaje' => 'Error al editar Contrato',
                'error' => 'Id a editar no encontrado'
            ], 404);
        }


        $validar = Validator::make($request->all(), [
            'nombre_contrato' => [
                'sometimes|required',
                Rule::unique('contratos')->where(function ($query) use ($request) {
                    return $query->where('grado', $request->grado);
                }),
            ],
            'grado' => 'nullable'
        ]);

        if ($validar->fails()) {


            return response()->json([
                'mensaje' => 'Error al editar Contrato',
                'error' => $validar->errors()
            ], 422);
        }



        if ($request->filled('nombre_contrato')) {

            $buscar->nombre_contrato = Str::upper($request->nombre_contrato);
        }


        if ($request->has('grado')) {

            $buscar->grado = Str::upper($request->grado);
        }



        $buscar->save();


        return response()->json([
            'mensaje' => 'Contrato modificado correctamente',
            'data' => $buscar
        ], 200);
    }

    
    public function delete($id)
    {

        $buscar = Contrato::find($id);

        if ($buscar == null) {

            return response()->json([
                'mensaje' => 'No se encontro contrato para eliminar, id incorrecto'
            ], 404);
        }

        $auxContrato = $buscar['nombre_contrato'];
        $auxGrado = $buscar['grado'];
        $buscar->delete();

        return response()->json([
            'mensaje' => 'Se elimino Contrato',
            'nombre_contrato: ' => $auxContrato,
            'grado: ' => $auxGrado
        ], 200);
    }
}
