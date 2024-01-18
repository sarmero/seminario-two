<div class="row g-3">
    <div class="col-sm-12">
        <label for="program" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="program" id="program" placeholder=""
            value="@if (isset($program)) {{ old('program', $program->name) }}
            @else {{ old('program') }} @endif">
        @error('program')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12">
        <label for="description" class="form-label">Description:</label>
        <textarea type="text" class="form-control" name="description" id="description" placeholder="">
@if (isset($program))
{{ old('description', $program->description) }}
@else
{{ old('description') }}
@endif
</textarea>


        @error('description')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-sm-12">
        <label for="imag" class="form-label">Imagen:</label>
        <input type="file" class="form-control" name="image" id="customFile">
        @error('image')
            <div class="text-small text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12 imageFile">
        <div class="mb-3 d-flex justify-content-center">
            <img name="image" id="preview-image-before-upload"
                src="@isset($program)
                {{ asset('storage/program/' . $program->image) }}
            @else
                {{ asset('image/upload-image.png') }}
            @endisset"
                alt="Previsualizar imagen" class="image-preview">
        </div>
    </div>

</div>
