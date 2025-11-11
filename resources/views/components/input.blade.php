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
@endphp

<div class="form-group col-{{ $col }}">
    <label for="{{ $id }}" class="form-label">
        {{ $displayLabel }}@if($required)<span class="required-asterisk">*</span>@endif
    </label>
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
    @endphp
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
    @if($hint)
        <div class="field-hint">{{ $hint }}</div>
    @endif
    @error($name) <span class="field-error">{{ $message }}</span> @enderror
</div>

