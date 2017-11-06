<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\insertarPrestashopModel;

class insertarPrestashopController extends Controller
{
    public function index(){

        return view('insertar_prestashop');
    }
}
