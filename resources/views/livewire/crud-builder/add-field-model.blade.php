<div>
    <div class="row">
        <div class="col-6">
            <label class="form-label" for="addField">Select type of value</label>
            <select class="form-control form-control-sm w-100" wire:model="typeField">
                @forelse ($defaultValuesType as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-6">
            <label class="form-label" for="fieldName">Name of field</label>
            <input type="text" id="fieldName" placeholder="Name of field"
                class="form-control form-control-sm @error('fieldName') is-invalid @enderror" wire:model="fieldName"
                wire:keydown.enter="addFieldToModel">
            <div>
                @error('fieldName')
                    <span class="text-danger text-xxs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="mt-4 mb-4 d-flex flex-wrap">
        @foreach ($checkboxFieldsDefault as $key => $checkbox)
            <div class="form-check form-switch me-3">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $key }}"
                    wire:model="checkboxFieldsChoices" value={{ $checkbox }}>
                <label class="form-check-label"
                    for="flexSwitchCheckDefault{{ $key }}">{{ $checkbox }}</label>
            </div>
        @endforeach
    </div>


    <div class="d-flex justify-content-center mt-3 mb-3">
        <button @if (!$isValid) disabled @endif class="btn btn-success mb-0 px-3 py-2"
            wire:click="addFieldToModel"><i class="fa-solid fa-plus" style="cursor: pointer;"></i> Add Field / Enter
        </button>
    </div>
    <pre>{{ var_dump($checkboxFieldsChoices) }}</pre>
    <hr>
    <div>
        {{--  <pre>{{ var_dump($fieldsModel) }}</pre> --}}
        <p class="lead">
            Your model Database
        </p>
        <ul>
            @foreach ($fieldsModel as $index => $valueFields)
                {{--  <h1>{{ $valueFields[0] }} {{ $valueFields[1] }}</h1> --}}
                <li
                    class="d-flex align-items-center py-2 px-1 @if ($index % 2 === 0) bg-gradient-light @endif">
                    <div class="me-2 d-flex">
                        <span
                            class="badge me-2 d-flex align-items-center
                            @if ($valueFields[0] === 'bigInteger' || $valueFields[0] === 'integer') badge-info @endif
                            @if ($valueFields[0] === 'string') badge-success @endif
                            @if ($valueFields[0] === 'boolean') badge-primary @endif
                            ">{{ $valueFields[0] }}
                        </span>
                        |
                        <input type="text" class="ms-2 me-2 form-control form-control-sm"
                            wire:model="fieldsModel.{{ $index }}.1">
                        <div wire:loading wire:target="fieldsModel.{{ $index }}.1">
                            <i class="fa-solid
                            fa-arrows-rotate spinning"></i>
                        </div>
                    </div>

                    <button class="btn bg-gradient-danger mb-0 px-2 py-2 me-3"
                        wire:click="removeFieldToModel('{{ $index }}')">
                        <i class="fa-solid fa-trash" style="cursor: pointer;"></i>
                    </button>
                    <div>
                        <i class="fa-regular text-secondary fa-circle-up me-1" style="cursor: pointer;"
                            wire:click="upIndex({{ $index }})"></i>
                        <i class="fa-regular text-secondary fa-circle-down" style="cursor: pointer;"
                            wire:click="downIndex({{ $index }})"></i>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
