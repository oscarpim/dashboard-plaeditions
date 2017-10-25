<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuarios;

class UsuariosController extends Controller
{
    //Mostrar todos los usuarios
    public function index(){
        $usuarios = usuarios::all('id','usuario','contrasena','correo');
        return view ('usuarios.index') ->with('usuarios',$usuarios);
    }
}
