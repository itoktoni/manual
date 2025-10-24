<x-layout>
    <x-card :model="$model" title="Upload Ruangan Data">
        <x-form :model="$model" upload="true" method="POST" :action="route(module('postUpload'))">
            <x-upload name="ruangan_file" label="Upload XLSX File" :model="$model" accept=".xlsx" />

            <x-footer :model="$model">
                <a href="{{ route(module('getData')) }}" class="button secondary">Back</a>
                <a href="{{ route(module('getTemplate')) }}" class="button success">Download Template</a>
                <x-button type="submit" class="primary">Upload</x-button>
            </x-footer>
        </x-form>
    </x-card>
</x-layout>