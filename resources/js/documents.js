

const baseUrl = window.location.origin;

// Inicializar dataTable al cargar la página
function initializeDataTable() {
    let table = new DataTable('#documentsTable');
}

$(document).ready(function () {
    initializeDataTable();
});


// Crear Documento
function createDocument() {

    $('#createDocument').modal('show');
}

function validateFormDocument() {
    let name = $('#nombreDocumento').val();
    let description = $('#descriptionBasic').val();

    // Clear previous validation state
    $('#nombreDocumento').removeClass('is-invalid');
    $('#nombreDocumentoError').addClass('d-none').text('');
    // Clear description validation state
    $('#descriptionBasic').removeClass('is-invalid');
    $('#descriptionBasicError').addClass('d-none').text('');


    // Validate both fields
    let valid = true;

    if (!name || name.trim() === '') {
        $('#nombreDocumento').addClass('is-invalid');
        $('#nombreDocumentoError').removeClass('d-none').text('Por favor ingrese el nombre del documento.');
        valid = false;
    }

    if (!description || description.trim() === '') {
        $('#descriptionBasic').addClass('is-invalid');
        $('#descriptionBasicError').removeClass('d-none').text('Por favor agregue una descripción.');
        valid = false;
    }

    if (!valid) {
        return;
    }

    // Submit the form data via AJAX
    $.ajax({
        url: baseUrl + '/documentos/store',
        method: 'POST',
        data: {
            name: name,
            description: description,
            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function (response) {
            // Handle success (e.g., close modal, show success message, refresh document list)
            $('#createDocument').modal('hide');
            // sweetAlert
            Swal.fire({
                title: "Documento creado con éxito!",
                icon: "success",
                draggable: false,
                showConfirmButton: false,
            });

            // Reset al formulario
            $('#nombreDocumento').val('');
            $('#descriptionBasic').val('');

            // Optionally, refresh the document list or DataTable
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (xhr) {
            // Handle error (e.g., show error message)
            alert('Error al crear el documento. Por favor, inténtelo de nuevo.');
        }
    });



}


// Actualizar documento 

function updateDocument(documentId) {
   

    $.ajax({
        url: baseUrl + '/documentos/' + documentId + '/edit',
        method: 'GET',
        success: function (response) {
            // Aquí puedes llenar el formulario de actualización con los datos recibidos
            console.log(response);
            $('#nombreDocumentoUpdate').val(response.name);
            $('#descriptionBasicUpdate').val(response.description);
            $('#documentIdUpdate').val(response.id);
        }
    });
             $('#updateDocument').modal('show');
    
}

function validateFormDocumentUpdate() {
    let name = $('#nombreDocumentoUpdate').val();
    let description = $('#descriptionBasicUpdate').val();
    let documentId = $('#documentIdUpdate').val();

    // Clear previous validation state
    $('#nombreDocumentoUpdate').removeClass('is-invalid');
    $('#nombreDocumentoUpdateError').addClass('d-none').text('');
    // Clear description validation state
    $('#descriptionBasicUpdate').removeClass('is-invalid');
    $('#descriptionBasicUpdateError').addClass('d-none').text('');

    // Validate both fields
    let valid = true;

    if (!name || name.trim() === '') {
        $('#nombreDocumentoUpdate').addClass('is-invalid');
        $('#nombreDocumentoUpdateError').removeClass('d-none').text('Por favor ingrese el nombre del documento.');
        valid = false;
    }

    if (!description || description.trim() === '') {
        $('#descriptionBasicUpdate').addClass('is-invalid');
        $('#descriptionBasicUpdateError').removeClass('d-none').text('Por favor agregue una descripción.');
        valid = false;
    }

    if (!valid) {
        return;
    }

    
    // Submit the form data via AJAX (PUT/PATCH)
    $.ajax({
        url: baseUrl + '/documentos/' + documentId + '/update',
        method: 'POST',
        data: {
            name: name,
            description: description,
            _method: 'PUT',
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#updateDocument').modal('hide');
            Swal.fire({
                title: "Documento actualizado con éxito!",
                icon: "success",
                draggable: false,
                showConfirmButton: false,
            });
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (xhr) {
            alert('Error al actualizar el documento. Por favor, inténtelo de nuevo.');
        }
    });
}


// DELETE DOCUMENT
function deleteDocument(documentId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {   
            $.ajax({
                url: baseUrl + '/documentos/' + documentId + '/delete',
                method: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        '¡Eliminado!',
                        'El documento ha sido eliminado.',
                        'success'
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                },
                error: function (xhr) {
                    alert('Error al eliminar el documento. Por favor, inténtelo de nuevo.');
                }
            });
        }
    });
}



window.createDocument = createDocument;
window.validateFormDocument = validateFormDocument;
window.initializeDataTable = initializeDataTable;
window.updateDocument = updateDocument;
window.validateFormDocumentUpdate = validateFormDocumentUpdate;
window.deleteDocument = deleteDocument;