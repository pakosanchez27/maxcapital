@extends('layouts.app')

@section('titulo')
    Documentos
@endsection

@section('contenido')
    {{-- Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y p-5">

            <h3>Catálogos de Documentos</h3>
            <p>Crea, edita o elimina los docuementos solicitados por MaxCapital</p>


            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Documentos Requeridos</h5>
                    <button type="button" class="btn btn-primary" onclick="createDocument()">Nuevo Documento</button>
                </div>
                <div class="table-responsive text-nowrap p-2">
                    <table class="table" id="documentsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($documents as $doc)
                                <tr>
                                    <td>{{ $doc->id }}</td>
                                    <td>{{ $doc->name }}</td>
                                    <td>{{ $doc->description }}</td>
                                     <td>
                                        <button class="btn btn-sm btn-warning"
                                            onclick=" updateDocument({{ $doc->id }})"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteDocument({{ $doc->id }})"><i
                                                class="bi bi-trash3"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <!--/ Responsive Table -->
    </div>
    {{-- Modals Section  --}}

    {{-- Create Document Modal --}}

    <div class="modal fade" id="createDocument" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Nuevo Docuemento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-4">
                            <label for="nombreDocumento" class="form-label">Nombre del Docuemento</label>
                            <input type="text" id="nombreDocumento" class="form-control"
                                placeholder="Ej. Acta de Nacimiento" aria-describedby="nombreDocumentoError">
                            <div id="nombreDocumentoError" class="form-text text-danger d-none">&nbsp;</div>
                        </div>
                        <div class="col-12">
                            <label for="descriptionBasic" class="form-label">Descripción</label>
                            <textarea id="descriptionBasic" class="form-control" rows="3" placeholder="Descripción breve del documento"
                                aria-describedby="descriptionBasicError"></textarea>
                            <div id="descriptionBasicError" class="form-text text-danger d-none">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="validateFormDocument()">Guardar
                        Docuemento</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateDocument" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="documentIdUpdate" id="documentIdUpdate" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Nuevo Docuemento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-4">
                            <label for="nombreDocumentoUpdate" class="form-label">Nombre del Docuemento</label>
                            <input type="text" id="nombreDocumentoUpdate" class="form-control"
                                placeholder="Ej. Acta de Nacimiento" aria-describedby="nombreDocumentoUpdateError">
                            <div id="nombreDocumentoUpdateError" class="form-text text-danger d-none">&nbsp;</div>
                        </div>
                        <div class="col-12">
                            <label for="descriptionBasicUpdate" class="form-label">Descripción</label>
                            <textarea id="descriptionBasicUpdate" class="form-control" rows="3" placeholder="Descripción breve del documento"
                                aria-describedby="descriptionBasicUpdateError"></textarea>
                            <div id="descriptionBasicUpdateError" class="form-text text-danger d-none">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="validateFormDocumentUpdate()">Guardar
                        Docuemento</button>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @vite(['resources/js/documents.js'])
@endsection
@endsection
