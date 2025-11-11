<x-report :print="print">

	<div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

    <table border="0" class="header" width="100%">
         <tr>
            <td></td>
            <td colspan="10">
                @if($customer)
				<img style="height:60px;top:5px;" src="{{ asset('storage/' . $customer->customer_logo) }}" alt="logo">
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="10">
                <h2>
                    <b>PENGIRIMAN BERSIH KOTOR </b>
                </h2>
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
                    Periode : {{ formatDate($model->bkotor_tanggal ?? null) }}
                </h3>
            </td>
        </tr>
    </table>

<div class="table-responsive" id="table_data">
     <h6 style="font-weight: bold;font-size:0.8rem;margin-bottom:5px">
        KODE : {{ $model->bkotor_delivery ?? null }}
    </h6>

	<table id="export" border="1" style="border-collapse: collapse !important; border-spacing: 0 !important;"
		class="table table-bordered table-striped table-responsive-stack">
		<thead>
			<tr>
				<th width="1">No. </th>
				<th>NAMA JENIS LINEN</th>
				<th>QTY</th>
			</tr>
		</thead>
		<tbody>
			@php
			$total_berat = 0;
			@endphp

			@forelse ($jenis as $key => $value)
            @php
            $qty = $data->where('bkotor_id_jenis', $key)->sum('bkotor_qty');
            @endphp

            @if($qty > 0)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $value }}</td>
				<td>{{ $qty }}</td>
			</tr>
            @endif

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