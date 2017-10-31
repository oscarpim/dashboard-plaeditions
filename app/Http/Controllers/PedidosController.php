<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidosModel;
use App\PedidosModel2;

class PedidosController extends Controller
{
    public function index(){
        //Mostrar el numero de pedidos totales del mes octubre
        $pedidos_totales = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->count();

        //Mostrar las ganancias totales con dos decimales del mes octubre
        $ganancias_totales = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->sum('total_paid');
        $ganancias_totales = number_format($ganancias_totales,2);

        //Mostrar todos los articulos comprados
        $aPedidosFecha = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->get();

        //no funciona la consulta para mostrar la suma de productquantity
        $aa = PedidosModel2::whereBetween('id_order',[4689,4690])->count();
        return view ('admin_template') ->with(['pedidos_totales'=>$pedidos_totales, 'ganancias_totales'=>$ganancias_totales, 'aa'=>$aa]);
    }

    /*$aPedidosFecha = PedidosModel::all('id_order')->whereMonth('date_add', '10')->whereYear('date_add','2017')->count();

    SELECT SUM(product_quantity) FROM ps_order_detail WHERE id_order = 4690;*/

}
