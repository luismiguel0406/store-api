<?php

namespace App\Http\Controllers;

use App\Models\PY1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class Py1Controller extends Controller
{
    public function index()
    {
        try {
            $py1s = PY1::all();
            return response()->json($py1s);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contrasena' => 'required|string|max:200',
            'cedula' => 'required|string|max:11|unique:tblPY1',
            'telefono' => 'required|string|max:14',
            'TipoSangreId' => 'required|exists:tblTipoSangre,TipoSangreId',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $py1 = PY1::create($request->all());
            return response()->json($py1, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        try {
            $py1 = PY1::findOrFail($id);
            return response()->json($py1);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El usuario no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'contrasena' => 'string|max:255',
            'cedula' => 'string|max:11|unique:tblPY1,cedula,' . $id,
            'telefono' => 'string|max:14',
            'TipoSangreId' => 'exists:tblTipoSangre,TipoSangreId',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $py1 = PY1::findOrFail($id);
            $py1->update($request->all());
            return response()->json($py1);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El usuario no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $py1 = PY1::findOrFail($id);
            $py1->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El usuario no fue encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
