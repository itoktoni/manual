<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">
            <x-select name="rs" :col="6" value="{{ $model->bersih_rs_code ?? $qc->rekap_code_rs ?? null }}" label="Rumah Sakit" :model="$model" :options="$rs" />
            <x-input  name="tanggal" type="date" :col="3" value="{{ $model->bersih_tanggal ?? $qc->rekap_tanggal ?? date('Y-m-d') }}" label="Tanggal" />
            <x-input type="text" :col="3"  id="jenis-filter" value="" label="Filter Jenis" />

            <input type="hidden" name="type" value="KOTOR" />

            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 1%" class="checkbox-column">No.</th>
                            <th style="width: 60%">Jenis Linen</th>
                            <th style="width: 10%" class="text-center">QC</th>
                            <th style="width: 10%" class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="jenis-tbody">
                        @foreach ($jenis as $key => $value)
                        @php
                        $single = $transaksi ? $transaksi->where('rekap_id_jenis', $key)->first() : null;
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][transaksi_id]" value="{{ $single->rekap_id ?? null }}" />
                            <input type="hidden" value="{{ $single->rekap_qc ?? null }}" name="qty[{{ $key }}][qty]" />

                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td data-label="Kotor" class="actions text-center">
                                {{ $single->rekap_qc ?? null }}
                            </td>
                            <td data-label="Kotor" class="actions">
                                <input type="number" min="0" value="" name="qty[{{ $key }}][qty]" />
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

            .hidden-row {
                display: none;
            }

        </style>
    </x-card>
</x-layout>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('jenis-filter');
    if (filterInput) {
        filterInput.addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            const tbody = document.getElementById('jenis-tbody');
            const rows = tbody.querySelectorAll('tr');

            rows.forEach(row => {
                const jenisCell = row.querySelector('td:nth-of-type(2)'); // Second td element (Jenis Linen column)
                if (jenisCell) {
                    const jenisText = jenisCell.textContent.toLowerCase();
                    if (jenisText.includes(filterValue)) {
                        row.classList.remove('hidden-row');
                    } else {
                        row.classList.add('hidden-row');
                    }
                }
            });
        });
    }
});
</script>
