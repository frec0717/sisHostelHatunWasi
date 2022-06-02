<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egreso;

class EgresoController extends Controller
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
            $egreso = Egreso::with('user')->orderBy('id_egreso', 'desc')->paginate(10);
        }
        else{
            $egreso = Egreso::with('user')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_egreso', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $egreso->total(),
                'current_page' => $egreso->currentPage(),
                'per_page'     => $egreso->perPage(),
                'last_page'    => $egreso->lastPage(),
                'from'         => $egreso->firstItem(),
                'to'           => $egreso->lastItem(),
            ],       
            'egreso' => $egreso
        ];
        
    }
    

   
    public function store(Request $request)
    {
        try {
            $egreso = new Egreso();
            $egreso->id_user = $request->id_user;
            $egreso->fecha_egreso = $request->fecha_egreso;
            $egreso->nombre_egreso   = $request->nombre_egreso;
            $egreso->descripcion_egreso   = $request->descripcion_egreso;
            $egreso->nrecibo_egreso   = $request->nrecibo_egreso;
            $egreso->monto_egreso   = $request->monto_egreso;
            $egreso->estado_egreso = '1';
            $egreso->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Egreso Guardado Correctamente'
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
            $egreso =  Egreso::findOrFail($request->id_egreso);
            $egreso->id_user = $request->id_user;
            $egreso->fecha_egreso = $request->fecha_egreso;
            $egreso->nombre_egreso   = $request->nombre_egreso;
            $egreso->descripcion_egreso   = $request->descripcion_egreso;
            $egreso->nrecibo_egreso   = $request->nrecibo_egreso;
            $egreso->monto_egreso   = $request->monto_egreso;
            $egreso->estado_egreso = '1';
            $egreso->save();        

            return response()->json([
                'res' => true,
                'message' => 'Recordatorio Actualizado Correctamente'
                
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
            $egreso = Egreso::findOrFail($request->id_egreso);            
            $egreso->estado_egreso = '0';
            $egreso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Egreso Eliminado'
                
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
            $egreso = Egreso::findOrFail($request->id_egreso);            
            $egreso->estado_egreso = '1';
            $egreso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Egreso Restaurado'
                
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
            $egreso = Egreso::findOrFail($request->id_egreso);

            $egreso->delete();      
             
                return response()->json([
                    'res' => true,
                    'message' => 'Egreso eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el egreso ',
            ]);
        }
    }
}
