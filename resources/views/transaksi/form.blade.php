<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">

            <x-select name="rs" value="{{ $model->kotor_rs_id ?? null }}" label="Rumah Sakit" :model="$model" :options="$rs" />
            <input type="hidden" name="transaksi_date" value="{{ $model->kotor_tanggal ?? date('Y-m-d') }}" />

            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th class="checkbox-column">No.</th>
                            <th style="width: 50%">Jenis Linen</th>
                            <th style="width: 15%" class="text-center">Kotor</th>
                            <th style="width: 15%" class="text-center">Retur</th>
                            <th style="width: 15%" class="text-center">Rewas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis as $key => $value)
                        @php
                        $single = $transaksi ? $transaksi->where('transaksi_id_jenis', $key)->first() : null;
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][transaksi_id]" value="{{ $single->transaksi_id ?? null }}" />
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td data-label="Kotor" class="actions">
                                <input type="number" min="0" value="{{ $single->transaksi_kotor ?? null }}" name="qty[{{ $key }}][kotor]" />
                            </td>
                            <td data-label="Retur" class="actions">
                                <input type="number" min="0" value="{{ $single->transaksi_retur ?? null }}" name="qty[{{ $key }}][retur]" />
                            </td>
                            <td data-label="Rewas" class="actions">
                                <input type="number" min="0" value="{{ $single->transaksi_rewash ?? null }}" name="qty[{{ $key }}][rewash]" />
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
