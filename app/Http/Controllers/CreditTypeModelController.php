<?php

namespace App\Http\Controllers;

use App\Models\CreditTypeDocuementModel;
use App\Models\CreditTypeModel;
use App\Models\DocumentModel;
use Illuminate\Http\Request;

class CreditTypeModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = DocumentModel::all();
        $creditTypeDocs = CreditTypeModel::all();
        return view('creditType.index', compact('documents','creditTypeDocs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $nombreTipo = $request->name;
        $descripcionTipo = $request->description;
        $documents = $request->documents;

        // Guardar el modelo creado en una variable
        $nuevoTipoCredito = CreditTypeModel::create([
            'name' => $nombreTipo,
            'descripcion' => $descripcionTipo
        ]);

        // Obtener el ID del nuevo tipo de crédito
        $creditTypeId = $nuevoTipoCredito->id;

        // Crear relaciones entre documentos usando el ID
        foreach ($documents as $doc) {
            CreditTypeDocuementModel::create([
                'credit_type_id' => $creditTypeId, // Aquí usas el ID
                'document_id' => $doc // Asumo que $doc contiene el ID del documento
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditTypeModel $creditTypeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditTypeModel $creditTypeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CreditTypeModel $creditTypeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditTypeModel $creditTypeModel)
    {
        //
    }
}
