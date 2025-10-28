
const baseUrl = window.location.origin;


function createCreditType() {

    $('#createCreditType').modal('show');

}

function validateFormCreditType() {
    let name = $('#creditTypeName').val();
    let description = $('#creditTypeDescription').val();
    let selectedDocuments = $('#select2Multiple').val();

    // Clear previous validation state
    $('#creditTypeName').removeClass('is-invalid');
    $('#creditTypeNameError').addClass('d-none').text('');
    // Clear description validation state
    $('#creditTypeDescription').removeClass('is-invalid');
    $('#creditTypeDescriptionError').addClass('d-none').text('');


    // Validate name field
    let valid = true;

    if (!name || name.trim() === '') {
        $('#creditTypeName').addClass('is-invalid');
        $('#creditTypeNameError').removeClass('d-none').text('Por favor ingrese el nombre del tipo de crédito.');
        valid = false;
    }
    if (!description || description.trim() === '') {
        $('#creditTypeDescription').addClass('is-invalid');
        $('#creditTypeDescriptionError').removeClass('d-none').text('Por favor ingrese la descripción del tipo de crédito.');
        valid = false;
    }

    // // Validar select2 correctamente (array y no vacío)
    // if (!Array.isArray(selectedDocuments) || selectedDocuments.length === 0 || (selectedDocuments.length === 1 && selectedDocuments[0] === '')) {
    //     $('#select2Multiple').addClass('is-invalid');
    //     $('#select2MultipleError').removeClass('d-none').text('Por favor seleccione al menos un documento requerido.');
    //     valid = false;
    // }


    if (!valid) {
        return;
    }

    // Objeto con los datos a enviar    
    const creditTypeData = {
        name: name,
        description: description,
        documents: selectedDocuments
    };

    saveCreditTypeEdit(creditTypeData);


}

function saveCreditTypeEdit(creditTypeData) {
      $.ajax({
        url: baseUrl + '/credit-type/store',
        type: 'POST',
        data: {
            ...creditTypeData,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#createCreditType').modal('hide');
            Swal.fire({
                title: "Tipo de crédito creado con éxito!",
                icon: "success",
                draggable: false,
                showConfirmButton: false,
            });
            // Reset al formulario
            $('#creditTypeName').val('');
            $('#creditTypeDescription').val('');
            $('#select2Multiple').val(null).trigger('change');
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (xhr) {
            alert('Error al crear el tipo de crédito. Por favor, inténtelo de nuevo.');
        }
    });
}


function showDocuments(id) {
    $('#showDocuments').modal('show');

    $.ajax({
        url: baseUrl + `/credit-type/${id}/documents`,
        type: "POST",
        data: {
            id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.length === 0) {
                $('#tipo_credito').html('Sin documentos');
                $('#contenedor_docs').html('<li>No se encontraron documentos</li>');
                return;
            }

            const tipo = response[0].credit_type_name;
            $('#tipo_credito').html(tipo);

            let li = '';
            response.forEach(element => {
                li += `<li>${element.document_name}</li>`;
            });

            $('#contenedor_docs').html(li);
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Error al obtener los documentos.');
        }
    });
}


function editCreditType(id) {
    $('#editCreditType').modal('show');

    $.ajax({
        url: baseUrl + `/credit-type/${id}/documents`,
        type: "POST",
        data: {
            id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.length === 0) {
                $('#creditTypeNameEdit').val('');
                $('#creditTypeDescriptionEdit').val('');
                $('#select2Multiple_edit').val([]).trigger('change');
                return;
            }

            // 🔹 Tomamos los datos generales del tipo de crédito
            const tipo = response[0].credit_type_name;
            const descripcion = response[0].descripcion;
            const idCreditType = response[0].credit_type_id;

            $('#creditTypeNameEdit').val(tipo);
            $('#creditTypeDescriptionEdit').val(descripcion);
            $('#idCreditType').val(idCreditType);

            // 🔹 Obtenemos los IDs de los documentos asociados
            const documentosSeleccionados = response.map(d => d.document_id);

            // 🔹 Limpiamos y seleccionamos los documentos en el select2
            $('#select2Multiple_edit').val(documentosSeleccionados).trigger('change');
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Error al obtener los documentos.');
        }
    });
}

function validateFormCreditTypeEdit() {
    // Obtener valores del formulario
    let name = $('#creditTypeNameEdit').val();
    let description = $('#creditTypeDescriptionEdit').val();
    let selectedDocuments = $('#select2Multiple_edit').val();

    // Limpiar estados anteriores
    $('#creditTypeNameEdit').removeClass('is-invalid');
    $('#creditTypeNameEditError').addClass('d-none').text('');
    $('#creditTypeDescriptionEdit').removeClass('is-invalid');
    $('#creditTypeDescriptionEditError').addClass('d-none').text('');
    $('#select2Multiple_edit').removeClass('is-invalid');
    $('#select2Multiple_editError').addClass('d-none').text('');

    // Validaciones
    let valid = true;

    if (!name || name.trim() === '') {
        $('#creditTypeNameEdit').addClass('is-invalid');
        $('#creditTypeNameEditError')
            .removeClass('d-none')
            .text('Por favor ingrese el nombre del tipo de crédito.');
        valid = false;
    }

    if (!description || description.trim() === '') {
        $('#creditTypeDescriptionEdit').addClass('is-invalid');
        $('#creditTypeDescriptionEditError')
            .removeClass('d-none')
            .text('Por favor ingrese la descripción del tipo de crédito.');
        valid = false;
    }

    if (!Array.isArray(selectedDocuments) || selectedDocuments.length === 0) {
        $('#select2Multiple_edit').addClass('is-invalid');
        $('#select2Multiple_editError')
            .removeClass('d-none')
            .text('Por favor seleccione al menos un documento requerido.');
        valid = false;
    }

    if (!valid) return;

    // Crear objeto con los datos validados
    const creditTypeData = {
        name: name.trim(),
        description: description.trim(),
        documents: selectedDocuments
    };

    // Guardar datos
    updateCreditType(creditTypeData);
}

function updateCreditType(data) {

    const id = $('#idCreditType').val();


    $.ajax({
        url: baseUrl + `/credit-type/${id}`,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT',
            name: data.name,
            description: data.description,
            documents: data.documents
        },
        success: function (response) {

            $('#editCreditType').modal('hide');
            Swal.fire({
                title: 'Actualizado',
                text: response.message || 'El tipo de crédito fue actualizado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#3085d6'
            })

            setTimeout(() => {
                location.reload();
            }, 1500)
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al actualizar el tipo de crédito.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

function deleteCreditType(id) {
    Swal.fire({
        title: '¿Eliminar tipo de crédito?',
        text: 'Esta acción eliminará el tipo de crédito y sus documentos relacionados.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + `/credit-type/${id}`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Eliminado',
                        text: response.message || 'El tipo de crédito se eliminó correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6'
                    })

                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al intentar eliminar el tipo de crédito.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    });
}




window.createCreditType = createCreditType;
window.validateFormCreditType = validateFormCreditType;
window.showDocuments = showDocuments;
window.editCreditType = editCreditType;
window.validateFormCreditTypeEdit = validateFormCreditTypeEdit;
window.deleteCreditType = deleteCreditType;
