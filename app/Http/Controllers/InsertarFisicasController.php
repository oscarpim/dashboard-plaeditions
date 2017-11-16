<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\FisicasModel;
use App\FisicasEnviosModel;

class InsertarFisicasController extends Controller
{
    public function index(){

        $totalTiendas = FisicasModel::all()->count();
        $aTiendas = FisicasModel::all();

        return view('insertar_fisicas')->with(['totalTiendas'=>$totalTiendas, 'aTiendas'=>$aTiendas]);
    }

    public function insertar(Request $request){

        //Cogemos todos los datos que recibimos por post
        $formularioTienda = $request->all();

        $tienda = new FisicasModel();
        $tienda->nombre_tienda = $formularioTienda['nombre'];
        $tienda->direccion = $formularioTienda['direccion'];
        $tienda->telefono = $formularioTienda['telefono'];
        $tienda->correo = $formularioTienda['correo'];
        $tienda->persona = $formularioTienda['persona'];
        $tienda->save();

        return redirect()->back();

    }
}
