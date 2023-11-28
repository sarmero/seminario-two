<div class="row g-3">
    <div class="col-sm-12">
        <label for="program" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="program" id="program" placeholder=""
            value="@if (isset($program)) {{ old('program', $program->name) }}
            @else {{ old('program') }} @endif"
            required>
        @error('program')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12">
        <label for="description" class="form-label">Description:</label>
        <textarea type="text" class="form-control" name="description" id="description" placeholder=""
        required>@if (isset($program)){{ old('description', $program->description) }}@else{{ old('description') }}@endif
        </textarea>

        @error('description')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-sm-12">
        <label for="imag" class="form-label">Imagen:</label>
        <input type="file" class="form-control" name="image" id="imag" required>
        @error('image')
            <div class="text-small text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>

<hr class="my-4">
