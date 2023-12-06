
$(document).ready(function () {

    $('#program').change(function () {
        var program = $(this).val();

        $('#tableBody').html('<tbody id="tableBody"></tbody>');

        if (program !== '') {
            $.ajax({
                url: '/offer-subject/'+program,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (response) {

                    if (response.offer.length > 0) {
                        $('#tableBody').html('<tbody id="tableBody"></tbody>');
                        obtain_data_table(response.offer);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });



});

function obtain_data_table(response) {
    const tableBody = document.querySelector('#tableBody');

    $.each(response, function (index, offer) {

        const rowData = document.createElement('tr');

        const ind = document.createElement('td');
        ind.classList.add('text-center');
        ind.setAttribute('scope', 'row');

        const subject = document.createElement('td');
        const semester = document.createElement('td');
        semester.classList.add('text-center');
        const teacher = document.createElement('td');
        const quotas = document.createElement('td');
        quotas.classList.add('text-center');

        const opt = document.createElement('td');
        opt.classList.add('text-center');

        ind.textContent = index + 1;
        subject.textContent = offer.subject;
        semester.textContent = offer.semester;
        teacher.textContent = offer.first_name + ' ' + offer.last_name
        quotas.textContent = offer.quotas;
        opt.innerHTML = `
        <a href="offer-subject/${offer.id}/edit" title="Editar"><i class="fas fa-edit mx-1"></i></a>
                    <a href="#" onclick="deleteElement('${offer.id}');" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
        `;

        rowData.appendChild(ind);
        rowData.appendChild(subject);
        rowData.appendChild(semester);
        rowData.appendChild(teacher);
        rowData.appendChild(quotas);
        rowData.appendChild(opt);

        tableBody.appendChild(rowData);
    });
}

function deleteElement(id) {

    $('#staticBackdropLabel').html('');
    title = document.querySelector('#staticBackdropLabel');
    title.textContent = 'Eliminar Oferta';

    $('#message').html('');
    message = document.querySelector('#message');
    message.textContent = '¿Estas seguro que deseas Eliminar esta Oferta?';

    form = document.querySelector('#delete');
    form.setAttribute('action', 'offer-subject/' + id);

    $('#deleteModal').modal('show');
}


// function atualizarElementosForm(id, subject) {

//     $('#nameSubject').html('');
//     title = document.querySelector('#nameSubject');
//     const cont = document.createElement('h3');
//     cont.setAttribute('style', 'width:100%;');
//     cont.textContent = subject;
//     title.appendChild(cont);


//     form = document.querySelector('#update');
//     form.setAttribute('action', '/admin/subject/offer/update/' + id);

//     $('#actualizarModal').modal('show');

// }



