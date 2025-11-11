<x-report print="print">

   <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>

</head>
<body>

<div class="invoice">

    <!-- HEADER -->
    <div class="invoice-header">
         @if ($customer)
			<img src="{{ asset('storage/' . $customer->customer_logo) }}" alt="Company logo"  />
		@endif
        <h1> DETAIL TRANSAKSI KOTOR</h1>
    </div>

    <!-- CUSTOMER INFO -->
    <div class="invoice-info">
        <h2>Customer: {{ strtoupper($customer->customer_nama ?? '') }}</h2>
        <p>Tanggal: {{ formatDate($model->kotor_tanggal) }}</p>
        <p>Code: {{ $model->kotor_code ?? null }}</p>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width:10%;">No.</th>
                    <th class="text-left" style="width:70%;">Nama Jenis Linen</th>
                    <th style="width:20%;">Qty</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $table)
					<tr class="item {{ $loop->last ? 'last' : '' }}">
						<td>{{ $loop->iteration }}</td>
						<td class="text-left">{{ $table->jenis_nama }}</td>
						<td>{{ $table->field_qty }}</td>
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
					<td>{{ $data->sum('bkotor_qty') }}</td>
				</tr>
			</tfoot>
        </table>
    </div>

	 <div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

</div>

</body>
</html>


</x-report>
