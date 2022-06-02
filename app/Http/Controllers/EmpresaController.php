<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
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
            $empresa = Empresa::orderBy('id_empresa', 'desc')->paginate(10);
        }
        else{
            $empresa = Empresa::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_empresa', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $empresa->total(),
                'current_page' => $empresa->currentPage(),
                'per_page'     => $empresa->perPage(),
                'last_page'    => $empresa->lastPage(),
                'from'         => $empresa->firstItem(),
                'to'           => $empresa->lastItem(),
            ],
            'empresa' => $empresa
        ];
        
    }


    public function store(Request $request)
    {
        try {
            $empresa = new Empresa();
            $empresa->ruc_empresa= $request->ruc_empresa;
            $empresa->razonsocial_empresa = $request->razonsocial_empresa;
            $empresa->direccion_empresa = $request->direccion_empresa;
            $empresa->celular_empresa = $request->celular_empresa;
            $empresa->telefono_empresa = $request->telefono_empresa;
            $empresa->descripcion_empresa = $request->descripcion_empresa;
            $empresa->estado_empresa = '1';
            $empresa->save();
    
            return response()->json([
                'res' => true,
                'message' => 'La empresa se a Guardado Correctamente'
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
            $empresa =  Empresa::findOrFail($request->id_empresa);
            $empresa->ruc_empresa= $request->ruc_empresa;
            $empresa->razonsocial_empresa = $request->razonsocial_empresa;
            $empresa->direccion_empresa = $request->direccion_empresa;
            $empresa->celular_empresa = $request->celular_empresa;
            $empresa->telefono_empresa = $request->telefono_empresa;
            $empresa->descripcion_empresa = $request->descripcion_empresa;
            $empresa->estado_empresa = '1';
            $empresa->save();        

            return response()->json([
                'res' => true,
                'message' => 'La empresa se a Actualizado Correctamente'
                
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
            $empresa = Empresa::findOrFail($request->id_empresa);            
            $empresa->estado_empresa = '0';
            $empresa->save();           

            return response()->json([
                'res' => true,
                'message' => 'La empresa se a Eliminado'
                
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
            $empresa = Empresa::findOrFail($request->id_empresa);            
            $empresa->estado_empresa = '1';
            $empresa->save();           

            return response()->json([
                'res' => true,
                'message' => 'La empresa se a Restaurado'
                
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
            $empresa = Empresa::findOrFail($request->id_empresa);
            DB::table('tours')->where('empresa_id', $request->id_empresa)->delete();    
            $empresa->delete();           
    
                return response()->json([
                    'res' => true,
                    'message' => 'La empresa se a eliminado correctamente'                    
                ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tipo de utensilio'
                
            ]);
        }
    }
}
