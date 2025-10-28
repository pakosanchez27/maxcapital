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

    saveCreditType(creditTypeData);


}

function saveCreditType(creditTypeData) {

    $.ajax({
        url: baseUrl + '/creditType/store',
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

function showDocuments(id){
    $('#showDocuments').modal('show');
    
}


window.createCreditType = createCreditType;
window.validateFormCreditType = validateFormCreditType;
window.showDocuments = showDocuments;