<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MuestrasModel;
use Carbon\Carbon;

class InsertarMuestrasController extends Controller
{
    public function index(){

        return view('insertar_muestras');

    }

    public function insertar(Request $request) {

        //Se le da formato a la fecha para que primero vaya Y-m-d
        $fech = $request->input('fecha');
        $fecho = str_replace("-", "", $fech);
        $fech = Carbon::parse($fecho)->format('Y-m-d');

        //Obtenemos la cantidad que queremos
        $cantidad = $request->input('cantidad');

        //Insertamos en la base de datos creando el objeto del modelo
        $muestras = new MuestrasModel();
        $muestras->cantidad_envios = $cantidad;
        $muestras->fecha = $fech;
        $muestras->save();

        //Una vez insertado, volvemos a la pagina que estabamos
        return redirect()->back();
   }
}
