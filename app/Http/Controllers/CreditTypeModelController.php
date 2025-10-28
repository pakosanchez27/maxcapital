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
        return view('creditType.index', compact('documents', 'creditTypeDocs'));
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

    public function showDocuments($id)
    {
        $data = CreditTypeDocuementModel::docsRequeridosForId($id);
        return response()->json($data);
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
    public function update(Request $request, $id)
    {
        // 1️⃣ Obtener los datos del request
        $nombreTipo = $request->name;
        $descripcionTipo = $request->description;
        $documents = $request->documents;

        // 2️⃣ Buscar el tipo de crédito a actualizar
        $tipoCredito = CreditTypeModel::findOrFail($id);

        // 3️⃣ Actualizar los datos principales
        $tipoCredito->update([
            'name' => $nombreTipo,
            'descripcion' => $descripcionTipo
        ]);

        // 4️⃣ Eliminar relaciones anteriores en la tabla pivote
        CreditTypeDocuementModel::where('credit_type_id', $id)->delete();

        // 5️⃣ Crear nuevas relaciones con los documentos seleccionados
        if (is_array($documents) && count($documents) > 0) {
            foreach ($documents as $doc) {
                CreditTypeDocuementModel::create([
                    'credit_type_id' => $id,
                    'document_id' => $doc
                ]);
            }
        }

        // 6️⃣ Devolver una respuesta (JSON para usar con AJAX)
        return response()->json([
            'success' => true,
            'message' => 'Tipo de crédito actualizado correctamente.'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el tipo de crédito
            $creditType = CreditTypeModel::findOrFail($id);

            // Eliminar relaciones de documentos (tabla pivote)
            CreditTypeDocuementModel::where('credit_type_id', $id)->delete();

            // Eliminar el tipo de crédito
            $creditType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de crédito y documentos relacionados eliminados correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de crédito: ' . $e->getMessage()
            ], 500);
        }
    }
}
