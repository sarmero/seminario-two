<div class="row g-3">
    <div class="col-sm-12">
        <label for="program" class="form-label">Program:</label>
        <select class="form-select" name="program" id="program" required alt="gandalf">
            <option value="">Elegir...</option>
            @foreach ($program as $pro)
                <option
                    value="{{ $pro->id }}" @if (old('program') == '' && isset($teacher)) {{ $teacher->teacher->program_id == $pro->id ? 'selected' : '' }}
                @else
                    {{ old('program') == $pro->id ? 'selected' : '' }} @endif>{{ $pro->name }}
                </option>
            @endforeach
        </select>

    </div>

    <div class="col-sm-6">
        <label for="firstName" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder=""
            value="@isset($teacher){{ old('firstName', $teacher->first_name) }}@else{{ old('firstName') }}@endisset">

        @error('firstName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="lastName" class="form-label">Apellido:</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
            value="@isset($teacher){{ old('lastName', $teacher->last_name) }}@else{{ old('lastName') }}@endisset">
        @error('lastName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="mail" class="form-label">Email:</label>
        <input type="mail" class="form-control" name="mail" id="mail" placeholder=""
            value="@isset($teacher){{ old('mail', $teacher->contact->email) }}@else{{ old('mail') }}@endisset">

        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="gender" class="form-label">Genero:</label>
        <select class="form-select" name="gender" id="gender" required alt="gandalf">
            <option value="">Elejir...</option>
            <option value="M" @if (old('gender') == '' && isset($teacher)) {{ $teacher->gender == 'M' ? 'selected' : '' }} @else
                {{ old('gender') == 'M' ? 'selected' : '' }} @endif>Masculino</option>
            <option value="F" @if (old('gender') == '' && isset($teacher)) {{ $teacher->gender == 'F' ? 'selected' : '' }} @else
                {{ old('gender') == 'F' ? 'selected' : '' }} @endif>Femenino</option>
        </select>

        @error('gender')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="phone" class="form-label">Celular:</label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder=""
            value="@isset($teacher){{ old('phone', $teacher->contact->phone) }}@else{{ old('phone') }}@endisset">

        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-3">
        <label for="district" class="form-label">Barrio:</label>
        <select class="form-select" name="district" id="district" alt="gandalf">
            <option value="">Elegir...</option>
            @foreach ($district as $dis)
                <option value="{{ $dis->id }}" @if (old('district') == '' && isset($teacher)) {{ $teacher->district_id == $dis->id ? 'selected' : '' }}
                    @else
                        {{ old('district') == $dis->id ? 'selected' : '' }} @endif>{{ $dis->description }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-3">
        <label for="document" class="form-label">N. de Identificacion:</label>
        <input type="text" class="form-control" name="document" id="document" placeholder=""
            value="@isset($teacher){{ old('document', $teacher->number_document) }}@else{{ old('document') }}@endisset">

        @error('document')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="photo" class="form-label">Foto:</label>
        <input type="file" class="form-control" name="photo" id="customFile">
         @error('photo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 imageFile">
        <div class="mb-3 d-flex justify-content-center">
            <img name="image" id="preview-image-before-upload"
                src="@isset($teacher)
                {{ asset('storage/pofile/' . $teacher->photo) }}
            @else
                {{ asset('image/upload-image.png') }}
            @endisset"
                alt="Previsualizar imagen" class="image-preview">
        </div>
    </div>

</div>
