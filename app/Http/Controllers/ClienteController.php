<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    function list() 
    {
      $clientes = Cliente::all();

      //dump($cuentas);
      //dd($cuentas);
      return view('cliente.list', ['clientes' => $clientes]);
    }

    function modificar(Request $request, $id) 
    {
      $hoy=new \DateTime();
      $ahora=$hoy->format('d-m-Y');

      //buscar cuenta por id
      $cliente = Cliente::find($id);
      if ($request->isMethod('post')) {   
      
        // Validate
        $validated = $request->validate([
          'dni' => [
                'required',
                'size:9',
                Rule::unique('clientes')->ignore($cliente->id), // Ignorar el cliente actual para evitar conflicto
            ],
          'nombre' => 'required',
          'apellidos' => 'required',
          'fechaN' => 'required|date|before_or_equal:'.$ahora,
        ]);

        // recogemos los campos del formulario en un objeto cuenta

        $cliente->dni = $request->dni;
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->fechaN = $request->fechaN;
        if($request->file('imagen')){
          if ($cliente->imagen) {
              File::delete(public_path('uploads/imagenes/' . $cliente->imagen));
          }
          $file = $request->file('imagen');
          $extension = $file->getClientOriginalExtension();
          $filename = $request->nombre . '_' . $request->apellidos . '_' . uniqid() . '.' . $extension;
          // guardamos en una variable $filename el nombre que pondremos al fichero
          $file->move(public_path('uploads/imagenes'), $filename);
          $cliente->imagen = $filename;
        }
        if ($request->borrar) {
          if ($cliente->imagen) {
              File::delete(public_path('uploads/imagenes/' . $cliente->imagen));
          }
          $cliente->imagen = null;
        }
        
        $cliente->save();
        //dd($cliente);
        return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->nombreApellidos().' editado!');
    }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    return view('cliente.modificar', ['cliente' => $cliente]);
    
  }

    function new(Request $request){
      $hoy=new \DateTime();
      $ahora=$hoy->format('d-m-Y');
    
      if ($request->isMethod('post')) {    
        // Validate
        $validated = $request->validate([
          'dni' => 'required|unique:clientes|size:9',
          'nombre' => 'required',
          'apellidos' => 'required',
          'fechaN' => 'required|before_or_equal:'.$ahora,
        ],[
        'fechaN.required' => 'El campo Fecha de nacimiento es obligatorio',
      ]);

          

          // recogemos los campos del formulario en un objeto cliente
          $cliente = new Cliente;
          $cliente->dni = $request->dni;
          $cliente->nombre = $request->nombre;
          $cliente->apellidos = $request->apellidos;
          $cliente->fechaN = $request->fechaN;
          if($request->file('imagen')){
            $file = $request->file('imagen');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nombre . '_' . $request->apellidos . '_' . uniqid() . '.' . $extension;
            // guardamos en una variable $filename el nombre que pondremos al fichero
            $file->move(public_path('uploads/imagenes'), $filename);
            $cliente->imagen = $filename;
          }
          $cliente->id = $request->id;
          $cliente->save();
          return redirect()->route('cliente_list')->with('status', 'Nuevo cliente '.$cliente->nombreApellidos().' creado!');
      }
      

    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    return view('cliente.new');
  }

  function delete($id) 
  { 
    $cliente = Cliente::find($id);
   // dd($cuenta);
    $cliente->delete();

    return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->nombreApellidos().' eliminado!');
  }
}
