<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
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
            $ingreso = Ingreso::with('user')->orderBy('id_ingreso', 'desc')->paginate(10);
        }
        else{
            $ingreso = Ingreso::with('user')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_ingreso', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ingreso->total(),
                'current_page' => $ingreso->currentPage(),
                'per_page'     => $ingreso->perPage(),
                'last_page'    => $ingreso->lastPage(),
                'from'         => $ingreso->firstItem(),
                'to'           => $ingreso->lastItem(),
            ],       
            'ingreso' => $ingreso
        ];
        
    }

    public function store(Request $request)
    {
        try {
            $ingreso = new Ingreso();
            $ingreso->id_user = $request->id_user;
            $ingreso->fecha_ingreso = $request->fecha_ingreso;
            $ingreso->nombre_ingreso   = $request->nombre_ingreso;
            $ingreso->descripcion_ingreso   = $request->descripcion_ingreso;
            $ingreso->nrecibo_ingreso   = $request->nrecibo_ingreso;
            $ingreso->monto_ingreso   = $request->monto_ingreso;
            $ingreso->estado_ingreso = '1';
            $ingreso->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Ingreso Guardado Correctamente'
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
            $ingreso =  Ingreso::findOrFail($request->id_ingreso);
            $ingreso->id_user = $request->id_user;
            $ingreso->fecha_ingreso = $request->fecha_ingreso;
            $ingreso->nombre_ingreso   = $request->nombre_ingreso;
            $ingreso->descripcion_ingreso   = $request->descripcion_ingreso;
            $ingreso->nrecibo_ingreso   = $request->nrecibo_ingreso;
            $ingreso->monto_ingreso   = $request->monto_ingreso;
            $ingreso->estado_ingreso = '1';
            $ingreso->save();        

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
            $ingreso = Ingreso::findOrFail($request->id_ingreso);            
            $ingreso->estado_ingreso = '0';
            $ingreso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Ingreso Eliminado'
                
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
            $ingreso = Ingreso::findOrFail($request->id_ingreso);            
            $ingreso->estado_ingreso = '1';
            $ingreso->save();           

            return response()->json([
                'res' => true,
                'message' => 'Ingreso Restaurado'
                
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
            $ingreso = Ingreso::findOrFail($request->id_ingreso);

            $ingreso->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Ingreso eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el ingreso'
                
            ]);
        }
    }
}
