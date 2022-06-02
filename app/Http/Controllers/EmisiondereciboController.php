<?php

namespace App\Http\Controllers;

use App\Models\Emisionderecibo;
use Illuminate\Http\Request;

class EmisiondereciboController extends Controller
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
            $emisionderecibo = Emisionderecibo::orderBy('id_emisionderecibo', 'desc')->paginate(10);
        }
        else{
            $emisionderecibo = Emisionderecibo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_emisionderecibo', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $emisionderecibo->total(),
                'current_page' => $emisionderecibo->currentPage(),
                'per_page'     => $emisionderecibo->perPage(),
                'last_page'    => $emisionderecibo->lastPage(),
                'from'         => $emisionderecibo->firstItem(),
                'to'           => $emisionderecibo->lastItem(),
            ],
            'emisionderecibo' => $emisionderecibo
        ];
        
    }

    public function store(Request $request)
    {
        try {
            $emisionderecibo = new Emisionderecibo();
            $emisionderecibo->nombre_emisionderecibo = $request->nombre_emisionderecibo;
            $emisionderecibo->estado_emisionderecibo = '1';
            $emisionderecibo->save();
    
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
            $emisionderecibo =  Emisionderecibo::findOrFail($request->id_emisionderecibo);
            $emisionderecibo->nombre_emisionderecibo = $request->nombre_emisionderecibo;
            $emisionderecibo->estado_emisionderecibo = '1';
            $emisionderecibo->save();        

            return response()->json([
                'res' => true,
                'message' => 'Emision de recibo Actualizado Correctamente'
                
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
            $emisionderecibo = Emisionderecibo::findOrFail($request->id_emisionderecibo);            
            $emisionderecibo->estado_emisionderecibo = '0';
            $emisionderecibo->save();           

            return response()->json([
                'res' => true,
                'message' => 'Emision de recibo Eliminado'
                
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
            $emisionderecibo = Emisionderecibo::findOrFail($request->id_emisionderecibo);            
            $emisionderecibo->estado_emisionderecibo = '1';
            $emisionderecibo->save();           

            return response()->json([
                'res' => true,
                'message' => 'Emisiond e recibo Restaurado'
                
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
            $emisionderecibo = Emisionderecibo::findOrFail($request->id_emisionderecibo);

            $emisionderecibo->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Emision de recibo eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el emision de recibo'
                
            ]);
        }
    }
}
