@props(['column', 'text' => null, 'sortable' => false, 'width' => null, 'class' => ''])

@php
    // Use column as text if text is not provided
    $sourceText = $text ?: $column;

    // Auto-clean label text by removing prefix before first underscore
    $displayText = $sourceText;

    // Remove everything before first underscore (including the underscore)
    if (strpos($displayText, '_') !== false) {
        $displayText = substr($displayText, strpos($displayText, '_') + 1);
    }

    // Capitalize first letter
    $displayText = ucfirst($displayText);
@endphp

<th @if($width) style="width: {{ $width }}; min-width: {{ $width }};" @endif class="{{ $class }}">
    @if($sortable)
        <x-sort-link column="{{ $column }}" route="{{ module('getData') }}" text="{{ $displayText }}" />
    @else
        {{ $displayText }}
    @endif
</th>