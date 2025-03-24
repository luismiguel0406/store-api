<?php

namespace App\Http\Controllers;

use App\Models\Factura;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller
{
    public function index()
    {
        try {
            $facturas = Factura::all();
            return response()->json($facturas);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'PedidoId' => 'required|exists:tblPedido,PedidoId',
            'ClienteId' => 'required|exists:tblCliente,ClienteId',
            'nombreArticulo' => 'required|string|max:200',
            'unidadesCompradas' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $factura = Factura::create($request->all());
            return response()->json($factura, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $factura = Factura::findOrFail($id);
            return response()->json($factura);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La factura no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'PedidoId' => 'exists:tblPedido,PedidoId',
            'ClienteId' => 'exists:tblCliente,ClienteId',
            'nombreArticulo' => 'string|max:200',
            'unidadesCompradas' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $factura = Factura::findOrFail($id);
            $factura->update($request->all());
            return response()->json($factura);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La factura no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $factura = Factura::findOrFail($id);
            $factura->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La factura no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
