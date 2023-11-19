$(document).ready(function () {
    $('#calendar').change(function () {
        var calendar = $(this).val();

        $('#program').html('<option value="">Choose...</option>');

        if (calendar !== '') {
            $.ajax({
                url: '/admin/student/program',
                type: 'GET',
                data: { id: calendar },
                dataType: 'json',
                success: function (response) {
                    if (response.program.length > 0) {

                        $('#program').html('<option value="">Choose...</option>');

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
                url: '/admin/student/student',
                type: 'GET',
                data: { id: program },
                dataType: 'json',
                success: function (response) {
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



            ind.textContent = index + 1;
            cod.textContent = student.code;
            name.textContent = student.first_name;
            last.textContent = student.last_name;
            opt.innerHTML = `
            <a href="/admin/student/person/ ${student.id}" title="descripcion" target="_blank"><i class="fas fa-eye"></i></a>`;


            rowData.appendChild(ind);
            rowData.appendChild(cod);
            rowData.appendChild(name);
            rowData.appendChild(last);
            rowData.appendChild(opt);


            tableBody.appendChild(rowData);
        });
    }



});
