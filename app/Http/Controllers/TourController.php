<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TourController extends Controller
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
            $tour = Tour::with('empresas')->orderBy('id_tour', 'desc')->paginate(10);
        } else {
            $tour = Tour::with('empresas')->whereHas('empresas', function (Builder $query) use ($buscar, $criterio) {
                $query->where($criterio, 'like', '%' . $buscar . '%');
            })->orderBy('id_tour', 'desc')->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $tour->total(),
                'current_page' => $tour->currentPage(),
                'per_page'     => $tour->perPage(),
                'last_page'    => $tour->lastPage(),
                'from'         => $tour->firstItem(),
                'to'           => $tour->lastItem(),
            ],
            'tour' => $tour
        ];
        
    }



    public function store(Request $request)
    {
        try {
            $tour = new Tour();
            $tour->empresa_id = $request->empresa_id;
            $tour->fechai_tour = $request->fechai_tour;
            $tour->fechaf_tour   = $request->fechaf_tour;
            $tour->nombre_tour   = $request->nombre_tour;
            $tour->descripcion_tour   = $request->descripcion_tour;
            $tour->estado_tour = '1';
            $tour->save();

            return response()->json([
                'res' => true,
                'message' => 'Tour Guardado Correctamente'
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
            $tour =  Tour::findOrFail($request->id_tour);
            $tour->empresa_id = $request->empresa_id;
            $tour->fechai_tour = $request->fechai_tour;
            $tour->fechaf_tour   = $request->fechaf_tour;
            $tour->nombre_tour   = $request->nombre_tour;
            $tour->descripcion_tour   = $request->descripcion_tour;
            $tour->estado_tour = '1';
            $tour->save();

            return response()->json([
                'res' => true,
                'message' => 'Tour Actualizado Correctamente'

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
            $tour = Tour::findOrFail($request->id_tour);
            $tour->estado_tour = '0';
            $tour->save();

            return response()->json([
                'res' => true,
                'message' => 'Tour Eliminado'

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
            $tour = Tour::findOrFail($request->id_tour);
            $tour->estado_tour = '1';
            $tour->save();

            return response()->json([
                'res' => true,
                'message' => 'Tour Restaurado'

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
            $tour = Tour::findOrFail($request->id_tour);

            $tour->delete();

            return response()->json([
                'res' => true,
                'message' => 'Tour eliminado correctamente',
                'tours' =>  $tour
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => false,
                'message' => 'No se encuentra el tour ',
            ]);
        }
    }
}
