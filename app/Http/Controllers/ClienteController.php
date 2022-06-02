<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $cliente = Cliente::with('tipoclientes')->orderBy('id_cliente', 'desc')->paginate(10);
        } else {
            $cliente = Cliente::with('tipoclientes')->whereHas('tipoclientes', function (Builder $query) use ($buscar, $criterio) {
                $query->where($criterio, 'like', '%' . $buscar . '%');
            })->orderBy('id_cliente', 'desc')->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $cliente->total(),
                'current_page' => $cliente->currentPage(),
                'per_page'     => $cliente->perPage(),
                'last_page'    => $cliente->lastPage(),
                'from'         => $cliente->firstItem(),
                'to'           => $cliente->lastItem(),
            ],
            'cliente' => $cliente
        ];
        
    }



    public function store(Request $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->tipocliente_id = $request->tipocliente_id;
            $cliente->dniruc_cliente = $request->dniruc_cliente;
            $cliente->nombre_cliente   = $request->nombre_cliente;
            $cliente->direccion_cliente   = $request->direccion_cliente;
            $cliente->celular_cliente   = $request->celular_cliente;
            $cliente->telefono_cliente   = $request->telefono_cliente;
            $cliente->correo_cliente   = $request->correo_cliente;
            $cliente->estranjero_cliente   = $request->estranjero_cliente;
            $cliente->estado_cliente = '1';
            $cliente->save();

            return response()->json([
                'res' => true,
                'message' => 'Cliente Guardado Correctamente'
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
            $cliente =  Cliente::findOrFail($request->id_cliente);
            $cliente->tipocliente_id = $request->tipocliente_id;
            $cliente->dniruc_cliente = $request->dniruc_cliente;
            $cliente->nombre_cliente   = $request->nombre_cliente;
            $cliente->direccion_cliente   = $request->direccion_cliente;
            $cliente->celular_cliente   = $request->celular_cliente;
            $cliente->telefono_cliente   = $request->telefono_cliente;
            $cliente->correo_cliente   = $request->correo_cliente;
            $cliente->estranjero_cliente   = $request->estranjero_cliente;
            $cliente->estado_cliente = '1';
            $cliente->save();

            return response()->json([
                'res' => true,
                'message' => 'Cliente Actualizado Correctamente'

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error Server'

            ]);
        }
    }

    public function destroyLogic(Request $request)
    {
        try {
            $cliente = Cliente::findOrFail($request->id_cliente);
            $cliente->estado_cliente = '0';
            $cliente->save();

            return response()->json([
                'res' => true,
                'message' => 'Cliente Eliminado'

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error Server'

            ]);
        }
    }
    public function restoreLogic(Request $request)
    {
        try {
            $cliente = Cliente::findOrFail($request->id_cliente);
            $cliente->estado_cliente = '1';
            $cliente->save();

            return response()->json([
                'res' => true,
                'message' => 'Cliente Restaurado'

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
            $cliente = Cliente::findOrFail($request->id_cliente);

            $cliente->delete();

            return response()->json([
                'res' => true,
                'message' => 'Cliente eliminado correctamente',
                'clientes' =>  $cliente
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el cliente ',
            ]);
        }
    }
}
