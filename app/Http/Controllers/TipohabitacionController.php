<?php

namespace App\Http\Controllers;

use App\Models\Tipohabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipohabitacionController extends Controller
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
            $tipohabitaciones = Tipohabitacion::orderBy('id_tipohabitacion', 'desc')->paginate(10);
        }
        else{
            $tipohabitaciones = Tipohabitacion::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_tipohabitacion', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $tipohabitaciones->total(),
                'current_page' => $tipohabitaciones->currentPage(),
                'per_page'     => $tipohabitaciones->perPage(),
                'last_page'    => $tipohabitaciones->lastPage(),
                'from'         => $tipohabitaciones->firstItem(),
                'to'           => $tipohabitaciones->lastItem(),
            ],
            'tipohabitaciones' => $tipohabitaciones
        ];
        
    }

    public function store(Request $request)
    {
        try {
            $tipohabitaciones = new Tipohabitacion();
            $tipohabitaciones->nombre_tipohabitacion= $request->nombre_tipohabitacion;
            $tipohabitaciones->descripcion_tipohabitacion = $request->descripcion_tipohabitacion;
            $tipohabitaciones->estado_tipohabitacion = '1';
            $tipohabitaciones->save();
    
            return response()->json([
                'res' => true,
                'message' => 'El tipo de habitacion se a Guardado Correctamente'
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
            $tipohabitaciones =  Tipohabitacion::findOrFail($request->id_tipohabitacion);
            $tipohabitaciones->nombre_tipohabitacion= $request->nombre_tipohabitacion;
            $tipohabitaciones->descripcion_tipohabitacion = $request->descripcion_tipohabitacion;
            $tipohabitaciones->estado_tipohabitacion = '1';
            $tipohabitaciones->save();        

            return response()->json([
                'res' => true,
                'message' => 'El tipo de habitacion se a Actualizado Correctamente'
                
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
            $tipohabitaciones = Tipohabitacion::findOrFail($request->id_tipohabitacion);            
            $tipohabitaciones->estado_tipohabitacion = '0';
            $tipohabitaciones->save();           

            return response()->json([
                'res' => true,
                'message' => 'El tipo de habitacion se a Eliminado'
                
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
            $tipohabitaciones = Tipohabitacion::findOrFail($request->id_tipohabitacion);            
            $tipohabitaciones->estado_tipohabitacion = '1';
            $tipohabitaciones->save();           

            return response()->json([
                'res' => true,
                'message' => 'El tipo de habitacion se a Restaurado'
                
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
            $tipohabitaciones = Tipohabitacion::findOrFail($request->id_tipohabitacion);
            DB::table('habitaciones')->where('tipohabitacion_id', $request->id_tipohabitacion)->delete();    
            $tipohabitaciones->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'El tipo de habitacion se a eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tipo habitacion'
                
            ]);
        }
    }
}
