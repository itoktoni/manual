<x-report print="print">

<div class="invoice">

    <!-- HEADER -->
    <div class="invoice-header">
        @if ($customer)
        <h1>
			<img src="{{ asset('storage/' . $customer->customer_logo) }}" alt="Company logo"  />
        </h1>
		@endif
        <h1> PACKING BERSIH KOTOR</h1>
    </div>

    <!-- CUSTOMER INFO -->
    <div class="invoice-info">
        <h2>Customer: {{ strtoupper($customer->customer_nama ?? '') }}</h2>
        <p>Tanggal: {{ formatDate($model->bkotor_tanggal) }}</p>
        <p>Code: {{ $model->field_key ?? null }}</p>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="col-no">No.</th>
                    <th class="col-name text-left" style="width:70%;">Nama Jenis Linen</th>
                    <th class="col-qty" style="width:10%;">Qty</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $table)
					<tr class="item {{ $loop->last ? 'last' : '' }}">
						<td class="col-no">{{ $loop->iteration }}</td>
						<td class="col-name text-left">{{ $table->jenis_nama }}</td>
						<td class="col-qty">{{ $table->field_qty }}</td>
					</tr>
				@empty
					<tr class="item last">
						<td colspan="3">No data available</td>
					</tr>
				@endforelse
            </tbody>
			<tfoot>
				<tr>
					<td colspan="2" style="text-align: right">Total</td>
					<td class="col-qty">{{ $data->sum('bkotor_qty') }}</td>
				</tr>
			</tfoot>
        </table>

        <table class="footer">
            <p>
                {{ $customer->customer_alamat ?? '' }}, {{ date('d F Y') }}
            </p>
            <br>
            <p>
                {{ auth()->user()->name ?? '' }}
            </p>
            <br>
            <span>.</span>
        </table>

    </div>

	 <div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

</div>

</x-report>