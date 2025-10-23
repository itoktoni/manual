<x-layout>
    <x-card :model="$model">
        <x-form :model="$model" :upload="true">
            <x-input :model="$model" name="rs_code" :attributes="isset($model) ? ['readonly' => true] : []" hint="Rs Code cannot be changed" required />

            <x-input :model="$model" name="rs_nama"  />

            <x-input :model="$model" name="rs_alamat"  />

            <x-upload
                :model="$model"
                name="rs_logo"
                col="6"
            />

            <x-footer :model="$model" />

        </x-form>
    </x-card>
</x-layout>