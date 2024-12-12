<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    function filtro(Request $request){
      $codigo=$request->codigo;
      $saldo=$request->saldo;
      $filtrar = $request->filtrar;

      if($filtrar=='AND'){
        $cuentas = Cuenta::buscaCodigoANDSaldo($codigo,$saldo);
      }else{
        $cuentas = Cuenta::buscaCodigoORSaldo($codigo,$saldo);
      }
      
        return view('cuenta.list', ['cuentas' => $cuentas,
          'mensajeCodigo' => 'Filtrado por código: ' . $codigo,
          'operador' => $filtrar,
          'mensajeSaldo' => 'Filtrado por saldo: ' . $saldo
        ]);
      
  }
  
    function list() 
    {
      //$cuentas = Cuenta::all();
      $cuentas=Cuenta::orderBy('saldo','desc')
          ->get();

      //dump($cuentas);
      //dd($cuentas);
      return view('cuenta.list', ['cuentas' => $cuentas]);
    }

    function modificar(Request $request, $id) 
    {
      //buscar cuenta por id
      $cuenta = Cuenta::find($id);
      if ($request->isMethod('post')) {    

        // Validate
        $validated = $request->validate([
            'codigo' => [
            'required',
            'max:10',
            Rule::unique('cuentas')->ignore($cuenta->id),
          ],
          'saldo' => 'required',
        ]);

        // recogemos los campos del formulario en un objeto cuenta

        $cuenta->codigo = $request->codigo;
        $cuenta->saldo = $request->saldo;
        $cuenta->cliente_id = $request->cliente_id;
        $cuenta->save();
        
        return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' editada!');
    }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $clientes = Cliente::all();

    return view('cuenta.modificar', ['clientes' => $clientes, 'cuenta' => $cuenta]);
  }

    function new(Request $request) 
    {
      if ($request->isMethod('post')) {   
          // Validate
          $validated = $request->validate([
            'codigo' => 'required|unique:cuentas|max:10',
            'saldo' => 'required',
        ]);
        

          // recogemos los campos del formulario en un objeto cuenta

          $cuenta = new Cuenta;
          $cuenta->codigo = $request->codigo;
          $cuenta->saldo = $request->saldo;
          $cuenta->cliente_id = $request->cliente_id ?: null;
          $cuenta->save();
          return redirect()->route('cuenta_list')->with('status', 'Nueva cuenta '.$cuenta->codigo.' creada!');
      }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $clientes = Cliente::all();

    return view('cuenta.new', ['clientes' => $clientes]);
  }

  function delete($id) 
  { 
    $cuenta = Cuenta::find($id);
   // dd($cuenta);
    $cuenta->delete();

    return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' eliminada!');
  }
}
