<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugadors;
use Illuminate\Support\Facades\Validator;


class JugadorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jugadors = Jugadors::all();
        return response()->json([
            'message' => 'OK',
            'data' => $jugadors,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        //Regla de validación
        $rules = [
             'email' => 'required|string|max:100',
             'password' => 'required|string|max:100'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //Instancia modelo Jugadors
        $newJugadors = new Jugadors;
        //Llevanos el modelo con los datos del Request
        $newJugadors->email = $request->email;
        $newJugadors->password = $request->password;
        $newJugadors->nickname = $request->nickname;
     
        //Guardamos
        if ($newJugadors->save()) {
            return response()->json([
                'message' => 'Registro exitoso',
                'data' => $newJugadors
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error al guardar el registro',
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
        //Regla de validación
        $rules = [
            'nickname' => 'required|string|max:100'
       ];
       //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
       $validator = Validator::make($request->all(), $rules);
       //Si falla la validacion retornamos los errores
       if ($validator->fails()) {
           return $validator->errors();
       }
       //buscamos el género con el id enviado por la URL
       $jugadors = Jugadors::find($id);
       if ($jugadors) {
        //Cambiamos el nombre del jugador con el valor enviado por Request
        $jugadors->nickname = $request->nickname;
        //Actualizamos y retornamos el jugador con el nuevo valor
        if ($jugadors->update()) {
            return response()->json([
                'message' => 'Registro actualizado con exito',
                'data' => $jugadors
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error al actualizar el registro',
                'data' => false
            ], 400);
        }
    } else {
        return response()->json([
            'message' => 'EL jugador no existe',
            'data' => false
        ], 400);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
