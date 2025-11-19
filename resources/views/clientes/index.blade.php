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
            <th>Tipo de Cliente</th>
            <th>Status</th>
            <th>Acciones</th> {{-- Nueva columna --}}
        </tr>
    </thead>

    <tbody class="table-border-bottom-0">

        {{-- 
            STATUS DEL CLIENTE:
            0 = Sin crédito   → Naranja  (badge bg-warning)
            1 = En proceso    → Azul     (badge bg-primary)
            2 = Activo        → Verde    (badge bg-success)
        --}}

        @foreach ($clientes as $cliente)
            <tr class="align-middle">
                <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->tipo_cliente }}</td>
                <td>
                    @if ($cliente->status == 0)
                        <span class="badge bg-warning text-dark">Sin crédito</span>
                    @elseif ($cliente->status == 1)
                        <span class="badge bg-primary">En proceso</span>
                    @elseif ($cliente->status == 2)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Desconocido</span>
                    @endif
                </td>

                {{-- 🌟 ACCIONES --}}
                <td>
                    <a href="" class="btn btn-info btn-sm me-1">
                        Ver
                    </a>

                    <a href="" class="btn btn-warning btn-sm me-1">
                        Editar
                    </a>

                    <form action="" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
                confirmButtonColor: '#696cff', // color primario de Sneat
            });
        </script>
    @endif
@endsection
