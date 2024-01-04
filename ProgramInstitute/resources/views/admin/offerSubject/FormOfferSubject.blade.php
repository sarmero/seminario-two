<div class="row g-3">

    <div class="col-sm-12">
        @isset($program)
            <label for="program" class="form-label">Programa:</label>
            <select class="form-select" name="program" id="program" required alt="gandalf">
                <option value="">Elejir...</option>
                @foreach ($program as $pro)
                    <option value="{{ $pro->id }}">
                        {{ $pro->name }}
                    </option>
                @endforeach
            </select>

            @error('program')
                <div class="text-small alert-danger">{{ $message }}</div>
            @enderror

        @endisset
    </div>


    <div class="col-sm-12">
        @isset($program)
            <label for="subject" class="form-label">Asignaturas:</label>
            <select class="form-select" name="subject" id="subject" required alt="gandalf">
                <option value="">Elejir...</option>
            </select>

            @error('subject')
                <div class="text-small alert-danger">{{ $message }}</div>
            @enderror
        @else
            <div class="d-flex justify-content-center my-3">
                <h3>{{ $offer->subject->description }}</h3>
            </div>
        @endisset
    </div>

    <div class="col-sm-6">
        <label for="teacher" class="form-label">Docentes:</label>
        <select class="form-select" name="teacher" id="teacher">
            <option value="">Elejir...</option>
            @isset($teacher)
                @foreach ($teacher as $tea)
                    <option value="{{ $tea->teacher->id }}" {{ $offer->programming[0]['teacher_id'] == $tea->teacher->id ? 'selected' : '' }}>
                        {{ $tea->first_name }} {{ $tea->last_name }}
                    </option>
                @endforeach
            @endisset
        </select>
        @error('teacher')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="quotas" class="form-label">Cupos:</label>
        <input type="text" class="form-control" name="quotas" id="quotas" placeholder=""
            value="@isset($offer) {{ old('quotas', $offer->quotas) }}@else{{ old('quotas') }}@endisset">
        @error('quotas')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
