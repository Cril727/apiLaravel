<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActividadController extends Controller
{
    public function index(){
        $actividades = Actividad::all();
        return response()->json($actividades, 200);
    }


    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'monto_recaudo' => 'required|numeric',
            'municipio' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $actividad = Actividad::create($request->all());
        return response()->json($actividad, 201);
    }

    public function show(string $id){
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad not found'], 404);
        }
        return response()->json($actividad, 200);
    }

    public function update(Request $request,string $id){
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad not found'], 404);
        }

        $validate = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'fecha' => 'sometimes|required|date',
            'monto_recaudo' => 'sometimes|required|numeric',
            'municipio' => 'sometimes|required|string|max:255'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $actividad->update($validate->validated());
        return response()->json($actividad, 200);
    }

    public function destroy(string $id){
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad not found'], 404);
        }

        $actividad->delete();
        return response()->json(['message' => 'Actividad deleted successfully'], 200);
    }
}
