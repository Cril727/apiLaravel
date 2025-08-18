<?php

namespace App\Http\Controllers;

use App\Models\Prestamos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestamosController extends Controller
{
    public function index(){
        $prestamos = Prestamos::all();
        return response()->json($prestamos, 200);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'valor' => 'required|numeric',
            'tasaInteres' => 'required|numeric',
            'numeroCuotas' => 'required|integer',
            'fechaPrestamo' => 'required|date',
            'id_asociado' => 'required|exists:asociados,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $prestamo = Prestamos::create($request->all());
        return response()->json($prestamo, 201);
    }

    
    public function show(string $id){
        $prestamo = Prestamos::find($id);
        if (!$prestamo) {
            return response()->json(['message' => 'Prestamo not found'], 404);
        }
        return response()->json($prestamo, 200);
    }


    public function update(Request $request,string $id){
        $prestamo = Prestamos::find($id);
        if (!$prestamo) {
            return response()->json(['message' => 'Prestamo not found'], 404);
        }

        $validate = Validator::make($request->all(), [
            'valor' => 'sometimes|required|numeric',
            'tasaInteres' => 'sometimes|required|numeric',
            'numeroCuotas' => 'sometimes|required|integer',
            'fechaPrestamo' => 'sometimes|required|date',
            'id_asociado' => 'sometimes|required|exists:asociados,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $prestamo->update($request->all());
        return response()->json($prestamo, 200);
    }

    public function destroy($id){
        $prestamo = Prestamos::find($id);
        if (!$prestamo) {
            return response()->json(['message' => 'Prestamo not found'], 404);
        }

        $prestamo->delete();
        return response()->json(['message' => 'Prestamo deleted successfully'], 200);
    }
}
