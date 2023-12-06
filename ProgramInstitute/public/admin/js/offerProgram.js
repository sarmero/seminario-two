function deleteElement(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta oferta?')) {
        $.ajax({
            type: 'DELETE',
            url: '/admin/program/offer/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error('Error en la solicitud Ajax:', error);
            }
        });
    }
}


function atualizarElementosForm(id, program) {

    $('#nameProgram').html('');
    title = document.querySelector('#nameProgram');
    const cont = document.createElement('h3');
    cont.setAttribute('style', 'width:100%;');
    cont.textContent = program;
    title.appendChild(cont);


    form = document.querySelector('#update');
    form.setAttribute('action', '/admin/program/offer/update/' + id);



    $('#actualizarModal').modal('show');

}
