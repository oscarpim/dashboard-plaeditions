<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidosModel;

class PedidosController extends Controller
{
    //Mostrar todos el numero de pedidos totales del mes
    public function pedidosTotales(){
        $pedidos_totales = PedidosModel::where('date_add','>=','2017-10-01 00:00:00')->count();
        return view ('admin_template') ->with('pedidos_totales',$pedidos_totales);
    }



}
