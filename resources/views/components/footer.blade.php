@props(['model', 'type' => 'form'])
<footer class="content-footer safe-area-bottom">
    <div class="form-actions">
        @if($slot->isEmpty())
            @if($type === 'form')
                <a href="{{ route(module('index')) }}" class="button secondary">Kembali</a>
                <x-button type="submit" class="primary">{{ isset($model) ? 'Simpan' : 'Buat' }}</x-button>
            @elseif($type === 'report')
                <a href="{{ route(module('index')) }}" class="button secondary">Kembali</a>
                <x-button type="submit" class="primary">{{ isset($model) ? 'Report' : 'Report' }}</x-button>
            @elseif($type === 'list')
                <button type="button" class="button danger" id="bulk-delete-btn" disabled onclick="confirmBulkDelete()">Delete</button>
                <a href="{{ route(module('getCreate')) }}" class="button success">
                    <i class="bi bi-plus"></i>Buat
                </a>
            @endif
        @else
            {{ $slot }}
        @endif
    </div>
</footer>