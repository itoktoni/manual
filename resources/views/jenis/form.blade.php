<x-layout>
    <x-card :model="$model" title="Jenis Linen">
        <x-form :model="$model">
            <x-select name="jenis_code_rs" label="Rs" :model="$model" :options="$rs" />
            <x-input :model="$model" name="jenis_nama" />

            <x-input :model="$model" col="4" type="number" name="jenis_harga" />
            <x-input :model="$model" col="4" type="number" name="jenis_fee" />
            <x-input :model="$model" col="4" type="number" name="jenis_total" />

            <x-footer :model="$model" />
        </x-form>
    </x-card>
</x-layout>