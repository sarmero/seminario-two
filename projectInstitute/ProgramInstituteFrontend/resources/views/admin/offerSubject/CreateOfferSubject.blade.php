@extends('admin.BaseAdmin')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/form.css') }}">
@endsection

@section('title')
    Ofertas de Programas
@endsection

@section('content')
    <div class="container">
        <div class="cont-p">
            <div class="title my-3">
                <div class="tit">Ofertar Asignatura</div>
            </div>

            <form action="{{ route('offer-subject.store') }}" method="POST">
                @csrf
                @include('admin.offerSubject.FormOfferSubject')

                <button class="w-50 my-3 btn btn-primary btn-sm offset-md-3" type="submit">Enviar</button>
                <br><br>
            </form>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#program').change(function() {
                var program = $(this).val();

                if (program !== '') {
                    $.ajax({
                        url: '/offer-subject/subject/' + program,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#subject').html('<option value="">Elejir...</option>');
                            if (response.subject.length > 0) {
                                response.subject.forEach(subject => {
                                    $('#subject').append('<option value="'+subject.id+'">'+subject.description+'</option>');
                                });
                            }

                            $('#teacher').html('<option value="">Elejir...</option>');
                            if (response.teacher.length > 0) {
                                response.teacher.forEach(teacher => {
                                    $('#teacher').append('<option value="'+teacher.id+'">'+teacher.person.first_name+' '+teacher.person.last_name+'</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>


@endsection
