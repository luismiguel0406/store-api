<?php

namespace App\Http\Controllers;

use App\Models\Colocacion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ColocacionController extends Controller
{
    public function index()
    {
        try {
            $colocaciones = Colocacion::all();
            return response()->json($colocaciones);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $colocacion = Colocacion::create($request->all());
            return response()->json($colocacion, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
        
    }

    public function show($id)
    {
        try {
            $colocacion = Colocacion::findOrFail($id);
            return response()->json($colocacion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La colocación no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $colocacion = Colocacion::findOrFail($id);
            $colocacion->update($request->all());
            return response()->json($colocacion);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La colocación no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $colocacion = Colocacion::findOrFail($id);
            $colocacion->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'La colocación no fue encontrada'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
