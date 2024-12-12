@extends('layout')

@section('title', 'Nuevo Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nuevo Cliente</h1>
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
        <form enctype="multipart/form-data" method="POST" action="{{ route('cliente_new') }}">
            @csrf
            <div>
                <label for="dni">DNI</label>
                <input id="dni" type="text" name="dni"/>
            </div>
            <div>            
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre"/>
            </div>
            <div>            
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos"/>
            </div>
            <div>
                <label for="fechaN">Fecha de nacimiento</label>
                <input id="fechaN" type="date" name="fechaN" value="{{ date_create()->format('Y-m-d') }}">
            </div>
            <div>
                <label for="imagen">Subir una imagen</label>
                <input id="imagen" type="file" name="imagen">
            </div>
            <button type="submit">Crear Cliente</button>
        </form>
	</div>
@endsection