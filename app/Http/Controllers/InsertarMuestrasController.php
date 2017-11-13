<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MuestrasModel;

class InsertarMuestrasController extends Controller
{
    public function index(){
        return view('insertar_muestras');
    }
}
