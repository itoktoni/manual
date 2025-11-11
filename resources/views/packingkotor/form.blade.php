<x-layout>
    <x-card title="Form Packing Bersih Kotor" :model="$model">
        <x-form :model="$model">

            @php
            $jenis_id = request()->get('jenis');

            $kotor = null;
            if(request()->get('fill') == 'checked')
            {
                $kotor =($qc->qc ?? 0) - ($qc->bc ?? 0) ;
            }

            @endphp

            <x-select name="customer" id="customer" :col="6" value="{{ request()->get('customer') ?? $model->bkotor_code_customer ?? null }}" label="Customer" :model="$model" :options="$customer" />
            <x-input name="tanggal" id="tanggal" type="date" :col="4" value="{{ request()->get('tanggal') ?? $model->bkotor_tanggal ?? date('Y-m-d') }}" label="Tanggal" />

            <div class="col-2">
                <h5 style="text-align: right;position:relative;margin-top:4rem">
                    <input type="checkbox" value="checked" {{ request()->get('fill') == 'checked' ? 'checked' : '' }} style="margin-left: 1rem;" name="fill" id="fill"> <span style="posi">Isi Sesuai QC</span>
                </h5>
            </div>

            <x-select name="jenis" id="jenis" :col="6" value="{{ request()->get('jenis') ?? $model->bkotor_id_jenis ?? null }}" label="Jenis Linen" :model="$model" :options="$jenis" />
            <x-input name="qc" type="number" :col="2" value="{{ $qc->qc ?? 0 }}" label="QC" readonly/>
            <x-input name="bc" type="number" :col="2" value="{{ $qc->bc ?? 0 }}" label="Bersih" readonly/>
            <x-input name="qty" type="number" :col="2" value="{{ $kotor ?? $model->bkotor_qty ?? 0 }}" label="QTY" />

            <x-footer :model="$model">
                <a href="{{ route(module('getData')) }}" class="button secondary">Kembali</a>
                @if($model)
                <a target="_blank" href="{{ route(module('getPrint'), ['code' => $model->field_key]) }}" class="button danger">Print</a>
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

             // Preserve jenis parameter
            const jenisValue = document.getElementById('jenis').value;
            if (jenisValue) {
                currentUrl.searchParams.set('jenis', jenisValue);
            } else {
                currentUrl.searchParams.delete('jenis');
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

            // Preserve jenis parameter
            const jenisValue = document.getElementById('jenis').value;
            if (jenisValue) {
                currentUrl.searchParams.set('jenis', jenisValue);
            } else {
                currentUrl.searchParams.delete('jenis');
            }

            window.location.href = currentUrl.toString();
        });
    }

    // Handle tanggal input change
    const jenisInput = document.getElementById('jenis');
    if (jenisInput) {
        jenisInput.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location);

            if (selectedValue) {
                currentUrl.searchParams.set('jenis', selectedValue);
            } else {
                currentUrl.searchParams.delete('jenis');
            }

            // Preserve customer parameter
            const customerValue = document.getElementById('customer').value;
            if (customerValue) {
                currentUrl.searchParams.set('customer', customerValue);
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
