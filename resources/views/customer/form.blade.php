<x-layout>
    <x-card :model="$model">
        <x-form :model="$model" :upload="true">
            <x-input :model="$model" name="customer_code" readonly="{{ $model ? true : false }}" hint="Customer Code cannot be changed" required />

            <x-input :model="$model" name="customer_nama"  />

            <x-input :model="$model" name="customer_alamat"  />

            <x-upload
                :model="$model"
                name="customer_logo"
                col="6"
            />

            <x-footer :model="$model" />

        </x-form>
    </x-card>
</x-layout>