<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">
            <x-input :model="$model" type="number" name="ruangan_id" required />

            <x-input :model="$model" name="ruangan_code"  />

            <x-input :model="$model" name="ruangan_nama"  />

            <x-input :model="$model" name="ruangan_id_rs"  />

            <x-footer :model="$model" />

        </x-form>
    </x-card>
</x-layout>