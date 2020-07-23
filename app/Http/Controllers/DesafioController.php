<?php

namespace App\Http\Controllers;

use App\Desafio;
use App\Equipo;
use App\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesafioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if ( isset($_GET["keyword"]) ) {
            Log::channel('stderr')->info('test 1x'.$_GET["keyword"]);
            $ids = array();
            $equipos = Equipo::where('nombre', $_GET["keyword"])
                ->orWhere('nombre', 'like', '%' . $_GET["keyword"] . '%')->get();
            foreach($equipos as $equipo) {
                array_push($ids, $equipo->id);
            }
            Log::channel('stderr')->info('test 2x'.count($equipos));
            $data = Desafio::whereIn('retador_id', $ids)
                ->orWhere('invitado_id', $ids)->get();
        } else {
            $data = Desafio::all();    
        }
        //
        
        $result = array();
        
        foreach ($data as $d) {
            $retador = Equipo::find($d->retador_id);
            $invitado = Equipo::find($d->invitado_id);
            array_push($result, array(
                "retador" => $retador,
                "invitado" => $invitado, 
                "desafio" => $d->fecha                 
            ));
        } 
        return response()->json(array("status" => true, "objects" => $result));*/
        $data = Desafio::where("visible", true)->get();
        $compilado = array();
        foreach($data as $item) {
            $xrow = array(
                "id" => $item->id,
                "disciplina" => Disciplina::find($item->disciplina_id),
                "invitado" => Equipo::find($item->invitado_id),
                "retador" => Equipo::find($item->retador_id),
                "invitado_puntaje" => $item->invitado_puntaje,
                "retador_puntaje" => $item->retador_puntaje,
                "ganador" => $item->ganador,
            );
            array_push($compilado, $xrow);
        }

        return response()->json(array("status" => true, "objects" => $compilado));
    }
     public function indexByDisciplina(Request $request, $disciplina_id)
    {
        /*if ( isset($_GET["keyword"]) ) {
            Log::channel('stderr')->info('test 1x'.$_GET["keyword"]);
            $ids = array();
            $equipos = Equipo::where('nombre', $_GET["keyword"])
                ->orWhere('nombre', 'like', '%' . $_GET["keyword"] . '%')->get();
            foreach($equipos as $equipo) {
                array_push($ids, $equipo->id);
            }
            Log::channel('stderr')->info('test 2x'.count($equipos));
            $data = Desafio::whereIn('retador_id', $ids)
                ->orWhere('invitado_id', $ids)->get();
        } else {
            $data = Desafio::all();    
        }
        //
        
        $result = array();
        
        foreach ($data as $d) {
            $retador = Equipo::find($d->retador_id);
            $invitado = Equipo::find($d->invitado_id);
            array_push($result, array(
                "retador" => $retador,
                "invitado" => $invitado, 
                "desafio" => $d->fecha                 
            ));
        } 
        return response()->json(array("status" => true, "objects" => $result));*/
        $disc = $disciplina_id;
        $data = Desafio::where([["visible", "=", true], ["disciplina_id", "=",$disc]])->get();
        $compilado = array();
        foreach($data as $item) {
            $xrow = array(
                "id" => $item->id,
                "disciplina" => Disciplina::find($item->disciplina_id),
                "invitado" => Equipo::find($item->invitado_id),
                "retador" => Equipo::find($item->retador_id),
                "invitado_puntaje" => $item->invitado_puntaje,
                "retador_puntaje" => $item->retador_puntaje,
                "ganador" => $item->ganador,
            );
            array_push($compilado, $xrow);
        }

        return response()->json(array("status" => true, "objects" => $compilado));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disciplina_id = $request->input("disciplina_id");
        $invitado_id = $request->input("invitado_id");
        $retador_id = $request->input("retador_id");
        $invitado_puntaje = $request->input("invitado_puntaje");
        $retador_puntaje = $request->input("retador_puntaje");
        $ganador = $request->input("ganador");
        $parent_id = $request->input("parent_id");
        $fecha = $request->input("fecha");
        $fase = $request->input("fase");

        $desafio_object = new Desafio;
        $desafio_object->disciplina_id = $disciplina_id;
        $desafio_object->invitado_id = $invitado_id;
        $desafio_object->retador_id = $retador_id;
        $desafio_object->invitado_puntaje = $invitado_puntaje;
        $desafio_object->retador_puntaje = $retador_puntaje;
        $desafio_object->ganador = $ganador;
        $desafio_object->parent_id = $parent_id;
        $desafio_object->fecha = $fecha;
        $desafio_object->fase = $fase;
        $desafio_object->visible = true;
        $desafio_object->save();

        return response()->json([
            "status" => true,
            "object" => $desafio_object
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function show(Desafio $desafio)
    {
        return response()->json([
            "status" => true, 
            "object" => $desafio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function edit(Desafio $desafio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desafio $desafio)
    {
        //
        $desafio->disciplina_id = $request->input("disciplina_id");
        $desafio->invitado_id = $request->input("invitado_id");
        $desafio->retador_id = $request->input("retador_id");
        $desafio->invitado_puntaje = $request->input("invitado_puntaje");
        $desafio->retador_puntaje = $request->input("retador_puntaje");
        $desafio->ganador = $request->input("ganador");
        $desafio->parent_id = $request->input("parent_id");
        $desafio->fecha = $request->input("fecha");
        $desafio->fase = $request->input("fase");
        //$competidorequipo->visible = $request->true;
        $desafio->update();
        return response()->json(array("status" => true,
        "object" =>$desafio));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desafio $desafio)
    {
        //
        $desafio->visible = false;
        $desafio->update();
    }
}
