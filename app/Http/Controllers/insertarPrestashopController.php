<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsertarPrestashopModel;

class insertarPrestashopController extends Controller
{
    public function index(){

        return view('insertar_prestashop');
    }
}
