<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clientes.index');
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
        // Vaidate
        // dd($request->all());

        // Expresiones Regulares
        $reCurp  = '/^[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM]'
            . '(AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TL|TS|VZ|YN|ZS|NE)'
            . '[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9]\d$/i';

        $reRfc   = '/^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/i';


        if ($request->tipo_cliente === 'fisica' && $request->tipo_credito === 'simple') {
            $validate = $request->validate([
                'fisica.nombres' => 'required'
            ]);
        } elseif ($request->tipo_cliente === 'fisica' && $request->tipo_credito === 'arrendamiento') {
            echo 'credito arrendamiento fisico';
        } elseif ($request->tipo_cliente === 'moral' && $request->tipo_credito === 'simple') {
            echo 'credito simple moral';
        } elseif ($request->tipo_cliente === 'moral' && $request->tipo_credito === 'arrendamiento') {
            echo 'credito arrendamiento moral';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
