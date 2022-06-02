<?php

namespace App\Http\Controllers;

use App\Models\Categoriadispensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriadispensaController extends Controller
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
            $categoriadispensas = Categoriadispensa::orderBy('id_categoriadispensa', 'desc')->paginate(10);
        }
        else{
            $categoriadispensas = Categoriadispensa::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_categoriadispensa', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $categoriadispensas->total(),
                'current_page' => $categoriadispensas->currentPage(),
                'per_page'     => $categoriadispensas->perPage(),
                'last_page'    => $categoriadispensas->lastPage(),
                'from'         => $categoriadispensas->firstItem(),
                'to'           => $categoriadispensas->lastItem(),
            ],
            'categoriadispensas' => $categoriadispensas
        ];
        
    }

    public function store(Request $request)
    {
        try {
            $categoriadispensas = new Categoriadispensa();
            $categoriadispensas->nombre_categoriadispensa= $request->nombre_categoriadispensa;
            $categoriadispensas->descripcion_categoriadispensa = $request->descripcion_categoriadispensa;
            $categoriadispensas->estado_categoriadispensa = '1';
            $categoriadispensas->save();
    
            return response()->json([
                'res' => true,
                'message' => 'La categoria dispensas se a Guardado Correctamente'
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
            $categoriadispensas =  Categoriadispensa::findOrFail($request->id_categoriadispensa);
            $categoriadispensas->nombre_categoriadispensa= $request->nombre_categoriadispensa;
            $categoriadispensas->descripcion_categoriadispensa = $request->descripcion_categoriadispensa;
            $categoriadispensas->estado_categoriadispensa = '1';
            $categoriadispensas->save();        

            return response()->json([
                'res' => true,
                'message' => 'La categoria dispensas se a Actualizado Correctamente'
                
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
            $categoriadispensas = Categoriadispensa::findOrFail($request->id_categoriadispensa);            
            $categoriadispensas->estado_categoriadispensa = '0';
            $categoriadispensas->save();           

            return response()->json([
                'res' => true,
                'message' => 'La categoria dispensas se a Eliminado'
                
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
            $categoriadispensas = Categoriadispensa::findOrFail($request->id_categoriadispensa);            
            $categoriadispensas->estado_categoriadispensa = '1';
            $categoriadispensas->save();           

            return response()->json([
                'res' => true,
                'message' => 'La categoria dispensas se a Restaurado'
                
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
            $categoriadispensas = Categoriadispensa::findOrFail($request->id_categoriadispensa);
            DB::table('dispensas')->where('categoriadispensa_id', $request->id_categoriadispensa)->delete();    
            $categoriadispensas->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'La categoria dispensas se a eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tipo de utensilio'
                
            ]);
        }
    }
}
