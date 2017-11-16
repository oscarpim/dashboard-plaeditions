<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use SuscriptoresModel;
use SuscriptoresEnviosModel;

class InsertarSuscriptoresController extends Controller
{
    public function index(){
        return view('insertar_suscriptores');
    }

    public function insertar(){

    }
}
