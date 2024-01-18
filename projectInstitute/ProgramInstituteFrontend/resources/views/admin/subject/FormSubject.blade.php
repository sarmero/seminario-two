<div class="row g-3">
    <div class="col-sm-12">
        <label for="subject" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="subject" id="subject" placeholder=""
            value="@if (isset($subject)) {{ old('subject', $subject->description) }}
        @else {{ old('subject') }} @endif"
            required>
        @error('subject')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-10">
        <label for="program" class="form-label">Programa:</label>
        <select class="form-select" name="program" id="program" required alt="gandalf">
            <option value="">Elejir...</option>
            @foreach ($program as $sem)
                <option value="{{ $sem->id }}" @if (old('semester') == '' && isset($subject))
                    {{ $subject->program->id == $sem->id ? 'selected' : '' }}
                @else
                    {{ old('semester') == $sem->id ? 'selected' : '' }}
                @endif>{{ $sem->name }}
                </option>
            @endforeach
        </select>
        @error('program')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-2">
        <label for="program" class="form-label">Semestre:</label>
        <select class="form-select" name="semester" id="semester" required alt="gandalf">
            <option value="">Elejir...</option>
            @foreach ($semester as $sem)
                <option value="{{ $sem->id }}" @if (old('semester') == '' && isset($subject))
                    {{ $subject->semester->id == $sem->id ? 'selected' : '' }}
                @else
                    {{ old('semester') == $sem->id ? 'selected' : '' }}
                @endif>{{ $sem->description }}
            </option>
        @endforeach
    </select>
    @error('semester')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

</div>
