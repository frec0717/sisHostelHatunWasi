<?php

namespace App\Http\Controllers;

use App\Models\Formapago;
use Illuminate\Http\Request;

class FormapagoController extends Controller
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
            $formapago = Formapago::orderBy('id_formapago', 'desc')->paginate(10);
        }
        else{
            $formapago = Formapago::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_formapago', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $formapago->total(),
                'current_page' => $formapago->currentPage(),
                'per_page'     => $formapago->perPage(),
                'last_page'    => $formapago->lastPage(),
                'from'         => $formapago->firstItem(),
                'to'           => $formapago->lastItem(),
            ],
            'formapago' => $formapago
        ];
        
    }
    public function store(Request $request)
    {
        try {
            $formapago = new Formapago();
            $formapago->nombre_formapago = $request->nombre_formapago;
            $formapago->estado_formapago = '1';
            $formapago->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Forma de pago Guardado Correctamente'
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
            $formapago =  Formapago::findOrFail($request->id_formapago);
            $formapago->nombre_formapago = $request->nombre_formapago;
            $formapago->estado_formapago = '1';
            $formapago->save();        

            return response()->json([
                'res' => true,
                'message' => 'Forma pago Actualizado Correctamente'
                
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
            $formapago = Formapago::findOrFail($request->id_formapago);            
            $formapago->estado_formapago = '0';
            $formapago->save();           

            return response()->json([
                'res' => true,
                'message' => 'Forma pago Eliminado'
                
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
            $formapago = Formapago::findOrFail($request->id_formapago);            
            $formapago->estado_formapago = '1';
            $formapago->save();           

            return response()->json([
                'res' => true,
                'message' => 'Forma pago Restaurado'
                
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
            $formapago = Formapago::findOrFail($request->id_formapago);

            $formapago->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Forma pago eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra la forma pago'
                
            ]);
        }
    }
}
