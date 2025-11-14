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
                            REKAP PENDING
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
                        @foreach ($periode as $tgl)
                            <th>{{ $tgl->format('d') }}</th>
                        @endforeach
                        <th class="text-right" style="width: 50px">PENDING</th>
                        <th class="text-right" style="width: 50px">BAYAR</th>
                        <th class="text-right" style="width: 50px">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_row = count($periode) + 4;
                    @endphp

                    @forelse($jenis as $table)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $table->field_name ?? '' }}</td>
                             @foreach ($periode as $tgl)
                                @php
                                $qty = $data
                                ->where('tanggal', $tgl->format('Y-m-d'))
                                ->where('jenis', $table->field_key);
                                @endphp
                                <td>{{ $qty->sum('minus') }}</td>
                                @endforeach
                            <td class="text-right">{{ $data->where('jenis', $table->field_key)->sum('minus') }}</td>
                            <td class="text-right">{{ $data->where('jenis', $table->field_key)->sum('plus') }}</td>
                            <td class="text-right">{{ $data->where('jenis', $table->field_key)->sum('pending') }}</td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-right" colspan="{{ $total_row }}">Saldo Awal Pending Akumulasi Sebelum Tanggal {{ formatDate($request->start) }}</td>
                        <td class="text-right">{{ $saldo ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="{{ $total_row }}">Total</td>
                        <td class="text-right">{{ $data->sum('pending') + $saldo }}</td>
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
