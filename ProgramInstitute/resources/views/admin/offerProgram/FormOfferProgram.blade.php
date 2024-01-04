<div class="row">

    @isset($program)
        <div class="col-sm-12">
            <label for="program" class="form-label">Programa:</label>
            <select class="form-select" name="program" id="program" required alt="gandalf">
                <option value="">Choose...</option>
                @foreach ($program as $pro)
                    <option value="{{ $pro->id }}">{{ $pro->name }}
                    </option>
                @endforeach
            </select>

            @error('program')
                <div class="text-small alert-danger">{{ $message }}</div>
            @enderror
        </div>
    @else
        <div class="col-sm-12 d-flex justify-content-center my-3">
            <h3>{{ $offer->program->name }}</h3>
        </div>
    @endisset

    <div class="col-sm-6 my-3">
        <label for="modality" class="form-label">Modalidad:</label>
        <select class="form-select" name="modality" id="modality" required alt="gandalf">
            <option value="">Elejir...</option>
            @foreach ($modality as $item)
                <option value="{{ $item->id }}">{{ $item->description }}
                </option>
            @endforeach
        </select>

        @error('modality')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-sm-6 my-3">
        <label for="quotas" class="form-label">Cupos:</label>
        <input type="text" class="form-control" name="quotas" id="quotas" placeholder=""
            value="@if (isset($offer)) {{ old('quotas', $offer->quotas) }}
        @else {{ old('quotas') }} @endif"
            required>
        @error('quotas')
            <div class="text-small alert-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
