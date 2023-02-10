<div>
    <div class="d-flex">
        <div class="me-3">
            <label class="form-label" for="addField">Select type of value</label>
            <select name="valueType" class="form-control form-control-sm w-100" wire:model="valueType">
                @forelse ($defaultValuesType as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="me-3">
            <label class="form-label" for="fieldName">Name of field</label>
            <input style="min-width:300px;" type="text" id="fieldName" placeholder="Name of field"
                class="form-control form-control-sm @error('fieldName') is-invalid @enderror" wire:model="fieldName"
                wire:keydown.enter="addFieldToModel">
            <div>
                @error('fieldName')
                    <span class="text-danger text-xxs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-center mt-3 mb-3">
        <button @if (!$isValid) disabled @endif class="btn bg-gradient-success mb-0 px-3 py-2"
            wire:click="addFieldToModel"><i class="fa-solid fa-plus" style="cursor: pointer;"></i> Add Field / Enter
        </button>
    </div>
    <hr>
    <div>
        <ul>
            @foreach ($fieldsModel as $keyField => $arrayType)
                @foreach ($arrayType as $index => $field)
                    <li class="d-flex align-items-center mt-2 mb-2" style="list-style: none;">
                        <div class="me-3">
                            <span
                                class="badge
                            @if ($keyField === 'bigInteger') badge-info @endif
                            @if ($keyField === 'string') badge-success @endif
                            @if ($keyField === 'bool') badge-primary @endif
                            ">{{ $keyField }}
                            </span>
                            /
                            <span class="badge badge-secondary">{{ $field }}</span>
                        </div>
                        <button class="btn btn-outline-danger mb-0 px-2 py-1 me-5"
                            wire:click="removeFieldToModel('{{ $keyField }}', {{ $index }})">
                            <span>Remove</span>
                            <i class="fa-solid fa-trash ms-2" style="cursor: pointer;"></i>
                        </button>
                        <div>
                            <i class="fa-regular fa-circle-up me-3" style="cursor: pointer;"
                                wire:click="upIndex({{ $index }})"></i>
                            <i class="fa-regular fa-circle-down" style="cursor: pointer;"
                                wire:click="downfield({{ $index }})"></i>
                        </div>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
