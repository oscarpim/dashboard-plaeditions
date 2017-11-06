<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidosModel;
use App\PedidosModel2;
use App\ConexionesModel;
use App\SuscriptoresModel;
use App\SuscriptoresEnviosModel;
use App\MuestrasModel;

class PedidosController extends Controller
{
    public function index(){
        /**********************************/
        /*** ESTADISTICAS DE PRESTASHOP ***/
        /**********************************/

        //Mostrar el numero de pedidos totales del prestashop mes octubre
        $pedidos_totales = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->count();

        //Mostrar las ganancias totales y mes anterior con dos decimales del mes octubre
        $ganancias_totales = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->sum('total_paid');
        $ganancias_totales_anterior = PedidosModel::whereMonth('date_add', '09')->whereYear('date_add','2017')->sum('total_paid');
        $ganancias_totales_2 = $ganancias_totales - $ganancias_totales_anterior;


        //Mostrar todos los articulos comprados
        $primerIdOrder = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->get();

        //Mostrar la suma de la cantidad de productos comprados
        $primerIdOrder = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->orderBy('id_order','ASC')->value('id_order');
        $ultimoIdOrder = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->orderBy('id_order','DESC')->value('id_order');
        $productosComprados_total = PedidosModel2::whereBetween('id_order',array($primerIdOrder, $ultimoIdOrder))->sum('product_quantity');

        //Mostrar las conexiones-visitas realizadas en el mes de octubre
        $visitasWeb = ConexionesModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->count();


        /***************************************/
        /*** ESTADISTICAS DE TIENDAS FISICAS ***/
        /***************************************/

        //Mostrar el numero de pedidos totales de las tiendas fisicas mes octubre
        $pedidos_totales_tfisicas = PedidosModel::whereMonth('date_add', '10')->whereYear('date_add','2017')->count();


        /************************************/
        /*** ESTADISTICAS DE SUSCRIPTORES ***/
        /************************************/

        //Mostrar el número total de suscriptores
        $s = SuscriptoresModel::count();
        //Mostrar el numero de pedidos totales de los suscriptores mes octubre
        $pedidos_totales_sus = SuscriptoresEnviosModel::whereMonth('fecha', '10')->whereYear('fecha','2017')->first()->value('cantidad_envios');


        /********************************/
        /*** ESTADISTICAS DE MUESTRAS ***/
        /********************************/
        //Mostrar el numero de pedidos totales de muestras mes octubre
        $pedidos_totales_muestras = MuestrasModel::whereMonth('fecha', '10')->whereYear('fecha','2017')->first()->value('cantidad_envios');




        /*****************/
        /*** RESULTADO ***/
        /*****************/
        return view ('admin_template')->with(['pedidos_totales'=>$pedidos_totales, 'ganancias_totales'=>$ganancias_totales, 'ganancias_totales_2'=>$ganancias_totales_2,'ganancias_totales_anterior'=>$ganancias_totales_anterior, 'productosComprados_total'=>$productosComprados_total, 'visitasWeb'=>$visitasWeb, 'pedidos_totales_sus'=>$pedidos_totales_sus, 'pedidos_totales_muestras'=>$pedidos_totales_muestras]);
    }


}
