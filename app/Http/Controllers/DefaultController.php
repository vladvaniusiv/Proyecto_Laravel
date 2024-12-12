<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{   
    function estadisticas(){
        //saldo máximo
        $cuenta_saldo_maximo=Cuenta::orderBy('saldo','desc')
          ->first();

        //saldo mínimo
        $cuenta_saldo_minimo=Cuenta::orderBy('saldo','asc')
          ->first();

        //total cuentas
        $total_cuentas=DB::table('cuentas')->count();
        $promedio=DB::table('cuentas')->avg('saldo');

        return view('estadisticas', [
        'cuenta_saldo_maximo' => $cuenta_saldo_maximo,
        'cuenta_saldo_minimo' => $cuenta_saldo_minimo,
        'total_cuentas' => $total_cuentas,
        'promedio' => $promedio
    ]);
    }


    function home() {
        return view('default.home');
    } 
/*
    function welcome(){ 
        $html = '<body>Bienvenido!</body>'; 
        return new Response($html); 
    }

    function ejemplo(){ 
        $grupos = array();
        
        $grupo1 = new \stdClass();
        $grupo1->codigo = '7K';
        $grupo1->denominacion = '2DAW mañana';
        $grupo2 = new \stdClass();
        $grupo2->codigo = '7W';
        $grupo2->denominacion = '2DAW tarde';
        $grupo3 = new \stdClass();
        $grupo3->codigo = '7S';
        $grupo3->denominacion = '2DAW semipresencial';

        array_push($grupos, $grupo1);
        array_push($grupos, $grupo2);
        array_push($grupos, $grupo3);
        
        return view('default.ejemplo', [
            'grupos' => $grupos
        ]);
    }*/




}

