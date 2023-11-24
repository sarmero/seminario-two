let teacher;

$(document).ready(function () {

    $('#program').change(function () {
        var program = $(this).val();

        $('#tableBody').html('<tbody id="tableBody"></tbody>');

        if (program !== '') {
            $.ajax({
                url: '/admin/subject/offer/program',
                type: 'GET',
                data: { id: program },
                dataType: 'json',
                success: function (response) {

                    if (response.offer.length > 0) {
                        $('#tableBody').html('<tbody id="tableBody"></tbody>');
                        obtain_data_table(response.offer);

                    }

                    if (response.subject.length > 0) {
                        $('#subject').html('<option value="">Choose...</option>');

                        $.each(response.subject, function (index, item) {
                            $('#subject').append('<option value="' + item.id + '">' + item.description + '</option>');
                        });
                    }

                    if (response.teacher.length > 0) {
                        teacher = response.teacher;
                        $('#teacher').html('<option value="">Choose...</option>');
                        $('#teacherx').html('<option value="">Choose...</option>');

                        $.each(teacher, function (index, item) {
                            $('#teacher').append('<option value="' + item.teacher + '">' + item.first_name + ' ' + item.last_name + '</option>');
                            $('#teacherx').append('<option value="' + item.teacher + '">' + item.first_name + ' ' + item.last_name + '</option>');
                        });
                    }

                    if (response.name != null) {
                        $('#nameProgram').html('');
                        title = document.querySelector('#nameProgram');
                        const cont = document.createElement('h3');
                        cont.textContent = response.name.name;
                        title.appendChild(cont);
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
        <a href="#" onclick="atualizarElementosForm('${offer.id}', '${offer.subject}');" title="editar" >
            <i class="fas fa-edit"></i>
        </a>

        <a href="#" onclick="deleteElement(${offer.id})" title="eliminar">
            <i class="fas fa-trash-alt"></i>
        </a>`;

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
    if (confirm('¿Estás seguro de que quieres eliminar esta oferta?')) {
        $.ajax({
            type: 'DELETE',
            url: '/admin/subject/offer/' + id,
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


function atualizarElementosForm(id, subject) {

    $('#nameSubject').html('');
    title = document.querySelector('#nameSubject');
    const cont = document.createElement('h3');
    cont.setAttribute('style', 'width:100%;');
    cont.textContent = subject;
    title.appendChild(cont);


    form = document.querySelector('#update');
    form.setAttribute('action', '/admin/subject/offer/update/' + id);

    $('#actualizarModal').modal('show');

}



