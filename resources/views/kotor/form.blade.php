<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">
            <x-select name="customer" id="customer" :col="6" value="{{ $model->customer_code ?? null }}" label="Customer" :model="$model" :options="$customer" />
            <x-input  name="tanggal" type="date" :col="3" value="{{ $model->kotor_tanggal ?? date('Y-m-d') }}" label="Tanggal" />
            <x-input type="text" :col="3"  id="jenis-filter" value="" label="Filter Jenis" />

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
                    <tbody id="jenis-tbody">
                        @foreach ($jenis as $key => $value)
                        @php
                        $single = $transaksi ? $transaksi->where('kotor_id_jenis', $key)->first() : null;
                        @endphp
                        <tr>
                            <input type="hidden" name="qty[{{ $key }}][kotor_id]" value="{{ $single->kotor_id ?? null }}" />
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $value }}</td>
                            <td data-label="Kotor" class="actions">
                                <input type="number" min="0" value="{{ $single->kotor_qty ?? null }}" name="qty[{{ $key }}][qty]" />
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

    </x-card>
</x-layout>


<script>
document.addEventListener('DOMContentLoaded', function() {
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
