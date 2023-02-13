<div>
    <div class="row">
        <div class="col-6">
            <label class="form-label" for="addField">Type of value</label>
            <select class="form-control form-control-sm w-100 @error('selectTypeValues') is-invalid @enderror"
                wire:model="selectTypeValues">
                <option class="bg-secondary text-white"><strong>--- Select Type---</strong></option>
                @foreach ($defaultValuesType as $typeKey => $array)
                    <optgroup label="{{ $typeKey }}">
                        @foreach ($array as $key => $value)
                            <option class="bg-light" value="{{ json_encode([$typeKey, $key]) }}">{{ $key }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('selectTypeValues')
                <span class="text-danger text-xxs">{{ $message }}</span>
            @enderror
            @if ($descTypeField)
                <div>
                    <span class="text-secondary text-xxs">{{ $descTypeField }}</span>
                </div>
            @endif
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

    @if ($fieldName)
        <div class="mt-3 mb-3 d-flex flex-wrap">
            @foreach ($checkboxFieldsDefault as $key => $checkbox)
                <div class="form-check form-switch me-3">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $key }}"
                        wire:model="checkboxFieldsChoices" value={{ $checkbox }}>
                    <label class="form-check-label"
                        for="flexSwitchCheckDefault{{ $key }}">{{ $checkbox }}</label>
                </div>
            @endforeach
        </div>
    @endif

    @if ($isDefault)
        <div class="col-6">
            <label class="form-label" for="defaultValue">Default value</label>
            <input type="text" id="defaultValue" placeholder="Default Value"
                class="form-control form-control-sm @error('defaultValue') is-invalid @enderror"
                wire:model="defaultValue" {{-- wire:keydown.enter="addFieldToModel" --}}>
            <div>
                @error('defaultValue')
                    <span class="text-danger text-xxs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-3 mb-3">
        <button @if (!$isValid) disabled @endif class="btn btn-success mb-0 px-3 py-2"
            wire:click="addFieldToModel"><i class="fa-solid fa-plus" style="cursor: pointer;"></i> Add Field / Enter
        </button>
    </div>
    <pre><span class="text-xxs">{{ var_dump($checkboxFieldsChoices) }}</span></pre>
    <hr>
    <div>
        <pre><span class="text-xxs">{{ var_dump($fieldsModel) }}</span></pre>
        <p class="lead">
            Your model Database
        </p>
        <ul>
            @foreach ($fieldsModel as $index => $valueFields)
                <li
                    class="d-flex align-items-center py-2 px-1 {{ $index % 2 === 0 ? 'bg-my-gray' : 'bg-my-gray-lighter' }}">
                    <span
                        class="badge @if ($valueFields[0] === 'Numeric types') badge-info @endif
                    @if ($valueFields[0] === 'Date and Time types') badge-primary @endif
                    @if ($valueFields[0] === 'String types') badge-success @endif
                    @if ($valueFields[0] === 'Other types') badge-danger @endif ms-2 me-2">{{ $valueFields[0] }}</span>
                    |
                    <span
                        class="badge ms-2 me-2
                            @if ($valueFields[0] === 'Numeric types') badge-info @endif
                            @if ($valueFields[0] === 'Date and Time types') badge-primary @endif
                            @if ($valueFields[0] === 'String types') badge-success @endif
                            @if ($valueFields[0] === 'Other types') badge-danger @endif
                            ">{{ $valueFields[1] }}
                    </span>
                    |
                    <input type="text" class="ms-2 me-2 form-control form-control-sm"
                        wire:model="fieldsModel.{{ $index }}.2">
                    <div wire:loading wire:target="fieldsModel.{{ $index }}.2">
                        <i class="fa-solid
                            fa-arrows-rotate spinning"></i>
                    </div>


                    <button class="btn bg-gradient-danger mb-0 px-2 py-2 me-3"
                        wire:click="removeFieldToModel('{{ $index }}')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <div>
                        <i class="fa-regular text-dark fa-circle-up me-1"
                            wire:click="upIndex({{ $index }})"></i>
                        <i class="fa-regular text-dark fa-circle-down"
                            wire:click="downIndex({{ $index }})"></i>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
