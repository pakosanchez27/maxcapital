<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteModel;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $clientes = ClienteModel::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Expresiones Regulares
        $reCurp  = '/^[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM]'
            . '(AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TL|TS|VZ|YN|ZS|NE)'
            . '[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9]\d$/i';

        $reRfc   = '/^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/i';

        $validatedData = $request->validate([
            'nombre'        => 'required|string|max:100',
            'apellidos'   => 'required|string',
            'curp'         => ['required', 'string', 'max:18', "regex:$reCurp"],
            'whatsapp'     => 'required|string|max:15',
            'email'        => 'required|email|max:150|unique:clientes,email',
            'tipo_cliente' => 'required|string',
        ]);

        
        $cliente = ClienteModel::create([
            'nombre'        => $validatedData['nombre'],
            'apellido'     => $validatedData['apellidos'],
            'curp'         => $validatedData['curp'],
            'telefono'     => $validatedData['whatsapp'],
            'email'        => $validatedData['email'],
            'tipo_cliente' => $validatedData['tipo_cliente'],
            'registro'     => 'pakosanchez', // Aquí deberías obtener el usuario autenticado
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ClienteModel $ClienteModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteModel $ClienteModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClienteModel $ClienteModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteModel $cliente)
    {
        //
    }
}
