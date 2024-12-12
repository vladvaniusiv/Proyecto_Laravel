@extends('layout')

@section('title', 'Listado de cuentas')
@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de cuentas</h1>
    <a href="{{ route('cuenta_new') }}">+ Nueva cuenta</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif
    @if(isset($mensajeCodigo))
        <div class="alert alert-info">{{ $mensajeCodigo }}</div>
        <div class="alert alert-danger">{{ $operador }}</div>
        <div class="alert alert-info">{{ $mensajeSaldo }}</div>
        <form method="GET" action="{{ route('cuenta_list') }}">
            <button class="btn btn-primary">Limpiar filtro</button>
        </form>
    @endif

    <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;margin-bottom: 10px; text-align:center">
        <thead class="table-success">
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>@auth<th colspan="2">Acciones</th>@endauth
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->codigo }}</td>
                    <td>{{ $cuenta->saldo }}</td>
                    <td>
                        @isset($cuenta->cliente)
                            {{ $cuenta->cliente->nombreApellidos() }}
                        @endisset
                    </td>
                    @auth
                        <td>
                            <a href="{{ route('cuenta_modificar', ['id' => $cuenta->id]) }}">Modificar</a>
                        </td>
                        <td>
                            <a href="{{ route('cuenta_delete', ['id' => $cuenta->id]) }}">Eliminar</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <form method="GET" action="{{ route('cuenta_filtro') }}">
        <label for="codigo">Busca por <strong>código</strong></label>
        <input name="codigo" required id="codigo" type="text">
        <br>
        <label for="saldo"><strong>Saldo</strong> mínimo</label>
        <input name="saldo" required id="saldo" type="number">
        <br>
        <button class="btn btn-primary" name="filtrar" type="submit" value="AND">FiltrarAND</button>
        <button class="btn btn-primary" name="filtrar" type="submit" value="OR">FiltrarOR</button>
    </form>
@endsection