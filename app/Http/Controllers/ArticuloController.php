<?php

namespace App\Http\Controllers;

use App\Models\Articulo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ArticuloController extends Controller
{
    public function index()
    {
        try {
            $articulos = Articulo::all();
            return response()->json($articulos);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigoBarras' => 'required|string|max:200',
            'descripcion' => 'required|string|max:200',
            'nombreFabricante' => 'required|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $articulo = Articulo::create($request->all());
            return response()->json($articulo, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $articulo = Articulo::findOrFail($id);
            return response()->json($articulo);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'codigoBarras' => 'string|max:200',
            'descripcion' => 'string|max:200',
            'nombreFabricante' => 'string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $articulo = Articulo::findOrFail($id);
            $articulo->update($request->all());
            return response()->json($articulo);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $articulo = Articulo::findOrFail($id);
            $articulo->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El artículo no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
