@props(['column', 'route', 'text'])

<a href="{{ sortUrl($column, $route) }}" class="{{ request('sort') === $column ? 'sorted' : '' }}" style="text-decoration: none; color: var(--color-primary);">
    {{ $text }}
    @if(request('sort') === $column)
        <i class="ml-1 bi bi-sort-{{ request('direction') === 'asc' ? 'up-alt' : 'down' }}"></i>
    @endif
</a>