@extends('session.BaseSession')

@section('style')
    <link rel="stylesheet" href="{{ asset('session/css/ratings.css') }}">
@endsection

@section('title')
    Calificaciones
@endsection

@section('content')
    <div class="container">
        <div class="content">

            <div class="semester">
                <label for="program" class="form-label">Semestre:</label>
                <select class="form-select" name="smt" id="semester" required alt="gandalf">
                    <option value="">Choose...</option>
                    @foreach ($semester as $sem)
                        <option value="{{ $sem->id }}">{{ $sem->description }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="item-top">
                <div class="sub">Asignatura</div>

                @isset($semt)
                    <div class="sem-x">Semestre: {{ $semt }}</div>
                @endisset

                <div class="nt">Nota</div>

            </div>

            <hr>

            <div class="subject"></div>
        </div>
    </div>

    <script>

        $(document).ready(function() {
            $('#semester').change(function() {
                var id = $(this).val();

                if (id !== '') {
                    $.ajax({
                        url: '/users/ratings/' + id,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.subject.length > 0) {
                                $('.subject').html('');
                                ontain_data_table(response.subject);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });

            function ontain_data_table(response) {
                const subjects = document.querySelector('.subject');

                $.each(response, function(index, subject) {

                    const item = document.createElement('div');
                    item.setAttribute('style', 'display:flex;flex-direction:row;gap:10px;padding:5px;');

                    const cont = document.createElement('div');
                    cont.setAttribute('style',
                        'width:90%;padding:20px;border:1px solid #51565e66;font-family:Inter;border-radius:15px;'
                    );
                    const sub = document.createElement('div');
                    sub.setAttribute('style', 'color:var(--Black, #060e1a);font-size: 14px;');

                    const hr = document.createElement('hr');
                    hr.setAttribute('style', 'height: 1px;margin: 3px 0 5px 0;');

                    const tea = document.createElement('div');
                    tea.setAttribute('style', 'font-size: 12px;');

                    const note = document.createElement('div');
                    note.setAttribute('style',
                        'width:10%;font-size:20px;font-family:Inter;display:flex;justify-content:center;align-items:center;border:1px solid #51565e66;border-radius:15px;'
                    );

                    const desc = document.createElement('div');

                    sub.textContent = subject.offer_subject.subject.description;

                    const person = subject.offer_subject.teacher.person

                    tea.innerHTML = `
                        Docente: <span><strong>${person.first_name} ${person.last_name}</strong> </span>
                    `;

                    desc.textContent = subject.note;


                    cont.appendChild(sub);
                    cont.appendChild(hr);
                    cont.appendChild(tea);

                    note.appendChild(desc);

                    item.appendChild(cont);
                    item.appendChild(note);

                    subjects.appendChild(item);
                });
            }
        });
    </script>
@endsection
