<x-layout>
    <x-card title="Report Rekap Kotor" :model="$model">
        <x-form :model="$model">

            <x-select col="4" :model="$model" name="customer" :options="$customer"  />
            <x-input col="2" :model="$model" type="checkbox" label="Posting" name="posting" />
            <x-input col="3" :model="$model" type="date" label="Tanggal Awal" value="{{ now()->addDay(-1)->format('Y-m-d') }}" name="start"  />
            <x-input col="3" :model="$model" type="date" label="Tanggal Akhir" name="end" value="{{ date('Y-m-d') }}" />
            <x-footer type="report" :model="$model" />

        </x-form>
    </x-card>
</x-layout>