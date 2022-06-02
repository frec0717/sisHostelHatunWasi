<?php

namespace App\Http\Controllers;

use App\Models\Utensilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UtensilioController extends Controller
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
            $utensilio = Utensilio::with('tipoutensilios')->orderBy('id_utensilio', 'desc')->paginate(10);
        }
        else{
            $utensilio = Utensilio::with('tipoutensilios')->whereHas('tipoutensilios', function (Builder $query) use ($buscar, $criterio) {
                $query->where($criterio, 'like', '%' . $buscar . '%');
            })->orderBy('id_utensilio', 'desc')->paginate(10);            
        }
        
        return [
            'pagination' => [
                'total'        => $utensilio->total(),
                'current_page' => $utensilio->currentPage(),
                'per_page'     => $utensilio->perPage(),
                'last_page'    => $utensilio->lastPage(),
                'from'         => $utensilio->firstItem(),
                'to'           => $utensilio->lastItem(),
            ],       
            'utensilio' => $utensilio
        ];
        
    }
    

   
    public function store(Request $request)
    {
        try {
            $utensilio = new Utensilio();
            $utensilio->tipoutensilio_id = $request->tipoutensilio_id;
            $utensilio->nombre_utensilio = $request->nombre_utensilio;
            $utensilio->cantidad_utensilio   = $request->cantidad_utensilio;
            $utensilio->descripcion_utensilio   = $request->descripcion_utensilio;
            $utensilio->estado_utensilio = '1';
            $utensilio->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Utensilio Guardado Correctamente'
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
            $utensilio =  Utensilio::findOrFail($request->id_utensilio);
            $utensilio->tipoutensilio_id = $request->tipoutensilio_id;
            $utensilio->nombre_utensilio = $request->nombre_utensilio;
            $utensilio->cantidad_utensilio   = $request->cantidad_utensilio;
            $utensilio->descripcion_utensilio   = $request->descripcion_utensilio;
            $utensilio->estado_utensilio = '1';
            $utensilio->save();        

            return response()->json([
                'res' => true,
                'message' => 'Utensilio Actualizado Correctamente'
                
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
            $utensilio = Utensilio::findOrFail($request->id_utensilio);            
            $utensilio->estado_utensilio = '0';
            $utensilio->save();           

            return response()->json([
                'res' => true,
                'message' => 'Utensilio Eliminado'
                
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
            $utensilio = Utensilio::findOrFail($request->id_utensilio);            
            $utensilio->estado_utensilio = '1';
            $utensilio->save();           

            return response()->json([
                'res' => true,
                'message' => 'Utensilio Restaurado'
                
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
            $utensilio = Utensilio::findOrFail($request->id_utensilio); 
            $utensilio->delete();      
             
                return response()->json([
                    'res' => true,
                    'message' => 'Utensilio eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el utensilio ',
            ]);
        }
    }
}
