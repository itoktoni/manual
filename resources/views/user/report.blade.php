<x-report>

	<div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

    <table border="0" class="header" width="100%">
        <tr>
            <td></td>
            <td colspan="6">
                <h2>
                    <b>DETAIL TRANSAKSI KOTOR </b>
                </h2>
            </td>
            <td rowspan="3">
				<img style="position: absolute;left:500px;height:60px;top:5px;" src="{{ asset('storage/' . $customer->customer_logo) }}" alt="logo">
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="10">
                <h3>
                    CUSTOMER : {{ strtoupper($customer->customer_nama ?? '') }}
                </h3>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="10">
                <h3>
                    Periode : {{ formatDate($model->kotor_tanggal) }}
                </h3>
            </td>
        </tr>
    </table>

<div class="table-responsive" id="table_data">
	<table id="export" border="1" style="border-collapse: collapse !important; border-spacing: 0 !important;"
		class="table table-bordered table-striped table-responsive-stack">
		<thead>
			<tr>
				<th width="1">No. </th>
				<th>ID USER</th>
				<th>NAMA USER</th>
				<th>USERNAME</th>
				<th>EMAIL</th>
				<th>TANGGAL</th>
			</tr>
		</thead>
		<tbody>
			@php
			$total_berat = 0;
			@endphp

			@forelse($data as $table)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $table->field_primary }}</td>
				<td>{{ $table->field_name }}</td>
				<td>{{ $table->field_username }}</td>
				<td>{{ $table->field_email }}</td>
				<td>{{ formatDate($table->created_at) }}</td>
			</tr>
			@empty
			@endforelse

		</tbody>
	</table>
</div>

<table class="footer">
	<tr>
		<td colspan="2" class="print-date">{{ $customer->customer_alamat ?? '' }}, {{ date('d F Y') }}</td>
	</tr>
	<tr>
		<td colspan="2" class="print-person">{{ auth()->user()->name ?? '' }}</td>
	</tr>
</table>
</x-report>