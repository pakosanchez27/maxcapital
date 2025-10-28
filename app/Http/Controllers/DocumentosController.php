<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocuementModel;
use App\Models\DocumentModel;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = DocumentModel::all();
        return view('documentos.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function store(Request $request)
    {   
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new document record
        $document = DocumentModel::create($validatedData);

        return response()->json(['message' => 'Documento creado con éxito', 'document' => $document], 201);
    }

 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $document = DocumentModel::findOrFail($id);
        return response()->json($document); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $document = DocumentModel::findOrFail($id);
        $document->update($validatedData);

        return response()->json(['message' => 'Documento actualizado con éxito', 'document' => $document], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = DocumentModel::findOrFail($id);
        $document->delete();

        return response()->json(['message' => 'Documento eliminado con éxito'], 200);
    }
}
