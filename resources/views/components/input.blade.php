@props(['col' => 12, 'type' => 'text', 'id' => '', 'name' => '', 'value' => '', 'model' => null, 'placeholder' => '', 'required' => false, 'class' => 'form-input', 'label' => '', 'hint' => ''])

@php
    // Auto-generate label from field name if not provided
    $displayLabel = $label;
    if (empty($displayLabel) && $name) {
        // Remove common prefixes and format
        $cleanName = $name;
        if (strpos($cleanName, '_') !== false) {
            $cleanName = substr($cleanName, strpos($cleanName, '_') + 1);
        }
        $displayLabel = ucfirst($cleanName);
    }

    // Check if this is a checkbox
    $isCheckbox = $type === 'checkbox';

    // Set checkbox container class
    $containerClass = $isCheckbox ? 'form-group form-group-checkbox col-' . $col : 'form-group col-' . $col;
@endphp

<div class="{{ $containerClass }}">
    @if(!$isCheckbox)
        <label for="{{ $id }}" class="form-label">
            {{ $displayLabel }}@if($required)<span class="required-asterisk">*</span>@endif
        </label>
    @endif

    @php
        $inputValue = $value;
        $currentModel = null;

        // Try to get model from props
        if ($model) {
            $currentModel = $model;
        } else {
            // Try to get from route parameters (for update forms)
            $route = request()->route();
            if ($route) {
                $parameters = $route->parameters();
                foreach ($parameters as $param) {
                    if (is_object($param) && method_exists($param, 'getAttributes')) {
                        $currentModel = $param;
                        break;
                    }
                }
            }
        }

        if ($currentModel && $name) {
            $inputValue = old($name, $model->$name);
        } elseif ($name) {
            $inputValue = old($name, $value);
        }

        // Check if checkbox should be checked
        $isChecked = false;
        if ($isCheckbox && $currentModel && $name) {
            $isChecked = (bool) $currentModel->$name;
        } elseif ($isCheckbox && $name) {
            $isChecked = old($name, $value) ? true : false;
        }
    @endphp

    @if($isCheckbox)
        <div class="checkbox-wrapper">
            @if($displayLabel)
                <label for="{{ $id }}" class="checkbox-toggle-label">
                    {{ $displayLabel }}@if($required)<span class="required-asterisk">*</span>@endif
                </label>
            @endif
            <label class="toggle-switch">
                <input
                    type="{{ $type }}"
                    id="{{ $id }}"
                    name="{{ $name }}"
                    value="{{ $inputValue ?? '' }}"
                    @if($isChecked) checked @endif
                    @if($required) required @endif
                    class="toggle-input {{ $class }}"
                    @foreach($attributes as $key => $val)
                        @if($val === true)
                            {{ $key }}
                        @elseif(is_string($val) && ($val === $key || in_array($val, ['readonly', 'disabled', 'checked', 'selected'])))
                            {{ $key }}
                        @elseif($val !== false && $val !== null && $val !== '')
                            {{ $key }}="{{ $val }}"
                        @endif
                    @endforeach
                />
                <span class="toggle-slider"></span>
            </label>
        </div>
    @else
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $inputValue ?? '' }}"
            placeholder="{{ is_string($placeholder) ? $placeholder : '' }}"
            @if($required) required @endif
            class="{{ $class }}"
            @foreach($attributes as $key => $val)
                @if($val === true)
                    {{ $key }}
                @elseif(is_string($val) && ($val === $key || in_array($val, ['readonly', 'disabled', 'checked', 'selected'])))
                    {{ $key }}
                @elseif($val !== false && $val !== null && $val !== '')
                    {{ $key }}="{{ $val }}"
                @endif
            @endforeach
        />
    @endif

    @if(!$isCheckbox && $hint)
        <div class="field-hint">{{ $hint }}</div>
    @endif

    @error($name) <span class="field-error">{{ $message }}</span> @enderror
</div>
