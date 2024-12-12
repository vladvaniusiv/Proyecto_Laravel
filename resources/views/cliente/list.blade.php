@extends('layout')

@section('title', 'Listado de clientes')
@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de clientes</h1>
    <a href="{{ route('cliente_new') }}">+ Nuevo cliente</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;margin-bottom: 10px; text-align:center">
        <thead class="table-primary">
            <tr>
                <th>DNI</th><th>Nombre y apellidos</th><th>Fecha de nacimiento</th><th>Imagen</th><th>Cantidad cuentas</th>@auth<th colspan="2">Acciones</th>@endauth
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->dni }}</td>
                    <td>
                        {{ $cliente->nombreApellidos()}}
                    </td>
                    <td>{{ $cliente->fechaN->format('d-m-Y') }}</td>
                    <td>
                        @if($cliente->imagen)
                            <img src="{{ asset('uploads/imagenes/'.$cliente->imagen) }}" alt="" width="100">
                    
                        @else
                            <p>No tiene</p>
                        @endif
                    </td>
                    <td>
                        {{ $cliente->cuentas->count() }}
                    </td>
                    @auth
                        <td>
                            <a href="{{ route('cliente_modificar', ['id' => $cliente->id]) }}">Modificar</a>
                        </td>
                        <td>
                            <a href="{{ route('cliente_delete', ['id' => $cliente->id]) }}">Eliminar</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection