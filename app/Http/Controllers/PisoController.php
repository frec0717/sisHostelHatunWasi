<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PisoController extends Controller
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
            $piso = Piso::orderBy('id_piso', 'asc')->paginate(10);
        }
        else{
            $piso = Piso::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_piso', 'asc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $piso->total(),
                'current_page' => $piso->currentPage(),
                'per_page'     => $piso->perPage(),
                'last_page'    => $piso->lastPage(),
                'from'         => $piso->firstItem(),
                'to'           => $piso->lastItem(),
            ],
            'piso' => $piso
        ];
        
    }

    

    public function store(Request $request)
    {
        try {
            $piso = new Piso();
            $piso->numero_piso = $request->numero_piso;
            $piso->estado_piso = '1';
            $piso->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Piso Guardado Correctamente'
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
            $piso =  Piso::findOrFail($request->id_piso);
            $piso->numero_piso = $request->numero_piso;
            $piso->estado_piso = '1';
            $piso->save();        

            return response()->json([
                'res' => true,
                'message' => 'Piso Actualizado Correctamente'
                
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
            $piso = Piso::findOrFail($request->id_piso);            
            $piso->estado_piso = '0';
            $piso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Piso Eliminado'
                
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
            $piso = Piso::findOrFail($request->id_piso);            
            $piso->estado_piso = '1';
            $piso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Piso Restaurado'
                
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
            $piso = Piso::findOrFail($request->id_piso);
            DB::table('habitaciones')->where('piso_id', $request->id_piso)->delete(); 

            $piso->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Piso eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el piso'
                
            ]);
        }
    }
}
