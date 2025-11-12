<x-layout>
    <x-card title="Form Packing Bersih Kotor" :model="$model">
        <x-form :model="$model">

             @livewire('packing-kotor-form', ['model' => $model ?? null])

            <x-footer :model="$model">
                <a href="{{ route(module('getData')) }}" class="button secondary">Kembali</a>
                @if($model)
                <a href="{{ route(module('getPrint'), ['code' => $model->field_key]) }}" class="button danger">Print</a>
                @endif
                <x-button type="submit" class="primary">{{ isset($model) ? 'Simpan' : 'Buat' }}</x-button>
            </x-footer>

        </x-form>

        </style>
    </x-card>
</x-layout>