@extends('layout')

@section('title', 'Nueva Cuenta')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Modificando la cuenta {{$cuenta->codigo}}</h1>
    <a href="{{ route('cuenta_list') }}">&laquo; Volver</a>
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
        <form method="POST" action="{{ route('cuenta_modificar', ['id' => $cuenta->id]) }}">
            @csrf
            <div>
                <label for="codigo">Código</label>
                <input id="codigo" type="text" name="codigo" value="{{ $cuenta->codigo }}"/>
            </div>
            <div>            
                <label for="saldo">Saldo</label>
                <input id="saldo" type="number" name="saldo" value="{{ $cuenta->saldo }}"/>
            </div>
            <div>
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id">
                    <option value="">-- selecciona un cliente --</option>v
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected($cuenta->cliente_id==$cliente->id)>
                            {{ $cliente->nombreApellidos() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Modificar Cuenta</button>
        </form>
	</div>
@endsection