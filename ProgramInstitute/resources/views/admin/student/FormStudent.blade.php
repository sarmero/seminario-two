<div class="row g-3">

    <div class="col-sm-6">
        <label for="firstName" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder=""
            value="@isset($student){{ old('firstName', $student->first_name) }}@else{{ old('firstName') }}@endisset">

        @error('firstName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="lastName" class="form-label">Apellido:</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
            value="@isset($student){{ old('lastName', $student->last_name) }}@else{{ old('lastName') }}@endisset">
        @error('lastName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="mail" class="form-label">Email:</label>
        <input type="mail" class="form-control" name="mail" id="mail" placeholder=""
            value="@isset($student){{ old('mail', $student->email) }}@else{{ old('mail') }}@endisset">

        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="gender" class="form-label">Genero:</label>
        <select class="form-select" name="gender" id="gender" required alt="gandalf">
            <option value="">Elejir...</option>
            <option value="M" @if (old('gender') == '' && isset($student)) {{ $student->gender == 'M' ? 'selected' : '' }} @else
                {{ old('gender') == 'M' ? 'selected' : '' }} @endif>Masculino</option>
            <option value="F" @if (old('gender') == '' && isset($student)) {{ $student->gender == 'F' ? 'selected' : '' }} @else
                {{ old('gender') == 'F' ? 'selected' : '' }} @endif>Femenino</option>
        </select>

        @error('gender')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-4">
        <label for="phone" class="form-label">Celular:</label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder=""
            value="@isset($student){{ old('phone', $student->phone) }}@else{{ old('phone') }}@endisset">

        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-3">
        <label for="district" class="form-label">Barrio:</label>
        <select class="form-select" name="district" id="district" required alt="gandalf">
            <option value="">Elegir...</option>
            @foreach ($district as $dis)
                <option value="{{ $dis->id }}" @if (old('district') == '' && isset($student)) {{ $student->district_id == $dis->id ? 'selected' : '' }}
                    @else
                        {{ old('district') == $dis->id ? 'selected' : '' }} @endif>{{ $dis->description }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-3">
        <label for="document" class="form-label">N. de Identificacion:</label>
        <input type="text" class="form-control" name="document" id="document" placeholder=""
            value="@isset($student){{ old('document', $student->number_document) }}@else{{ old('document') }}@endisset">

        @error('document')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6">
        <label for="photo" class="form-label">Foto:</label>
        <input type="file" class="form-control" name="photo" id="customFile" required>
         @error('photo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 imageFile">
        <div class="mb-3 d-flex justify-content-center">
            <img name="image" id="preview-image-before-upload"
                src="@isset($student)
                {{ asset('storage/pofile/' . $student->photo) }}
            @else
                {{ asset('image/upload-image.png') }}
            @endisset"
                alt="Previsualizar imagen" class="image-preview">
        </div>
    </div>

</div>
