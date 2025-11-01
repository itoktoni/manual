@props(['model', 'type' => 'default'])

<div class="action-table">

    @if($slot->isEmpty())
        @if($type === 'default')
            <a href="{{ route(module('getUpdate'), $model) }}" class="button primary">
                <i class="bi bi-pencil-square"></i>
            </a>

            <button type="button" class="button danger" onclick="confirmDelete('{{ route(module('getDelete'), $model) }}', '{{ $model->field_key }}')">
                <i class="bi bi-trash"></i>
            </button>
        @endif
    @else
        {{ $slot }}
    @endif

</div>