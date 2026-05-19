<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class DepartamentoController extends Controller
{
    public function index()
    {
        $mostrar = Departamento::all();

        return $mostrar->count() <= 0 ?
            response()->json(['mensaje' => 'No existen registros de departamentos']) :
            response()->json($mostrar);

    }

    public function store(Request $request)
    {
        $departamento = new Departamento();
        $validar = Validator::make($request->all(), [
            'nombre_departamento' => 'required|in:Informatica,Telecomunicaciones|unique:departamentos,nombre_departamento'
        ]);


        if ($validar->fails()) {

            return response()->json([
                'mensaje' => 'Error al agregar Departamento',
                'error ' => $validar->errors()
            ], 422);

        }

        $departamento->nombre_departamento = $request->nombre_departamento;

        $departamento->save();


        return response()->json([
            'mensaje' => 'Se agrego exitosamente el Departamento',
            'nombre_departamento' => $departamento->nombre_departamento
        ], 201);

    }


    public function edit(Request $request, $id)
    {
        $buscar = Departamento::find($id);

        if ($buscar == null) {
            return response()->json([

                'mensaje' => 'Error al editar Departamento',
                'error' => 'Id a editar no encontrado'
            ], 404);

        }


        $validar = Validator::make($request->all(), [
            'nombre_departamento' => 'sometimes|in:Informatica,Telecomunicaciones|unique:departamentos,nombre_departamento,' . $id
        ]);



        if ($validar->fails()) {

            return response()->json([
                'mensaje' => 'Error al editar Departamento',
                'error' => $validar->errors()
            ], 422);
        }


        if ($request->filled('nombre_departamento')) {
            $buscar->nombre_departamento = $request->nombre_departamento;
        }

        $buscar->save();

        return response()->json([
            'mensaje' => 'Departamento modificado correctamente',
            'data ' => $buscar
        ], 200);

    }


    public function delete($id)
    {
        $eliminar=Departamento::find($id);
        if($eliminar==null){

            return response()->json(['mensaje'=>'Id no encontrado']
            ,404);


        }

        $auxDepartamento=$eliminar->nombre_departamento;
        
        $eliminar->delete();

        return response()->json([
        'mensaje'=>'Departamento eliminado correctamente',
        'data'=>'Valor eliminado '.$auxDepartamento],202);

    }


}
