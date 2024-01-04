$(document).ready(function () {
    $('#calendar').change(function () {
        var calendar = $(this).val();

        $('#program').html('<option value="">Elije...</option>');

        if (calendar !== '') {
            $.ajax({
                url: '/student/program/' + calendar,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (response) {
                    if (response.program.length > 0) {

                        $('#program').html('<option value="">Elije...</option>');

                        $.each(response.program, function (index, item) {
                            $('#program').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#program').change(function () {
        var program = $(this).val();

        $('#tableBody').html('<tbody id="tableBody"></tbody>');

        if (program !== '') {
            $.ajax({
                url: '/student/' + program,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.student.length > 0) {
                        $('#tableBody').html('<tbody id="tableBody"></tbody>');
                        ontain_data_table(response.student);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    function ontain_data_table(response) {
        const tableBody = document.querySelector('#tableBody');

        $.each(response, function (index, student) {
            const rowData = document.createElement('tr');

            const ind = document.createElement('td');
            ind.classList.add('text-center');
            ind.setAttribute('scope', 'row');

            const cod = document.createElement('td');
            const name = document.createElement('td');
            const last = document.createElement('td');

            const opt = document.createElement('td');
            opt.classList.add('text-center');

            student.student.forEach(ele => {
                std = ele;
            });

            ind.textContent = index + 1;
            cod.textContent = student.code;
            name.textContent = student.person.first_name;
            last.textContent = student.person.last_name;
            opt.innerHTML = `
                <a href="/admin/student/person/ ${student.person.id}" title="descripcion" target="_blank"><i class="fas fa-eye"></i></a>
                <a href="/student/${std.id}/edit" title="Editar"><i class="fas fa-edit mx-1"></i></a>
                <a href="#" onclick="deleteElement('${std.id}');" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
            `;

            rowData.appendChild(ind);
            rowData.appendChild(cod);
            rowData.appendChild(name);
            rowData.appendChild(last);
            rowData.appendChild(opt);


            tableBody.appendChild(rowData);
        });
    }



});

function deleteElement(id) {

    $('#staticBackdropLabel').html('');
    title = document.querySelector('#staticBackdropLabel');
    title.textContent = 'Eliminar Studiante';

    $('#message').html('');
    message = document.querySelector('#message');
    message.textContent = '¿Estas seguro que deseas Eliminar este Estudiante?';

    form = document.querySelector('#delete');
    form.setAttribute('action', 'student/' + id);

    $('#deleteModal').modal('show');
}
