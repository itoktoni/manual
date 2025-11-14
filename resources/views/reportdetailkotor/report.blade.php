<x-report>

    <div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

    <div class="container">
        <div class="invoice-header">
            <table>
                <tr>
                    <td colspan="5">
                        <h1>
                            DETAIL TRANSAKSI KOTOR
                        </h1>
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $customer->customer_logo) }}" alt="Company logo" />
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h2>
                            CUSTOMER : {{ strtoupper($customer->customer_nama ?? '') }}
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h3>
                            Periode : {{ formatDate($request->start ?? null) }} -
                            {{ formatDate($request->end ?? null) }}
                        </h3>
                    </td>
                </tr>
            </table>

        </div>

        <br>

        <div class="table-responsive" id="table_data">
            <table id="export" border="1"
                style="border-collapse: collapse !important; border-spacing: 0 !important;"
                class="table table-bordered table-striped table-responsive-stack">
                <thead>
                    <tr>
                        <th width="1">NO. </th>
                        <th style="width: 300px">JENIS LINEN</th>
                        <th class="text-right" style="width: 100px">TANGGAL</th>
                        <th class="text-right" style="width: 50px">QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_berat = 0;
                    @endphp

                    @forelse($data as $table)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $table->field_jenis_name ?? '' }}</td>
                            <td class="text-right">{{ $table->field_tanggal ?? null }}</td>
                            <td class="text-right">{{ $table->field_kotor ?? 0 }}</td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-right" colspan="3">Total</td>
                        <td class="text-right">{{ $data->sum('kotor') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="invoice-footer">
            <h5>{{ $customer->customer_alamat ?? '' }}, {{ date('d F Y') }}</h5>
			<br>
            <h5>{{ auth()->user()->name ?? '' }}</h5>
        </div>
    </div>

</x-report>
