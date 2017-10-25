@extends('plantilla')


@section('content')
   <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <table border="1">
               <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>CONTRASEÑA</th>
                    <th>CORREO</th>
               </tr>

                @foreach ($usuarios as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->usuario }}</td>
                    <td>{{ $item->contrasena }}</td>
                    <td>{{ $item->correo }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop
