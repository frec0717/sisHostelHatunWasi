<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ReservacionController extends Controller
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
            $reservacion = Reservacion::with('user')
            ->with('cliente')
            ->with('formapago')
            ->with('emisionderecibo')
            ->with('reservacionhabitacion','reservacionhabitacion.habitacion')
            ->orderBy('id_reservacion', 'desc')->paginate(10);
        } else {
            
            $reservacion = Reservacion::with('user')
            ->with('cliente')
            ->with('formapago')            
            ->with('reservacionhabitacion','reservacionhabitacion.habitacion')
            ->with('emisionderecibo')->whereHas('cliente', function (Builder $query) use ($buscar, $criterio) {
                $query->where($criterio, 'like', '%' . $buscar . '%');
            })->orderBy('id_reservacion', 'desc')->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $reservacion->total(),
                'current_page' => $reservacion->currentPage(),
                'per_page'     => $reservacion->perPage(),
                'last_page'    => $reservacion->lastPage(),
                'from'         => $reservacion->firstItem(),
                'to'           => $reservacion->lastItem(),
            ],
            'reservacion' => $reservacion
        ];
        
    }



    public function store(Request $request)
    {
        try {
            $reservacion = new Reservacion();
            $reservacion->user_id = $request->user_id;
            $reservacion->cliente_id = $request->cliente_id;
            $reservacion->formapago_id = $request->formapago_id;
            $reservacion->emisionderecibo_id = $request->emisionderecibo_id;
            $reservacion->fechae_reservacion = $request->fechae_reservacion;
            $reservacion->fechas_reservacion = $request->fechas_reservacion;
            $reservacion->npersona_reservacion = $request->npersona_reservacion;
            $reservacion->codigopago_reservacion   = $request->codigopago_reservacion;
            $reservacion->subt_reservacion   = $request->subt_reservacion;
            $reservacion->descuento_reservacion   = $request->descuento_reservacion;
            $reservacion->igv_reservacion   = $request->igv_reservacion;
            $reservacion->total_reservacion   = $request->total_reservacion;
            $reservacion->condicion_reservacion  = '1';
            $reservacion->estado_reservacion = '1';
            $reservacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion Guardado Correctamente'
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
            $reservacion =  Reservacion::findOrFail($request->id_reservacion);
            $reservacion->user_id = $request->user_id;
            $reservacion->cliente_id = $request->cliente_id;
            $reservacion->formapago_id = $request->formapago_id;
            $reservacion->emisionderecibo_id = $request->emisionderecibo_id;
            $reservacion->fechae_reservacion = $request->fechae_reservacion;
            $reservacion->fechas_reservacion = $request->fechas_reservacion;
            $reservacion->npersona_reservacion = $request->npersona_reservacion;
            $reservacion->codigopago_reservacion   = $request->codigopago_reservacion;
            $reservacion->subt_reservacion   = $request->subt_reservacion;
            $reservacion->descuento_reservacion   = $request->descuento_reservacion;
            $reservacion->igv_reservacion   = $request->igv_reservacion;
            $reservacion->total_reservacion   = $request->total_reservacion;
            $reservacion->condicion_reservacion  = '1';
            $reservacion->estado_reservacion = '1';
            $reservacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion Actualizado Correctamente'

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
            $reservacion = Reservacion::findOrFail($request->id_reservacion);
            $reservacion->estado_reservacion = '0';
            $reservacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion Eliminado'

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
            $reservacion = Reservacion::findOrFail($request->id_reservacion);
            $reservacion->estado_reservacion = '1';
            $reservacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion Restaurado'

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
            $reservacion = Reservacion::findOrFail($request->id_reservacion);

            $reservacion->delete();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion eliminado correctamente',
                'reservacions' =>  $reservacion
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el reservacion ',
            ]);
        }
    }
}
