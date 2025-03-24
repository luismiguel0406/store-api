<?php

namespace App\Http\Controllers;

use App\Models\TipoSangre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TipoSangreController extends Controller
{
    public function index()
    {
        try {
            $tipoSangres = TipoSangre::all();
            return response()->json($tipoSangres);
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
            $tipoSangre = TipoSangre::create($request->all());
            return response()->json($tipoSangre, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $tipoSangre = TipoSangre::findOrFail($id);
            return response()->json($tipoSangre);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El tipo de sangre no fue encontrado'], 404);
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
            $tipoSangre = TipoSangre::findOrFail($id);
            $tipoSangre->update($request->all());
            return response()->json($tipoSangre);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El tipo de sangre no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tipoSangre = TipoSangre::findOrFail($id);
            $tipoSangre->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El tipo de sangre no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
