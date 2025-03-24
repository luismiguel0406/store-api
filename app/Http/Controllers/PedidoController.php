<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function index()
    {
        try {
            $pedidos = Pedido::all();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ClienteId' => 'required|exists:tblCliente,ClienteId',
            'ArticuloColocacionId' => 'required|exists:tblArticuloColocacion,ArticuloColocacionId',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $pedido = Pedido::create($request->all());
            return response()->json($pedido, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            return response()->json($pedido);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El pedido no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ClienteId' => 'exists:tblCliente,ClienteId',
            'ArticuloColocacionId' => 'exists:tblArticuloColocacion,ArticuloColocacionId',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $pedido = Pedido::findOrFail($id);
            $pedido->update($request->all());
            return response()->json($pedido);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El pedido no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            $pedido->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El pedido no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
