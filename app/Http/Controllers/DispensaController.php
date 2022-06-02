<?php

namespace App\Http\Controllers;

use App\Models\Dispensa;
use Illuminate\Http\Request;

class DispensaController extends Controller
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
            $dispensas = Dispensa::with('categoriadispensas')->orderBy('id_dispensa', 'desc')->paginate(10);
        }
        else{
            $dispensas = Dispensa::with('categoriadispensas')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_dispensa', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $dispensas->total(),
                'current_page' => $dispensas->currentPage(),
                'per_page'     => $dispensas->perPage(),
                'last_page'    => $dispensas->lastPage(),
                'from'         => $dispensas->firstItem(),
                'to'           => $dispensas->lastItem(),
            ],       
            'dispensas' => $dispensas
        ];
        
    }
    

   
    public function store(Request $request)
    {
        try {
            $dispensas = new Dispensa();
            $dispensas->categoriadispensa_id = $request->categoriadispensa_id;
            $dispensas->nombre_dispensa = $request->nombre_dispensa;
            $dispensas->cantidad_dispensa   = $request->cantidad_dispensa;
            $dispensas->precioc_dispensa   = $request->precioc_dispensa;
            $dispensas->preciov_dispensa   = $request->preciov_dispensa;
            $dispensas->fechav_dispensa   = $request->fechav_dispensa;
            $dispensas->descripcion_dispensa   = $request->descripcion_dispensa;
            $dispensas->estado_dispensa = '1';
            $dispensas->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Dispensa Guardado Correctamente'
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
            $dispensas =  Dispensa::findOrFail($request->id_dispensa);
            $dispensas->categoriadispensa_id = $request->categoriadispensa_id;
            $dispensas->nombre_dispensa = $request->nombre_dispensa;
            $dispensas->cantidad_dispensa   = $request->cantidad_dispensa;
            $dispensas->precioc_dispensa   = $request->precioc_dispensa;
            $dispensas->preciov_dispensa   = $request->preciov_dispensa;
            $dispensas->fechav_dispensa   = $request->fechav_dispensa;
            $dispensas->descripcion_dispensa   = $request->descripcion_dispensa;
            $dispensas->estado_dispensa = '1';
            $dispensas->save();        

            return response()->json([
                'res' => true,
                'message' => 'Dispensa Actualizado Correctamente'
                
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
            $dispensas = Dispensa::findOrFail($request->id_dispensa);            
            $dispensas->estado_dispensa = '0';
            $dispensas->save();           

            return response()->json([
                'res' => true,
                'message' => 'Dispensa Eliminado'
                
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
            $dispensas = Dispensa::findOrFail($request->id_dispensa);            
            $dispensas->estado_dispensa = '1';
            $dispensas->save();           

            return response()->json([
                'res' => true,
                'message' => 'Dispensa Restaurado'
                
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
            $dispensas = Dispensa::findOrFail($request->id_dispensa);

            $dispensas->delete();  
              
                return response()->json([
                    'res' => true,
                    'message' => 'Dispensa eliminado correctamente'  ,
                    'tours' =>  $dispensas                  
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el dispensas ',
            ]);
        }
    }
}
