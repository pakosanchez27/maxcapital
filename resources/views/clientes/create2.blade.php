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

                {{-- Selecciones iniciales --}}
                {{-- Selecciones iniciales --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Tipo de cliente</label>
                        <select id="tipo_cliente" name="tipo_cliente" class="form-select" required>
                            <option value="" disabled {{ old('tipo_cliente') ? '' : 'selected' }}>Selecciona…</option>
                            <option value="fisica" {{ old('tipo_cliente') == 'fisica' ? 'selected' : '' }}>Física</option>
                            <option value="moral" {{ old('tipo_cliente') == 'moral' ? 'selected' : '' }}>Moral</option>
                            <option value="inversionistas" {{ old('tipo_cliente') == 'inversionistas' ? 'selected' : '' }}>
                                Inversionistas</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipo de crédito</label>
                        <select id="tipo_credito" name="tipo_credito" class="form-select" required>
                            <option value="" disabled {{ old('tipo_credito') ? '' : 'selected' }}>Selecciona…</option>
                            <option value="simple" {{ old('tipo_credito') == 'simple' ? 'selected' : '' }}>Crédito Simple
                            </option>
                            <option value="arrendamiento" {{ old('tipo_credito') == 'arrendamiento' ? 'selected' : '' }}>
                                Arrendamiento</option>
                        </select>
                    </div>
                </div>

                {{-- PLACEHOLDER Inversionistas --}}
                <div id="bloque-inversionistas" class="d-none">
                    <div class="alert alert-info">
                        Sección de <strong>inversionistas</strong> (deja este espacio para completar después).
                    </div>
                </div>

                {{-- =========================
                     FÍSICA + SIMPLE
                ========================== --}}
                <div id="fisica-simple" class="d-none">
                    <hr class="my-4">
                    <h5 class="mb-3">Datos Generales (Persona Física)</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre (completo y sin abreviaturas)</label>
                            <input type="text" class="form-control" name="fisica[nombres]"
                                placeholder="Nombre(s) y apellidos">
                            @error('fisica.nombres')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Edad</label>
                            <input type="number" class="form-control" name="fisica[edad]" min="18">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ocupación / Profesión / Giro</label>
                            <input type="text" class="form-control" name="fisica[ocupacion]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Género</label>
                            <input type="text" class="form-control" name="fisica[genero]" placeholder="M / F / X">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fisica[fecha_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Lugar de nacimiento</label>
                            <input type="text" class="form-control" name="fisica[lugar_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de nacimiento</label>
                            <input type="text" class="form-control" name="fisica[pais_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="fisica[nacionalidad]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control" name="fisica[curp]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="fisica[rfc]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado civil</label>
                            <input type="text" class="form-control" name="fisica[estado_civil]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Régimen conyugal</label>
                            <input type="text" class="form-control" name="fisica[regimen_conyugal]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="fisica[email]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Número de Serie FIEL</label>
                            <input type="text" class="form-control" name="fisica[numero_serial_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Identificación</label>
                            <input type="text" class="form-control" name="fisica[tipo_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Folio Identificación</label>
                            <input type="text" class="form-control" name="fisica[folio_identificacion]">
                        </div>
                    </div>

                    <h6 class="mt-4">Domicilio</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" name="domicilio[calle]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número exterior</label>
                            <input type="text" class="form-control" name="domicilio[numero_ext]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número interior</label>
                            <input type="text" class="form-control" name="domicilio[numero_int]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="domicilio[colonia]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="domicilio[codigo_postal]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Alcaldía o Municipio</label>
                            <input type="text" class="form-control" name="domicilio[municipio]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="domicilio[estado]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">País de residencia</label>
                            <input type="text" class="form-control" name="domicilio[pais_residencia]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono Particular</label>
                            <input type="text" class="form-control" name="telefonos[telefono_casa]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono Celular</label>
                            <input type="text" class="form-control" name="telefonos[telefono_movil]">
                        </div>
                    </div>

                    <h6 class="mt-4">Información del Crédito</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Importe solicitado ($)</label>
                            <input type="number" step="0.01" class="form-control"
                                name="credito[importe_solicitado]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Plazo en meses</label>
                            <input type="number" class="form-control" name="credito[plazo_meses]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Producto solicitado</label>
                            <input type="text" class="form-control" name="credito[producto_solicitado]"
                                value="Crédito Simple">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Destino del crédito</label>
                            <input type="text" class="form-control" name="credito[destino_credito]"
                                placeholder="Capital de Trabajo">
                        </div>
                    </div>

                    <h6 class="mt-4">Cuenta de Depósito</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Institución Bancaria</label>
                            <input type="text" class="form-control" name="cuenta_deposito[institucion_bancaria]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito[tipo_cuenta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito[numero_cuenta]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">CLABE</label>
                            <input type="text" class="form-control" name="cuenta_deposito[clabe_interbancaria]">
                        </div>
                    </div>

                    <h6 class="mt-4">Cuenta de Pago</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Institución Bancaria</label>
                            <input type="text" class="form-control" name="cuenta_pago[institucion_bancaria]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_pago[tipo_cuenta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_pago[numero_cuenta]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">CLABE</label>
                            <input type="text" class="form-control" name="cuenta_pago[clabe_interbancaria]">
                        </div>
                    </div>

                    <h6 class="mt-4">Contactos para fines de cobranza</h6>
                    <div id="contactos-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-contacto">+ Agregar
                        contacto</button>

                    <h6 class="mt-4">Referencias Comerciales</h6>
                    <div id="referencias-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-referencia">+ Agregar
                        referencia</button>
                </div>

                {{-- =========================
                     FÍSICA + ARRENDAMIENTO
                ========================== --}}
                <div id="fisica-arrendamiento" class="d-none">
                    <hr class="my-4">
                    <h5 class="mb-3">Datos Generales del Solicitante (Persona Física)</h5>
                    {{-- Reutilizamos los mismos campos de PF --}}
                    {{-- Para no duplicar, puedes reutilizar por JS o servidor. Aquí los repito por claridad: --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre (completo y sin abreviaturas)</label>
                            <input type="text" class="form-control" name="fisica2[nombres]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Edad</label>
                            <input type="number" class="form-control" name="fisica2[edad]" min="18">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ocupación / Profesión / Giro</label>
                            <input type="text" class="form-control" name="fisica2[ocupacion]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Género</label>
                            <input type="text" class="form-control" name="fisica2[genero]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fisica2[fecha_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Lugar de nacimiento</label>
                            <input type="text" class="form-control" name="fisica2[lugar_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de nacimiento</label>
                            <input type="text" class="form-control" name="fisica2[pais_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="fisica2[nacionalidad]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control" name="fisica2[curp]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="fisica2[rfc]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado civil</label>
                            <input type="text" class="form-control" name="fisica2[estado_civil]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Régimen conyugal</label>
                            <input type="text" class="form-control" name="fisica2[regimen_conyugal]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="fisica2[email]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Número de Serie FIEL</label>
                            <input type="text" class="form-control" name="fisica2[numero_serial_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Identificación</label>
                            <input type="text" class="form-control" name="fisica2[tipo_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Folio Identificación</label>
                            <input type="text" class="form-control" name="fisica2[folio_identificacion]">
                        </div>
                    </div>

                    <h6 class="mt-4">Domicilio</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" name="domicilio2[calle]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número exterior</label>
                            <input type="text" class="form-control" name="domicilio2[numero_ext]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número interior</label>
                            <input type="text" class="form-control" name="domicilio2[numero_int]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="domicilio2[colonia]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="domicilio2[codigo_postal]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Alcaldía/Municipio</label>
                            <input type="text" class="form-control" name="domicilio2[municipio]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="domicilio2[estado]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de residencia</label>
                            <input type="text" class="form-control" name="domicilio2[pais_residencia]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono Particular</label>
                            <input type="text" class="form-control" name="telefonos2[telefono_casa]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono Celular</label>
                            <input type="text" class="form-control" name="telefonos2[telefono_movil]">
                        </div>
                    </div>

                    <h6 class="mt-4">Información del Crédito (Arrendamiento)</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Importe solicitado ($)</label>
                            <input type="number" step="0.01" class="form-control"
                                name="credito2[importe_solicitado]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Plazo en meses</label>
                            <input type="number" class="form-control" name="credito2[plazo_meses]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Producto solicitado</label>
                            <input type="text" class="form-control" name="credito2[producto_solicitado]"
                                value="Arrendamiento">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Destino del crédito</label>
                            <input type="text" class="form-control" name="credito2[destino_credito]">
                        </div>
                    </div>

                    <h6 class="mt-4">Referencias Comerciales</h6>
                    <div id="referencias2-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-referencia2">+ Agregar
                        referencia</button>
                </div>

                {{-- =========================
                     MORAL + SIMPLE
                ========================== --}}
                <div id="moral-simple" class="d-none">
                    <hr class="my-4">
                    <h5>Datos del Solicitante (Persona Moral)</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Denominación o razón social</label>
                            <input type="text" class="form-control" name="moral[razon_social]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giro/Actividad/Objeto social</label>
                            <input type="text" class="form-control" name="moral[giro]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="moral[rfc]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de Constitución</label>
                            <input type="date" class="form-control" name="moral[fecha_constitucion]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de Constitución</label>
                            <input type="text" class="form-control" name="moral[pais_constitucion]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="moral[nacionalidad]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Serie FIEL</label>
                            <input type="text" class="form-control" name="moral[numero_serie_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. CONDUSEF</label>
                            <input type="text" class="form-control" name="moral[numero_condusef]">
                        </div>
                    </div>

                    <h6 class="mt-4">Domicilio (Persona Moral)</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tipo de domicilio</label>
                            <select class="form-select" name="domicilio_moral[tipo_domicilio]">
                                <option value="" selected disabled>Selecciona…</option>
                                <option value="Fiscal">Fiscal (Propio)</option>
                                <option value="Arrendado">Rentado Convencional</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Importe de renta</label>
                            <input type="number" step="0.01" class="form-control"
                                name="domicilio_moral[importe_renta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vencimiento de contrato</label>
                            <input type="date" class="form-control" name="domicilio_moral[vencimiento_contrato]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" name="domicilio_moral[calle]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número exterior</label>
                            <input type="text" class="form-control" name="domicilio_moral[numero_ext]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número interior</label>
                            <input type="text" class="form-control" name="domicilio_moral[numero_int]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Alcaldía/Municipio</label>
                            <input type="text" class="form-control" name="domicilio_moral[municipio]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="domicilio_moral[estado]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="domicilio_moral[colonia]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="domicilio_moral[codigo_postal]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ciudad / Población</label>
                            <input type="text" class="form-control" name="domicilio_moral[ciudad]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de Residencia</label>
                            <input type="text" class="form-control" name="domicilio_moral[pais_residencia]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono(s)</label>
                            <input type="text" class="form-control" name="telefonos_moral">
                        </div>
                    </div>

                    <h6 class="mt-4">Representante Legal / Administrador Único</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre (completo y sin abreviaturas)</label>
                            <input type="text" class="form-control" name="rep_legal[nombre]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="rep_legal[fecha_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Género</label>
                            <input type="text" class="form-control" name="rep_legal[genero]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de nacimiento</label>
                            <input type="text" class="form-control" name="rep_legal[pais_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Lugar de nacimiento</label>
                            <input type="text" class="form-control" name="rep_legal[lugar_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control" name="rep_legal[curp]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="rep_legal[nacionalidad]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="rep_legal[email]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="rep_legal[rfc]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="rep_legal[telefono]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. serie FIEL</label>
                            <input type="text" class="form-control" name="rep_legal[numero_serie_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo de identificación</label>
                            <input type="text" class="form-control" name="rep_legal[tipo_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Folio identificación</label>
                            <input type="text" class="form-control" name="rep_legal[folio_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado civil</label>
                            <input type="text" class="form-control" name="rep_legal[estado_civil]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Régimen conyugal</label>
                            <input type="text" class="form-control" name="rep_legal[regimen_conyugal]">
                        </div>
                    </div>

                    <h6 class="mt-4">Información del Crédito</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Importe solicitado ($)</label>
                            <input type="number" step="0.01" class="form-control"
                                name="credito_moral[importe_solicitado]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Plazo en meses</label>
                            <input type="number" class="form-control" name="credito_moral[plazo_meses]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Producto solicitado</label>
                            <input type="text" class="form-control" name="credito_moral[producto_solicitado]"
                                value="Crédito Simple">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Destino del crédito</label>
                            <input type="text" class="form-control" name="credito_moral[destino_credito]"
                                value="Consumo">
                        </div>
                    </div>

                    <h6 class="mt-4">Cuenta de Depósito</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Institución Bancaria</label>
                            <input type="text" class="form-control" name="cuenta_deposito_m[institucion_bancaria]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito_m[tipo_cuenta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito_m[numero_cuenta]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">CLABE</label>
                            <input type="text" class="form-control" name="cuenta_deposito_m[clabe_interbancaria]">
                        </div>
                    </div>

                    <h6 class="mt-4">Cuenta de Pago</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Institución Bancaria</label>
                            <input type="text" class="form-control" name="cuenta_pago_m[institucion_bancaria]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_pago_m[tipo_cuenta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_pago_m[numero_cuenta]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">CLABE</label>
                            <input type="text" class="form-control" name="cuenta_pago_m[clabe_interbancaria]">
                        </div>
                    </div>

                    <h6 class="mt-4">Contactos para fines de cobranza</h6>
                    <div id="contactos-m-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-contacto-m">+ Agregar
                        contacto</button>

                    <h6 class="mt-4">Referencias Comerciales</h6>
                    <div id="referencias-m-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-referencia-m">+ Agregar
                        referencia</button>

                    <h6 class="mt-4">Referencias Administrativas</h6>
                    <div id="refs-admin-wrapper"></div>
                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" id="add-ref-admin">+ Agregar
                        ref. administrativa</button>
                </div>

                {{-- =========================
                     MORAL + ARRENDAMIENTO
                ========================== --}}
                <div id="moral-arrendamiento" class="d-none">
                    <hr class="my-4">
                    <h5>Datos del Solicitante (Persona Moral) - Arrendamiento</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Denominación o razón social</label>
                            <input type="text" class="form-control" name="moral2[razon_social]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giro/Actividad/Objeto social</label>
                            <input type="text" class="form-control" name="moral2[giro]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="moral2[rfc]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de Constitución</label>
                            <input type="date" class="form-control" name="moral2[fecha_constitucion]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de Constitución</label>
                            <input type="text" class="form-control" name="moral2[pais_constitucion]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="moral2[nacionalidad]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Serie FIEL</label>
                            <input type="text" class="form-control" name="moral2[numero_serie_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. CONDUSEF</label>
                            <input type="text" class="form-control" name="moral2[numero_condusef]">
                        </div>
                    </div>

                    <h6 class="mt-4">Domicilio (Persona Moral)</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tipo de domicilio</label>
                            <select class="form-select" name="domicilio_moral2[tipo_domicilio]">
                                <option value="" selected disabled>Selecciona…</option>
                                <option value="Fiscal">Fiscal (Propio)</option>
                                <option value="Arrendado">Rentado Convencional</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Importe de renta</label>
                            <input type="number" step="0.01" class="form-control"
                                name="domicilio_moral2[importe_renta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vencimiento de contrato</label>
                            <input type="date" class="form-control" name="domicilio_moral2[vencimiento_contrato]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" name="domicilio_moral2[calle]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número exterior</label>
                            <input type="text" class="form-control" name="domicilio_moral2[numero_ext]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número interior</label>
                            <input type="text" class="form-control" name="domicilio_moral2[numero_int]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Alcaldía/Municipio</label>
                            <input type="text" class="form-control" name="domicilio_moral2[municipio]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="domicilio_moral2[estado]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="domicilio_moral2[colonia]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="domicilio_moral2[codigo_postal]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ciudad / Población</label>
                            <input type="text" class="form-control" name="domicilio_moral2[ciudad]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de Residencia</label>
                            <input type="text" class="form-control" name="domicilio_moral2[pais_residencia]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono(s)</label>
                            <input type="text" class="form-control" name="telefonos_moral2">
                        </div>
                    </div>

                    <h6 class="mt-4">Representante Legal / Administrador Único</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre (completo y sin abreviaturas)</label>
                            <input type="text" class="form-control" name="rep_legal2[nombre]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="rep_legal2[fecha_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Género</label>
                            <input type="text" class="form-control" name="rep_legal2[genero]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País de nacimiento</label>
                            <input type="text" class="form-control" name="rep_legal2[pais_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Lugar de nacimiento</label>
                            <input type="text" class="form-control" name="rep_legal2[lugar_nacimiento]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control" name="rep_legal2[curp]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" name="rep_legal2[nacionalidad]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="rep_legal2[email]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="rep_legal2[rfc]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="rep_legal2[telefono]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. serie FIEL</label>
                            <input type="text" class="form-control" name="rep_legal2[numero_serie_fiel]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo de identificación</label>
                            <input type="text" class="form-control" name="rep_legal2[tipo_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Folio identificación</label>
                            <input type="text" class="form-control" name="rep_legal2[folio_identificacion]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado civil</label>
                            <input type="text" class="form-control" name="rep_legal2[estado_civil]">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Régimen conyugal</label>
                            <input type="text" class="form-control" name="rep_legal2[regimen_conyugal]">
                        </div>
                    </div>

                    <h6 class="mt-2">Información del Crédito</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Importe solicitado ($)</label>
                            <input type="number" step="0.01" class="form-control"
                                name="credito_moral_arr[importe_solicitado]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Plazo en meses</label>
                            <input type="number" class="form-control" name="credito_moral_arr[plazo_meses]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Producto solicitado</label>
                            <input type="text" class="form-control" name="credito_moral_arr[producto_solicitado]"
                                value="Arrendamiento">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Destino del crédito</label>
                            <input type="text" class="form-control" name="credito_moral_arr[destino_credito]">
                        </div>
                    </div>

                    <h6 class="mt-4">Cuenta de Depósito</h6>
                    <div id="cuenta-dep-arr" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Institución Bancaria</label>
                            <input type="text" class="form-control" name="cuenta_deposito_arr[institucion_bancaria]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito_arr[tipo_cuenta]">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" name="cuenta_deposito_arr[numero_cuenta]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">CLABE</label>
                            <input type="text" class="form-control" name="cuenta_deposito_arr[clabe_interbancaria]">
                        </div>
                    </div>

                    <h6 class="mt-4">Referencias Comerciales</h6>
                    <div id="referencias-ma-wrapper"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-referencia-ma">+ Agregar
                        referencia</button>

                    <h6 class="mt-4">Referencias Administrativas</h6>
                    <div id="refs-admin-ma-wrapper"></div>
                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" id="add-ref-admin-ma">+ Agregar
                        ref. administrativa</button>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-label-secondary">Cancelar</a>
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
