@extends('layouts.app')

@section('titulo')
    Clientes
@endsection

@section('contenido')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y p-5">
            <h3>Alta de clientes</h3>
            <p>Registro inical de propospectos</p>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Prospectos</h5>
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary text-white">
                        Nuevo Cliente
                    </a>
                </div>
                <div class="table-responsive text-nowrap p-2">
                    <table class="table" id="creditTypesTable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Credito Solicitado</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
