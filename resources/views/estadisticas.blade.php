@extends('layout')

@section('title', 'Estadisticas de cuentas')
@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Estadísticas</h1>
    <h2>Cuenta con saldo máximo</h2>
    <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;margin-bottom: 10px; text-align:center">
        <thead class="table-success">
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ $cuenta_saldo_maximo->codigo }}</td>
                <td>{{ $cuenta_saldo_maximo->saldo }}</td>
                <td>
                    @isset($cuenta_saldo_maximo->cliente)
                        {{ $cuenta_saldo_maximo->cliente->nombreApellidos() }}
                    @endisset
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2>Cuenta con saldo mínimo</h2>
    <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;margin-bottom: 10px; text-align:center">
        <thead class="table-success">
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ $cuenta_saldo_minimo->codigo }}</td>
                <td>{{ $cuenta_saldo_minimo->saldo }}</td>
                <td>
                    @isset($cuenta_saldo_minimo->cliente)
                        {{ $cuenta_saldo_minimo->cliente->nombreApellidos() }}
                    @endisset
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    
    <h2>Total cuentas</h2>
    <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;margin-bottom: 10px; text-align:center">
        <thead class="table-success">
            <tr>
                <th>Saldo promedio</th><th>Cantidad cuentas</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ round($promedio,2) }}</td>
                <td>{{ $total_cuentas }}</td>
            </tr>
        </tbody>
    </table>
    <br>
@endsection