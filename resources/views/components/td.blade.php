@props(['field', 'model', 'label' => null, 'width' => null, 'class' => ''])

@php
    // Auto-clean label text by removing prefix before first underscore
    $displayLabel = $label ?: $field;

    // Remove everything before first underscore (including the underscore)
    if (strpos($displayLabel, '_') !== false) {
        $displayLabel = substr($displayLabel, strpos($displayLabel, '_') + 1);
    }

    // Capitalize first letter
    $displayLabel = ucfirst($displayLabel);
@endphp

<td data-label="{{ $displayLabel }}" @if($width) style="width: {{ $width }}; min-width: {{ $width }};" @endif class="{{ $class }}">
    {{ $model->$field }}
</td>