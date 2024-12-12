@extends('layout')

@section('title', 'Nuevo Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Modificando el cliente {{$cliente->nombreApellidos()}}</h1>
    <a href="{{ route('cliente_list') }}">&laquo; Volver</a>
    @if ($errors->any())
    <div class="alert alert-danger" style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    
	<div style="margin-top: 20px">
        <form enctype="multipart/form-data" method="POST" action="{{ route('cliente_modificar', ['id' => $cliente->id]) }}">
            @csrf
            <div>
                <label for="dni">DNI</label>
                <input id="dni" type="text" name="dni" value="{{ $cliente->dni }}"/>
            </div>
            <div>            
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" value="{{ $cliente->nombre }}"/>
            </div>
            <div>            
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" value="{{ $cliente->apellidos }}"/>
            </div>
            <div>
                <label for="fechaN">Fecha de nacimiento</label>
                <input id="fechaN" type="date" name="fechaN" value="{{ $cliente->fechaN->format('Y-m-d') }}"/>
            </div>
            <div>
                @isset($cliente->imagen)
                <label for="imagen">Imagen actual:</label>
                <img src="{{ asset('uploads/imagenes/' . $cliente->imagen) }}" alt="Imagen del cliente" width="100">
                @endisset
            </div>
            <div>
                <label for="imagen">Subir una imagen</label>
                <input id="imagen" type="file" name="imagen" value="Examinar...">
            </div>
            <div>
                @isset($cliente->imagen)
                    <label for="borrar">Borrar imagen? </label>
                    <input type="checkbox" id="borrar" name="borrar">
                @endisset
            </div>
            <button type="submit">Modificar Cliente</button>
        </form>
	</div>
@endsection