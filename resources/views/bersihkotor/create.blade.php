<x-layout>
    <x-card title="Form Pengiriman Bersih Kotor" :model="$model">
        <x-form :model="$model">
            <x-select name="customer" id="customer" :col="6" value="{{ request()->get('customer') ?? $model->customer_code ?? null }}" label="Customer" :model="$model" :options="$customer" />
            <x-input name="tanggal" id="tanggal" type="date" :col="3" value="{{ request()->get('tanggal') ?? $model->bersih_kotor_tanggal ?? date('Y-m-d') }}" label="Tanggal" />
            <x-input type="text" :col="3"  id="jenis-filter" value="" label="Filter Jenis" />

            <input type="hidden" name="type" value="KOTOR" />

            <div class="col-12">
                <h5 style="text-align: right;margin-right: 1rem;">
                    <input type="checkbox" value="checked" {{ request()->get('fill') == 'checked' ? 'checked' : '' }} style="margin-left: 1rem;" name="fill" id="fill"> <span style="posi">Isi Sesuai QC</span>
                </h5>
            </div>

            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 1%" class="checkbox-column">No.</th>
                            <th style="width: 60%">Jenis Linen</th>
                            <th style="width: 5%" class="text-center">QC</th>
                            <th style="width: 5%" class="text-center">Bersih</th>
                            <th style="width: 10%" class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="jenis-tbody">
                        @foreach ($jenis as $key => $value)
                        @php
                        $qty = $transaksi ? $transaksi->where('bkotor_id_jenis', $key)->sum('bkotor_qty') : 0;
                        $check = $qc ? $qc->where('jenis_id', $key)->first() : null;

                        $kotor = null;
                        if(request()->get('fill') == 'checked')
                        {
                            $kotor =($check->qc ?? 0) - ($check->bc ?? 0) ;
                        }
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][kotor_id]" value="{{ $single->kotor_id ?? null }}" />
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td class="text-center">{{ $check->qc ?? 0 }}</td>
                            <td class="text-center">{{ $check->bc ?? 0 }}</td>
                            <td data-label="Kotor" class="actions">
                                <input type="number" class="text-center" value="{{ $kotor ?? $qty ?? null }}" name="qty[{{ $key }}][qty]" />
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

             <x-footer :model="$model">
                <a href="{{ route(module('getData')) }}" class="button secondary">Kembali</a>
                @if($model)
                <a href="{{ route(module('getPrint'), ['code' => $model->field_key]) }}" class="button danger">Print</a>
                @endif
                <x-button type="submit" class="primary">{{ isset($model) ? 'Simpan' : 'Buat' }}</x-button>
            </x-footer>

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

    // Handle customer select change
    const customerSelect = document.getElementById('customer');
    if (customerSelect) {
        customerSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location);

            if (selectedValue) {
                currentUrl.searchParams.set('customer', selectedValue);
            } else {
                currentUrl.searchParams.delete('customer');
            }

            // Preserve tanggal parameter
            const tanggalValue = document.getElementById('tanggal').value;
            if (tanggalValue) {
                currentUrl.searchParams.set('tanggal', tanggalValue);
            } else {
                currentUrl.searchParams.delete('tanggal');
            }

            window.location.href = currentUrl.toString();
        });
    }

    // Handle tanggal input change
    const tanggalInput = document.getElementById('tanggal');
    if (tanggalInput) {
        tanggalInput.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location);

            if (selectedValue) {
                currentUrl.searchParams.set('tanggal', selectedValue);
            } else {
                currentUrl.searchParams.delete('tanggal');
            }

            // Preserve customer parameter
            const customerValue = document.getElementById('customer').value;
            if (customerValue) {
                currentUrl.searchParams.set('customer', customerValue);
            } else {
                currentUrl.searchParams.delete('customer');
            }

            window.location.href = currentUrl.toString();
        });
    }

    // Handle jenis filter
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
