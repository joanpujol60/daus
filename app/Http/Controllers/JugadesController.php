<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugadors;
use App\Models\Jugades;
use Illuminate\Support\Facades\Validator;

class JugadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jugades = Jugades::all();
        return response()->json([
            'message' => 'OK',
            'data' => $jugades,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //buscamos el jugador con el id enviado por la URL
       $jugadors = Jugadors::find($id);
       if ($jugadors) {
          //Instancia modelo jugades
          $newJugades = new Jugades();
          //Llenamos el modelo con los datos de la jugada
          $newJugades->id_jugador = $id;
          $newJugades->dau1 = mt_rand(1, 6);
          $newJugades->dau2 = mt_rand(1, 6);
       
       //Guardamos
       if ($newJugades->save()) {
        return response()->json([
            'message' => 'Jugada Guardada',
            'data' => $newJugades
        ], 200);
    } else {
        return response()->json([
            'message' => 'Error al guardar la jugada',
            'data' => false
        ], 400);
    }
    } else {
        return response()->json([
            'message' => 'El jugador no existe',
            'data' => false
        ], 400);
    }
   }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            //buscamos les jugades con el id enviado por la URL
            $jugades = Jugades::where('id_jugador', $id)->get();
            if ($jugades->count() > 0) {
                if (Jugades::where('id_jugador', $id)->delete()) {
                        return response()->json([
                            'message' => 'Registres eliminados con exito',
                            'data' => $jugades
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Error al eliminar los registros',
                            'data' => false
                        ], 400);
                    }
                
            } else {
                return response()->json([
                    'message' => 'No existen jugades para eliminar',
                    'data' => false
                ], 400);
            }
    }
}
