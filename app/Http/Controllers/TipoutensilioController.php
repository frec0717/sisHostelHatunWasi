<?php

namespace App\Http\Controllers;

use App\Models\Tipoutensilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoutensilioController extends Controller
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
            $tipoutensilio = Tipoutensilio::orderBy('id_tipoutensilio', 'desc')->paginate(10);
        }
        else{
            $tipoutensilio = Tipoutensilio::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_tipoutensilio', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $tipoutensilio->total(),
                'current_page' => $tipoutensilio->currentPage(),
                'per_page'     => $tipoutensilio->perPage(),
                'last_page'    => $tipoutensilio->lastPage(),
                'from'         => $tipoutensilio->firstItem(),
                'to'           => $tipoutensilio->lastItem(),
            ],
            'tipoutensilio' => $tipoutensilio
        ];
        
    }

    public function selectAll(Request $request){
        $filtro = $request->filtro;
        $tipoutensilio = Tipoutensilio::where('nombre_tipoutensilio','like','%'.$filtro.'%')->orderBy('nombre_tipoutensilio', 'asc')->get();
        return ["tipoutensilio" =>  $tipoutensilio];
    }

    public function store(Request $request)
    {
        try {
            $tipoutensilio = new Tipoutensilio();
            $tipoutensilio->nombre_tipoutensilio = $request->nombre_tipoutensilio;
            $tipoutensilio->estado_tipoutensilio = '1';
            $tipoutensilio->save();
    
            return response()->json([
                'res' => true,
                'message' => 'Tipo de utensilio Guardado Correctamente'
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
            $tipoutensilio =  Tipoutensilio::findOrFail($request->id_tipoutensilio);
            $tipoutensilio->nombre_tipoutensilio = $request->nombre_tipoutensilio;
            $tipoutensilio->estado_tipoutensilio = '1';
            $tipoutensilio->save();        

            return response()->json([
                'res' => true,
                'message' => 'Tipo de utensilio Actualizado Correctamente'
                
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
            $tipoutensilio = Tipoutensilio::findOrFail($request->id_tipoutensilio);            
            $tipoutensilio->estado_tipoutensilio = '0';
            $tipoutensilio->save();           

            return response()->json([
                'res' => true,
                'message' => 'Tipo de utensilio Eliminado'
                
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
            $tipoutensilio = Tipoutensilio::findOrFail($request->id_tipoutensilio);            
            $tipoutensilio->estado_tipoutensilio = '1';
            $tipoutensilio->save();           

            return response()->json([
                'res' => true,
                'message' => 'Tipo de utensilio Restaurado'
                
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
            $tipoutensilio = Tipoutensilio::findOrFail($request->id_tipoutensilio);
            DB::table('utensilios')->where('tipoutensilio_id', $request->id_tipoutensilio)->delete(); 

            $tipoutensilio->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'Tipo de utensilio eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tipo de utensilio'
                
            ]);
        }
    }
}
