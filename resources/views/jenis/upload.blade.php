<x-layout>
    <x-card :model="$model" title="Upload Jenis Data">
        <x-form :model="$model" upload="true">
            <x-upload name="jenis_file" label="Upload XLSX File" :model="$model" accept=".xlsx" />

            <x-footer :model="$model" />
        </x-form>
    </x-card>
</x-layout>