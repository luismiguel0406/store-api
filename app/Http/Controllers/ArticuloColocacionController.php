<?php

namespace App\Http\Controllers;

use App\Models\ArticuloColocacion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ArticuloColocacionController extends Controller
{
    public function index()
    {
        try {
            $articuloColocaciones = ArticuloColocacion::all();
            return response()->json($articuloColocaciones);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ArticuloId' => 'required|exists:tblArticulo,ArticuloId',
            'ColocacionId' => 'required|exists:tblColocacion,ColocacionId',
            'nombreArticulo' => 'required|string|max:200',
            'precioArticulo' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $articuloColocacion = ArticuloColocacion::create($request->all());
            return response()->json($articuloColocacion, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $articuloColocacion = ArticuloColocacion::findOrFail($id);
            return response()->json($articuloColocacion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo colocación no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ArticuloId' => 'exists:tblArticulo,ArticuloId',
            'ColocacionId' => 'exists:tblColocacion,ColocacionId',
            'nombreArticulo' => 'string|max:200',
            'precioArticulo' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $articuloColocacion = ArticuloColocacion::findOrFail($id);
            $articuloColocacion->update($request->all());
            return response()->json($articuloColocacion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo colocación no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $articuloColocacion = ArticuloColocacion::findOrFail($id);
            $articuloColocacion->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo colocación no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno del servidor'], 500);
        }
    }
}
