<?php

namespace App\Http\Controllers;

use App\Models\Tipocliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoclienteController extends Controller
{

    public function __construct()
    {        
        $this->middleware('auth');
    }

   
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tipocliente = Tipocliente::orderBy('id_tipocliente', 'desc')->paginate(10);
        }
        else{
            $tipocliente = Tipocliente::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_tipocliente', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $tipocliente->total(),
                'current_page' => $tipocliente->currentPage(),
                'per_page'     => $tipocliente->perPage(),
                'last_page'    => $tipocliente->lastPage(),
                'from'         => $tipocliente->firstItem(),
                'to'           => $tipocliente->lastItem(),
            ],
            'tipocliente' => $tipocliente
        ];
        
    }
    public function store(Request $request)
    {
        try {
            $tipocliente = new Tipocliente();
            $tipocliente->nombre_tipocliente = $request->nombre_tipocliente;
            $tipocliente->estado_tipocliente = '1';
            $tipocliente->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Tipo de cliente Guardado Correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error en el servidor'
                
            ]);
        }
    }

  
    
    public function update(Request $request)
    {
        try {
            $tipocliente =  Tipocliente::findOrFail($request->id_tipocliente);
            $tipocliente->nombre_tipocliente = $request->nombre_tipocliente;
            $tipocliente->estado_tipocliente = '1';
            $tipocliente->save();        

            return response()->json([
                'res' => true,
                'message' => 'Tipo de cliente Actualizado Correctamente'
                
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error Server'
                
            ]);
        }
    }

    public function destroyLogic(Request $request){
        try {
            $tipocliente = Tipocliente::findOrFail($request->id_tipocliente);            
            $tipocliente->estado_tipocliente = '0';
            $tipocliente->save();           

            return response()->json([
                'res' => true,
                'message' => 'Tipo de cliente Eliminado'
                
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error Server'
                
            ]);
        }
    }
    public function restoreLogic(Request $request){
        try {
            $tipocliente = Tipocliente::findOrFail($request->id_tipocliente);            
            $tipocliente->estado_tipocliente = '1';
            $tipocliente->save();           

            return response()->json([
                'res' => true,
                'message' => 'Tipo de cliente Restaurado'
                
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error Server'
                
            ]);
        }
    }

   
    public function destroy(Request $request)
    {
        try {
            $tipocliente = Tipocliente::findOrFail($request->id_tipocliente);
            DB::table('clientes')->where('tipocliente_id', $request->id_tipocliente)->delete();  
            $tipocliente->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Tipo de cliente eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tipo de cliente'
                
            ]);
        }
    }
}