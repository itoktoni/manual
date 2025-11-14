<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">

            <x-select col="6" :model="$model" name="customer" :options="$customer"  />
            <x-select col="6" :model="$model" name="type" :options="$type"  />
            <x-input col="6" :model="$model" type="date" label="Tanggal Posting Awal" value="{{ now()->addDay(-1)->format('Y-m-d') }}" name="start"  />
            <x-input col="6" :model="$model" type="date" label="Tanggal Posting Akhir" name="end" value="{{ date('Y-m-d') }}" />

            @if ($model)

            <x-input col="2" :model="$model" type="number" name="kotor"  />
            <x-input col="2" :model="$model" type="number" name="qc"  />
            <x-input col="2" :model="$model" type="number" name="bersih"  />
            <x-input col="2" :model="$model" type="number" name="pending"  />
            <x-input col="2" :model="$model" type="number" name="plus"  />
            <x-input col="2" :model="$model" type="number" name="minus"  />

            @endif

            <x-footer :model="$model" />

        </x-form>
    </x-card>
</x-layout>