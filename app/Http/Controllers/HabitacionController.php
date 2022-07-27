<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HabitacionController extends Controller
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
            $habitaciones = Habitacion::with('tipoHabitacion')->with('piso')->orderBy('id_habitacion', 'desc')->paginate(10);
        } else {
            if ($request->criterio == "nombre_tipohabitacion") {
                $habitaciones = Habitacion::with('tipoHabitacion')->with('piso')->whereHas('tipoHabitacion', function (Builder $query) use ($buscar, $criterio) {
                    $query->where($criterio, 'like', '%' . $buscar . '%');
                })->orderBy('id_habitacion', 'desc')->paginate(10);
            } else {
                $habitaciones = Habitacion::with('tipoHabitacion')->with('piso')->whereHas('piso', function (Builder $query) use ($buscar, $criterio) {
                    $query->where($criterio, 'like', '%' . $buscar . '%');
                })->orderBy('id_habitacion', 'desc')->paginate(10);
            }
        }

        return [
            'pagination' => [
                'total'        => $habitaciones->total(),
                'current_page' => $habitaciones->currentPage(),
                'per_page'     => $habitaciones->perPage(),
                'last_page'    => $habitaciones->lastPage(),
                'from'         => $habitaciones->firstItem(),
                'to'           => $habitaciones->lastItem(),
            ],
            'habitaciones' => $habitaciones
        ];
    }

    public function allHabitacion()
    {


        $habitaciones = Habitacion::with('tipoHabitacion')->with('piso')->orderBy('id_habitacion', 'desc')->get();


        return [
            'habitaciones' => $habitaciones
        ];
    }



    public function store(Request $request)
    {
        try {
            $habitaciones = new Habitacion();
            $habitaciones->tipohabitacion_id = $request->tipohabitacion_id;
            $habitaciones->piso_id = $request->piso_id;
            $habitaciones->numero_habitacion = $request->numero_habitacion;
            $habitaciones->precio_habitacion = $request->precio_habitacion;
            $habitaciones->descripcion_habitacion   = $request->descripcion_habitacion;
            $habitaciones->estado_habitacion = '1';
            $habitaciones->save();

            return response()->json([
                'res' => true,
                'message' => 'Habitacion Guardado Correctamente'
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
            $habitaciones =  Habitacion::findOrFail($request->id_habitacion);
            $habitaciones->tipohabitacion_id = $request->tipohabitacion_id;
            $habitaciones->piso_id = $request->piso_id;
            $habitaciones->numero_habitacion = $request->numero_habitacion;
            $habitaciones->precio_habitacion = $request->precio_habitacion;
            $habitaciones->descripcion_habitacion   = $request->descripcion_habitacion;
            $habitaciones->estado_habitacion = '1';
            $habitaciones->save();

            return response()->json([
                'res' => true,
                'message' => 'Habitacion Actualizado Correctamente'

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
            $habitaciones = Habitacion::findOrFail($request->id_habitacion);
            $habitaciones->estado_habitacion = '0';
            $habitaciones->save();

            return response()->json([
                'res' => true,
                'message' => 'Habitacion Eliminado'

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
            $habitaciones = Habitacion::findOrFail($request->id_habitacion);
            $habitaciones->estado_habitacion = '1';
            $habitaciones->save();

            return response()->json([
                'res' => true,
                'message' => 'Habitacion Restaurado'

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
            $habitaciones = Habitacion::findOrFail($request->id_habitacion);

            $habitaciones->delete();

            return response()->json([
                'res' => true,
                'message' => 'Habitacion eliminado correctamente',
                'tours' =>  $habitaciones
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el habitaciones ',
            ]);
        }
    }
}
