<?php

namespace App\Http\Controllers;

use App\Models\Clientes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;


class ClienteController extends Controller
{
    public function index(){
        try{
            $clientes =  Clientes::all();
            return response()->json($clientes);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['mensaje'=> 'Error interno'], 500);
        }
    
    }

    public function store(Request $request ){

        $validator =  Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'telefono'=> 'required|string|max:14',
            'TipoClienteId'=>'required|exists:tblTipoCliente, TipoClienteId',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $cliente =  Cliente::create($request->all());
            return response()->json($cliente, 201);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }

    }

    public function update(Request $request ,  $id){

        $validator =  Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'telefono'=> 'required|string|max:14',
            'TipoClienteId'=>'required|exists:tblTipoCliente, TipoClienteId',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
            return response()->json($cliente);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function destroy($id){
       
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El cliente no encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show(Cliente $cliente){

        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json($cliente);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'El cliente no encontrado'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
