<?php

namespace App\Http\Controllers;

use App\Models\Asociado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asociado = Asociado::all();
        return response()->json($asociado);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {

        // Validate the request
        // $validate = Validator::make($request->all(), [
        //     'documento' => 'required|string|unique:asociados,documento',
        //     'nombre' => 'required|string|max:255',
        //     'apellido' => 'required|string|max:255',
        //     'email' => 'required|email|unique:asociados,email',
        //     'telefono' => 'nullable|string|max:15',
        //     'fecha_nacimiento' => 'required|date',
        //     'genero' => 'required|in:M,F'
        // ]);


        $validate = Validator::make($request->all(), [
            'documento' => 'required|string|unique:asociados,documento',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asociados,email',
            'telefono' => 'nullable|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:M,F,O'
        ]);


        // Validate the request
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        // Create the new Asociado
        $asociado = Asociado::create($request->all());
        return response()->json($asociado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asociado = Asociado::find($id);
        if (!$asociado) {
            return response()->json(['message' => 'Asociado not found'], 404);
        }
        return response()->json($asociado);
    }

    /**
     * Update
     */
    public function update(Request $request, string $id)
    {
        $asociado = Asociado::find($id);

        $validate = Validator::make($request->all(), [
            'documento' => 'string|max:255',
            'nombre' => 'string',
            'apellido' => 'string',
            'email' => 'string',
            'telefono' => 'string|max:15',
            'fecha_nacimiento' => 'string',
            'genero' => 'in:M,F'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $asociado->update($validate->validated());
        return response()->json($asociado, 200);
    }


    public function destroy(string $id)
    {
        $asociado = Asociado::find($id);
        if (!$asociado) {
            return response()->json(['message' => 'Asociado not found'], 404);
        }

        $asociado->delete();
        return response()->json(['message' => 'Asociado deleted successfully'], 200);
    }
}
