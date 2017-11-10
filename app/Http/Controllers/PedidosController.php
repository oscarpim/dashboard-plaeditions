<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidosModel;
use App\PedidosModel2;
use App\ConexionesModel;
use App\SuscriptoresModel;
use App\SuscriptoresEnviosModel;
use App\MuestrasModel;
use Carbon\Carbon;

class PedidosController extends Controller
{
    public function index(){

        /********************************/
        /*** OBTENER FECHAS ***/
        /********************************/
        //Mostrar fecha actual y comparaciones
        $start = '2013-01-01';
        $fechaHoy = Carbon::today();
        $mesSeleccionado = '';
        $anoSeleccionado = '';
        $ultimaFechaDB = PedidosModel::all()->first()->orderBy('id_order','DESC')->value('date_add'); //cogemos la ultima fecha registrada en la DB

        if(isset($_GET['mes']) && isset($_GET['ano'])){ //obtner fechas seleccionadas del formulario y por default al incio
            $mesSeleccionado = $_GET['mes'];
            $anoSeleccionado = $_GET['ano'];
        }else{
            $mesSeleccionado = Carbon::createFromFormat('Y-m-d H:i:s', $ultimaFechaDB)->month;
            $anoSeleccionado = Carbon::createFromFormat('Y-m-d H:i:s', $ultimaFechaDB)->year;
        }


        /**********************************/
        /*** ESTADISTICAS DE PRESTASHOP ***/
        /**********************************/

        //Mostrar el numero de pedidos totales del prestashop ultimo mes registrado
        $pedidos_totales = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->whereIn('current_state', [2, 4, 5])->count();

        //Mostrar las ganancias totales de los pedidos unicamente validos y mes anterior con dos decimales del ultimo mes registrado
        $ganancias_totales = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->whereIn('current_state', [2, 4, 5])->sum('total_paid');
        $ganancias_totales_anterior = PedidosModel::whereMonth('date_add', $mesSeleccionado-1)->whereYear('date_add', $anoSeleccionado)->sum('total_paid');
        $ganancias_totales_2 = $ganancias_totales - $ganancias_totales_anterior;


        //Mostrar todos los articulos comprados
        $primerIdOrder = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->get();

        //Mostrar la suma de la cantidad de productos comprados
        $primerIdOrder = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->orderBy('id_order','ASC')->value('id_order');
        $ultimoIdOrder = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->orderBy('id_order','DESC')->value('id_order');
        $productosComprados_total = PedidosModel2::whereBetween('id_order',array($primerIdOrder, $ultimoIdOrder))->sum('product_quantity');

        //Mostrar las conexiones-visitas realizadas en el ultimo mes registrado
        $visitasWeb = ConexionesModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->count();


        /***************************************/
        /*** ESTADISTICAS DE TIENDAS FISICAS ***/
        /***************************************/

        //Mostrar el numero de pedidos totales de las tiendas fisicas ultimo mes registrado
        $pedidos_totales_tfisicas = PedidosModel::whereMonth('date_add', $mesSeleccionado)->whereYear('date_add', $anoSeleccionado)->count();


        /************************************/
        /*** ESTADISTICAS DE SUSCRIPTORES ***/
        /************************************/

        //Mostrar el número total de suscriptores
        $s = SuscriptoresModel::count();
        //Mostrar el numero de pedidos totales de los suscriptores ultimo mes registrado

        if($mesSeleccionado == 10 && $anoSeleccionado == 2017){
            $pedidos_totales_sus = SuscriptoresEnviosModel::whereMonth('fecha', $mesSeleccionado)->whereYear('fecha', $anoSeleccionado)->first()->value('cantidad_envios');
        }else{
            $pedidos_totales_sus = 'No registrado';
        }

        /********************************/
        /*** ESTADISTICAS DE MUESTRAS ***/
        /********************************/
        //Mostrar el numero de pedidos totales de muestras ultimo mes registrado

        if($mesSeleccionado == 10 && $anoSeleccionado == 2017){
            $pedidos_totales_muestras = MuestrasModel::whereMonth('fecha', $mesSeleccionado)->whereYear('fecha', $anoSeleccionado)->first()->value('cantidad_envios');
        }else{
            $pedidos_totales_muestras = 'No registrado';
        }



        /*****************/
        /*** RESULTADO ***/
        /*****************/
        return view ('admin_template')->with(['pedidos_totales'=>$pedidos_totales, 'ganancias_totales'=>$ganancias_totales, 'ganancias_totales_2'=>$ganancias_totales_2,'ganancias_totales_anterior'=>$ganancias_totales_anterior, 'productosComprados_total'=>$productosComprados_total, 'visitasWeb'=>$visitasWeb, 'pedidos_totales_sus'=>$pedidos_totales_sus, 'pedidos_totales_muestras'=>$pedidos_totales_muestras, 'fechaHoy'=>$fechaHoy, 'mesSeleccionado'=>$mesSeleccionado, 'anoSeleccionado'=>$anoSeleccionado]);
    }


}
