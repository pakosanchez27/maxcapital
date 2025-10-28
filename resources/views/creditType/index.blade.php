@extends('layouts.app')

@section('titulo')
    Tipos de Crédito
@endsection

@section('contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y p-5">

            <h3>Catálogos de Tipos de Crédito</h3>
            <p>Crea, edita o elimina los tipos de crédito disponibles en MaxCapital</p>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tipos de Crédito</h5>
                    <button type="button" class="btn btn-primary" onclick="createCreditType()">
                        Nuevo Tipo de Crédito
                    </button>
                </div>
                <div class="table-responsive text-nowrap p-2">
                    <table class="table" id="creditTypesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Documentos Requeridos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($creditTypeDocs as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td><button type="button" class="btn btn-info" data-bs-dismiss="modal"
                                            onclick="showDocuments({{ $type->id }})"><i
                                                class="bi bi-file-bar-graph"></i>Ver Documentos</button></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="updateDocument()"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteDocument()"><i
                                                class="bi bi-trash3"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <!--/ Responsive Table -->
        </div>
        {{-- Modal Section --}}

        {{-- Create Credit Type Modal --}}
        <div class="modal fade" id="createCreditType" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Nuevo Tipo de Credito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="creditTypeName" class="form-label">Tipo de credito</label>
                                <input type="text" id="creditTypeName" class="form-control" placeholder="Ej. Empresa"
                                    aria-describedby="creditTypeNameError">
                                <div id="creditTypeNameError" class="form-text text-danger d-none">&nbsp;</div>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="creditTypeDescription" class="form-label">Descripción</label>
                                <textarea id="creditTypeDescription" class="form-control" rows="3" placeholder="Descripción del tipo de crédito"
                                    aria-describedby="creditTypeDescriptionError"></textarea>
                                <div id="creditTypeDescriptionError" class="form-text text-danger d-none">&nbsp;</div>

                            </div>
                            <div class="col-12">
                                <label for="select2Multiple" class="form-label">Documentos Rqueridos</label>
                                <select id="select2Multiple" class="select2 form-select" multiple>
                                    @foreach ($documents as $doc)
                                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                                    @endforeach
                                </select>
                                <div id="select2MultipleError" class="form-text text-danger d-none">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="validateFormCreditType()">Guardar
                            Docuemento</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Show Documents --}}
        </button>
        <!-- Modal -->
        <div class="modal fade" id="showDocuments" tabindex="-1" aria-labelledby="modalScrollableTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Documentos requeridos para <span id="tipo_credito"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(function() {
                $('#select2Multiple').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Selecciona uno o varios…',
                    closeOnSelect: false, // no cerrar al elegir (más cómodo para multi)
                    allowClear: true, // muestra botón para limpiar todo
                    dropdownParent: $('#select2Multiple').parent() // evita issues en modales
                    // tags: true, // ← activa si QUIERES permitir escribir etiquetas libres
                });
            });
        </script>

        @vite('resources/js/creditType.js')
    @endsection
