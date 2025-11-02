@props(['action', 'method' => 'POST', 'class' => 'form-container', 'model', 'upload' => false])

@php
    $action = $action ?? '';
    if (empty($action) && function_exists('module')) {
        if ($model) {
            $action = route(module('postUpdate'), $model);
        } else {
            $action = route(module('postCreate'));
        }
    }
@endphp

<form class="{{ $class }}" action="{{ $action }}" method="{{ $method }}" @if($upload) enctype="multipart/form-data" @endif>
    @csrf
    {{ $slot }}
</form>