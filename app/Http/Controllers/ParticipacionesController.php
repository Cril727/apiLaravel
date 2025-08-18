<?php

namespace App\Http\Controllers;

use App\Models\participaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipacionesController extends Controller
{
    public function index(){
        $participaciones = participaciones::all();
        return response()->json($participaciones, 200);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'id_asociado' => 'required|exists:asociados,id',
            'id_actividad' => 'required|exists:actividad,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $participacion = participaciones::create($request->all());
        return response()->json($participacion, 201);
    }

    public function show(string $id){
        $participacion = participaciones::find($id);
        if (!$participacion) {
            return response()->json(['message' => 'Participacion not found'], 404);
        }
        return response()->json($participacion, 200);
    }

    public function update(Request $request,string $id){
        $participacion = participaciones::find($id);
        if (!$participacion) {
            return response()->json(['message' => 'Participacion not found'], 404);
        }

        $validate = Validator::make($request->all(), [
            'id_asociado' => 'sometimes|required|exists:asociados,id',
            'id_actividad' => 'sometimes|required|exists:actividad,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $participacion->update($validate->validated());
        return response()->json($participacion, 200);
    }

    public function destroy(string $id){
        $participacion = participaciones::find($id);
        if (!$participacion) {
            return response()->json(['message' => 'Participacion not found'], 404);
        }

        $participacion->delete();
        return response()->json(['message' => 'Participacion deleted successfully'], 200);
    }
}
