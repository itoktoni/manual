<x-layout>
    <x-card title="Rekap Kotor" :model="$model">
        <x-form :model="$model">
            <x-select name="customer" :col="6" value="{{ $model->customer_code ?? null }}" label="Customer" :model="$model" :options="$customer" />
            <x-input  name="tanggal" type="date" :col="3" value="{{ $model->tanggal ?? null }}" label="Tanggal QC" />
            <x-input type="text" :col="3" id="jenis-filter" value="" label="Filter Jenis" />

            <input type="hidden" name="type" value="KOTOR" />

            <div class="col-12">
                <h5 style="text-align: right;margin-right: 1rem;">
                    <input type="checkbox" value="checked" {{ request()->get('fill') == 'checked' ? 'checked' : '' }} style="margin-left: 1rem;" name="fill" id="fill"> <span style="posi">Isi Sesuai Kotor</span>
                </h5>
            </div>
            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 1%" class="checkbox-column">No.</th>
                            <th style="width: 60%">Jenis Linen</th>
                            <th style="width: 10%" class="text-center">Kotor</th>
                            <th style="width: 10%" class="text-center">QC</th>
                            <th style="width: 20%" class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="jenis-tbody">
                        @foreach ($jenis as $key => $value)
                        @php
                        $single = $transaksi ? $transaksi->where('jenis_id', $key)->first() : null;
                        $qc = null;
                        if(request()->get('fill') == 'checked')
                        {
                            $qc = ($single->qty ?? 0) - ($single->qc ?? 0);
                            if($qc == 0)
                            {
                                $qc = null;
                            }
                        }
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][transaksi_id]" value="{{ $single->transaksi_id ?? null }}" />
                            <input type="hidden" name="qty[{{ $key }}][transaksi_type]" value="{{ $transaksi ?? null }}" />
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td data-label="Kotor" class="actions text-center">
                                <input type="hidden" min="0" value="{{ $single->qc ?? null }}" name="qty[{{ $key }}][kotor]" />
                                {{ $single->qty ?? null }}
                            </td>
                            <td data-label="QC" class="actions text-center">
                                <input type="hidden" min="0" value="{{ $single->qc ?? null }}" name="qty[{{ $key }}][qc]" />
                                {{ $single->qc ?? null }}
                            </td>
                             <td data-label="Qty" class="actions">
                                <input type="number" class="text-center" value="{{ $qc }}" name="qty[{{ $key }}][qty]" />
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

    const fillCheckbox = document.getElementById('fill');
    if (fillCheckbox) {
        fillCheckbox.addEventListener('change', function() {
            const currentUrl = new URL(window.location);

            if (this.checked) {
                currentUrl.searchParams.set('fill', 'checked');
            } else {
                currentUrl.searchParams.delete('fill');
            }

            window.location.href = currentUrl.toString();
        });
    }

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
