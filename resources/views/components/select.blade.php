@props(['col' => 12, 'name' => '', 'value' => '', 'model' => null, 'options' => [], 'placeholder' => '', 'required' => false, 'multiple' => false, 'searchable' => false, 'class' => 'form-select', 'id' => '', 'attributes' => [], 'label' => '', 'hint' => ''])

{{-- Enhanced Select Component that handles both Arrays and Collections --}}
{{-- Features:
     - Automatic placeholder for non-searchable selects
     - Support for Eloquent collections and arrays
     - Model relationship handling
     - Custom field mapping
--}}
{{-- Usage Examples:
     1. Simple Array: <x-select name="status" :options="['active' => 'Active', 'inactive' => 'Inactive']" />
     2. Eloquent Collection: <x-select name="user_id" :options="$users" option-key="id" option-value="name" />
     3. Array of Objects: <x-select name="category" :options="$categories" option-key="id" option-value="title" />
     4. With Model: <x-select name="jenis_code_rs" label="Rs" :model="$model" :options="$rs" />
--}}

@php
    $selectValue = $value;

    if ($model && $name && property_exists($model, $name)) {
        $selectValue = old($name, $model->$name);
    } elseif ($name) {
        $selectValue = old($name, request()->get($name, $value));
    }
@endphp

<div class="form-group col-{{ $col }}">
    <label for="{{ $id }}" class="form-label">
        {{ $label }}@if($required)<span class="required-asterisk">*</span>@endif
    </label>
    @if($multiple || $searchable)
        <div class="custom-select-wrapper {{ $multiple ? 'custom-select-multiple' : '' }}" data-multiple="{{ $multiple ? 'true' : 'false' }}">
            <button type="button" class="custom-select-input">
                <div class="custom-select-placeholder">{{ $multiple ? ($placeholder ?: 'Select options') : ($placeholder ?: (isset($options['']) ? $options[''] : 'Select an option')) }}</div>
                <div class="custom-select-arrow">▼</div>
            </button>
            @if(!$multiple)<input type="hidden" name="{{ $name }}" id="{{ $id }}" @if($required) required @endif />@endif
            @if($multiple)<div class="custom-select-hidden-inputs" data-name="{{ $name }}[]"></div>@endif
            @if($multiple)
            <div class="custom-select-selected-items">
                <!-- Selected items will be populated by JS -->
            </div>
            @endif
            <div class="custom-select-dropdown">
                @if($searchable)<input type="text" class="custom-select-search" placeholder="Search...">@endif
                <div class="custom-select-options">
                    @foreach($options as $key => $option)
                        <div class="custom-select-option" data-value="{{ $key }}" {{ ($multiple && is_array($selectValue) && in_array($key, $selectValue)) || (!$multiple && $selectValue == $key) ? 'data-selected="true"' : '' }}>
                            {{ $option }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            @if($required) required @endif
            class="{{ $class }}"
            @foreach($attributes as $key => $value)
                {{ $key }}="{{ $value }}"
            @endforeach
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @else
                <option value="">- Select {{ $label ?: 'Option' }} -</option>
            @endif
            @foreach($options as $key => $option)
                <option value="{{ $key }}" {{ $selectValue == $key ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    @endif
    @if($hint)
        <div class="field-hint">{{ $hint }}</div>
    @endif
    @error($name) <span class="field-error">{{ $message }}</span> @enderror
</div>