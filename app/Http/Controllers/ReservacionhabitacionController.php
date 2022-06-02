<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Reservacionhabitacion;

class ReservacionhabitacionController extends Controller
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
            $reservacionhabitacion = Reservacionhabitacion::with('reservacion')->with('habitacion')->paginate(10);
        } else {
            $reservacionhabitacion = Reservacionhabitacion::with('reservacion')->with('habitacion')->whereHas('reservacion', function (Builder $query) use ($buscar, $criterio) {
                $query->where($criterio, 'like', '%' . $buscar . '%');
            })->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $reservacionhabitacion->total(),
                'current_page' => $reservacionhabitacion->currentPage(),
                'per_page'     => $reservacionhabitacion->perPage(),
                'last_page'    => $reservacionhabitacion->lastPage(),
                'from'         => $reservacionhabitacion->firstItem(),
                'to'           => $reservacionhabitacion->lastItem(),
            ],
            'reservacionhabitacion' => $reservacionhabitacion
        ];
        
    }

    public function findHabitacionReserva(Request $request)
    {
        try {

            $reservacionhabitacion = Reservacionhabitacion::join('reservaciones', 'reservacionhabitaciones.reservacion_id', '=', 'reservaciones.id_reservacion')
            ->join('habitaciones', 'reservacionhabitaciones.habitacion_id', '=', 'habitaciones.id_habitacion')
            ->where('habitaciones.numero_habitacion','=',$request->nhabitacion)
            ->whereBetween('reservaciones.fechae_reservacion',[$request->fentrada,$request->fsalida])
            ->orWhereBetween('reservaciones.fechas_reservacion', [$request->fentrada,$request->fsalida])            
            ->orWhere('reservaciones.fechae_reservacion', '<=', $request->fentrada , 'AND', 'reservaciones.fechas_reservacion' ,'>=', $request->fsalida)
            ->get();
           

            return response()->json([
                'res' => true,
                'message' => 'Reservacion encontrada',
                'reservacionhabitacion' => $reservacionhabitacion
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'Error en el servidor'

            ]);
        }
    }



    public function store(Request $request)
    {
        try {
            $reservacionhabitacion = new Reservacionhabitacion();
            $reservacionhabitacion->reservacion_id = $request->reservacion_id;
            $reservacionhabitacion->habitacion_id = $request->habitacion_id;
            $reservacionhabitacion->precio_reservacionhabitacion   = $request->precio_reservacionhabitacion;
            $reservacionhabitacion->recargo_reservacionhabitacion   = $request->recargo_reservacionhabitacion;
            $reservacionhabitacion->total_reservacionhabitacion   = $request->total_reservacionhabitacion;
            $reservacionhabitacion->estado_reservacionhabitacion = '1';
            $reservacionhabitacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion habitacion Guardado Correctamente'
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
            $reservacionhabitacion =  Reservacionhabitacion::findOrFail($request->id_reservacionhabitacion);
            $reservacionhabitacion->reservacion_id = $request->reservacion_id;
            $reservacionhabitacion->habitacion_id = $request->habitacion_id;
            $reservacionhabitacion->precio_reservacionhabitacion   = $request->precio_reservacionhabitacion;
            $reservacionhabitacion->recargo_reservacionhabitacion   = $request->recargo_reservacionhabitacion;
            $reservacionhabitacion->total_reservacionhabitacion   = $request->total_reservacionhabitacion;
            $reservacionhabitacion->estado_reservacionhabitacion = '1';
            $reservacionhabitacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion habitacion Actualizado Correctamente'

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
            $reservacionhabitacion = Reservacionhabitacion::findOrFail($request->id_reservacionhabitacion);
            $reservacionhabitacion->estado_reservacionhabitacion = '0';
            $reservacionhabitacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion habitacion Eliminado'

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
            $reservacionhabitacion = Reservacionhabitacion::findOrFail($request->id_reservacionhabitacion);
            $reservacionhabitacion->estado_reservacionhabitacion = '1';
            $reservacionhabitacion->save();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion habitacion Restaurado'

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
            $reservacionhabitacion = Reservacionhabitacion::findOrFail($request->id_reservacionhabitacion);

            $reservacionhabitacion->delete();

            return response()->json([
                'res' => true,
                'message' => 'Reservacion habitacion eliminado correctamente',
                'reservacionhabitacions' =>  $reservacionhabitacion
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el reservacio nhabitacion ',
            ]);
        }
    }
}
