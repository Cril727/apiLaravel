<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = Pagos::all();
        return response()->json($pagos, 200);
    }

    public function store(Request $request)
    {
        // $validate = Validator::make($request->all(), [
        //     'valorPago' => 'required|numeric',
        //     'fechaPago' => 'required|date',
        //     'id_prestamo' => 'required|exists:prestamos,id'
        // ]);

        
        $validate = Validator::make($request->all(), [
            'valor_pago' => 'required|numeric',
            'pagado_el'  => 'required|date',
            'id_prestamo' => 'required|exists:prestamos,id'
        ]);


        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $pago = Pagos::create($request->all());
        return response()->json($pago, 201);
    }

    public function show(string $id)
    {
        $pago = Pagos::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago not found'], 404);
        }
        return response()->json($pago, 200);
    }

    public function update(Request $request, string $id)
    {
        $pago = Pagos::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago not found'], 404);
        }

        $validate = Validator::make($request->all(), [
            'valorPago' => 'sometimes|numeric',
            'fechaPago' => 'sometimes|date',
            'id_prestamo' => 'sometimes|required|exists:prestamos,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $pago->update($validate->validated());
        return response()->json($pago, 200);
    }

    public function destroy(string $id)
    {
        $pago = Pagos::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago not found'], 404);
        }

        $pago->delete();
        return response()->json(['message' => 'Pago deleted successfully'], 200);
    }
}
