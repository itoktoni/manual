<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">

            <x-select name="rs" value="{{ $model->kotor_rs_id ?? null }}" label="Rumah Sakit" :model="$model" :options="$rs" />
            <x-input type="text" name="jenis" value="{{ old('jenis') ?? request()->get('jenis') }}" label="Filter Jenis" />

            <input type="hidden" name="type" value="KOTOR" />

            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 1%" class="checkbox-column">No.</th>
                            <th style="width: 60%">Jenis Linen</th>
                            <th style="width: 10%" class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis as $key => $value)
                        @php
                        $single = $transaksi ? $transaksi->where('transaksi_id_jenis', $key)->first() : null;
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][transaksi_id]" value="{{ $single->transaksi_id ?? null }}" />
                            <input type="hidden" name="qty[{{ $key }}][transaksi_type]" value="{{ $transaksi ?? null }}" />
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td data-label="Kotor" class="actions">
                                <input type="number" min="0" value="{{ $single->transaksi_qty ?? null }}" name="qty[{{ $key }}][qty]" />
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <x-footer :model="$model" />

        </x-form>


        <style>
            .table{
                border: lightgray;
            }

            .table th,
            .table td {
                vertical-align: middle;
                padding: 0.5rem 1rem;
            }

        </style>
    </x-card>
</x-layout>
