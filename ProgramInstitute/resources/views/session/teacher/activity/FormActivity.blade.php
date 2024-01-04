<div class="row g-3">


    @isset($activity)
        <div class="col-sm-12">
            <div class="name d-flex justify-content-center" id="nameSubject">
                <h3>{{ $name->description }}</h3>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <label for="subject" class="form-label">Asignatura:</label>
            <select class="form-select" name="subject" id="subject" alt="gandalf">
                <option value="">Elegir...</option>
                @foreach ($subject as $item)
                    <option value="{{ $item->id }}" {{ old('subject') == $item->id ? 'selected' : '' }}>
                        {{ $item->description}}
                    </option>
                @endforeach
            </select>
        </div>
    @endisset

    <div class="col-sm-12">
        <label for="description" class="form-label">Description:</label>
        <textarea type="text" class="form-control" name="description" id="description" placeholder="" value="">
@if (isset($activity) && old('description') == '')
{{ old('description', $activity->description) }}@else{{ old('description') }}
@endif
</textarea>

        @error('description')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-12">
        <label for="imag" class="form-label">Fecha de entrega:</label>
        <input type="date" class="form-control" name="deadline" id="deadline"
            min="{{ now()->toDateString('Y-m-d') }}"
            value="@if (isset($activity) && old('deadline') == '') {{ old('deadline', $activity->deadline) }}@else{{ old('deadline') }} @endif">

        @error('deadline')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
