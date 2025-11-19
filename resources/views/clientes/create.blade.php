@extends('layouts.app')

@section('titulo')
    Alta de Cliente
@endsection

@section('contenido')
    {{-- Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y p-5">

            <form id="altaClienteForm" class="card p-4" method="POST" action="{{ route('clientes.store') }}">
                @csrf

                <h3 class="mb-4">Alta de Clientes Nuevos</h3>

                <!-- Tipo de Cliente -->
                <div class="mb-3">
                    <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                    <select class="form-select @error('tipo_cliente') is-invalid @enderror" id="tipo_cliente"
                        name="tipo_cliente" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="fisica" {{ old('tipo_cliente') == 'fisica' ? 'selected' : '' }}>Persona Física
                        </option>
                        <option value="moral" {{ old('tipo_cliente') == 'moral' ? 'selected' : '' }}>Persona Moral</option>
                    </select>
                    @error('tipo_cliente')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Nota -->
                    <small class="form-text text-muted mt-1">
                        Si se escoge persona moral, los datos a ingresar en este formulario son del representante legal de
                        la empresa.
                    </small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre (S)</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                            name="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos"
                            name="apellidos" value="{{ old('apellidos') }}" placeholder="Ingresa los apellidos" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" class="form-control @error('curp') is-invalid @enderror" id="curp"
                            name="curp" value="{{ old('curp') }}" placeholder="Ingresa la CURP" required>
                        @error('curp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="whatsapp" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp"
                            name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Ej: 55 1234 5678" required>
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Crear Cliente
                    </button>
                </div>

            </form>



        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function() {
            const tipoCliente = document.getElementById('tipo_cliente');
            const tipoCredito = document.getElementById('tipo_credito');

            const blocks = {
                'fisica-simple': document.getElementById('fisica-simple'),
                'fisica-arrendamiento': document.getElementById('fisica-arrendamiento'),
                'moral-simple': document.getElementById('moral-simple'),
                'moral-arrendamiento': document.getElementById('moral-arrendamiento'),
                'inversionistas': document.getElementById('bloque-inversionistas'),
            };

            function hideAll() {
                Object.values(blocks).forEach(el => el && el.classList.add('d-none'));
            }

            function toggleBlocks() {
                hideAll();
                const tc = tipoCliente.value;
                const cr = tipoCredito.value;

                if (tc === 'inversionistas') {
                    blocks['inversionistas'].classList.remove('d-none');
                    return;
                }
                if (!tc || !cr) return;

                const key = `${tc}-${cr}`;
                const el = blocks[key];
                if (el) el.classList.remove('d-none');
            }

            tipoCliente.addEventListener('change', toggleBlocks);
            tipoCredito.addEventListener('change', toggleBlocks);

            // ====== Repetidores ======
            function repeater(wrapperId, namePrefix) {
                const wrapper = document.getElementById(wrapperId);
                let idx = 0;

                function addRow() {
                    const row = document.createElement('div');
                    row.className = 'row g-2 align-items-end mb-2';
                    row.innerHTML = `
                <div class="col-md-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="${namePrefix}[${idx}][nombre]">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Puesto / Empresa</label>
                    <input type="text" class="form-control" name="${namePrefix}[${idx}][empresa_puesto]">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="${namePrefix}[${idx}][telefono]">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Ext.</label>
                    <input type="text" class="form-control" name="${namePrefix}[${idx}][extension]">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="${namePrefix}[${idx}][email]">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-row">Quitar</button>
                </div>`;
                    wrapper.appendChild(row);
                    row.querySelector('.remove-row').addEventListener('click', () => row.remove());
                    idx++;
                }
                return {
                    addRow
                };
            }

            const rContactos = repeater('contactos-wrapper', 'contactos');
            const rReferPF = repeater('referencias-wrapper', 'referencias');
            const rReferPF2 = repeater('referencias2-wrapper', 'referencias2');
            const rContactosM = repeater('contactos-m-wrapper', 'contactos_m');
            const rReferM = repeater('referencias-m-wrapper', 'referencias_m');
            const rRefAdmin = repeater('refs-admin-wrapper', 'referencias_admin');
            const rReferMA = repeater('referencias-ma-wrapper', 'referencias_ma');
            const rRefAdminMA = repeater('refs-admin-ma-wrapper', 'referencias_admin_ma');

            // Botones add
            document.getElementById('add-contacto')?.addEventListener('click', rContactos.addRow);
            document.getElementById('add-referencia')?.addEventListener('click', rReferPF.addRow);
            document.getElementById('add-referencia2')?.addEventListener('click', rReferPF2.addRow);
            document.getElementById('add-contacto-m')?.addEventListener('click', rContactosM.addRow);
            document.getElementById('add-referencia-m')?.addEventListener('click', rReferM.addRow);
            document.getElementById('add-ref-admin')?.addEventListener('click', rRefAdmin.addRow);
            document.getElementById('add-referencia-ma')?.addEventListener('click', rReferMA.addRow);
            document.getElementById('add-ref-admin-ma')?.addEventListener('click', rRefAdminMA.addRow);

            // Arranque
            toggleBlocks();
        })();
    </script>
@endsection
