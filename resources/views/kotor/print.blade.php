<x-report print="print">

    <div class="header-action">
        <nav>
            <x-action-print :report-name="'Laporan Kotor'" />
        </nav>
    </div>

    <table border="0" class="header" width="100%">

        <tr>
            <td></td>
            <td colspan="10">
                @if ($customer)
                    <img style="height:60px;top:5px;" class="logo"
                        src="{{ asset('storage/' . $customer->customer_logo) }}" alt="logo">
                @endif
            </td>
        </tr>

        <tr>
            <td></td>
            <td colspan="10">
                <h2>
                    <b>DETAIL TRANSAKSI KOTOR </b>
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
                    Periode : {{ formatDate($model->kotor_tanggal) }}
                </h3>
            </td>
        </tr>
    </table>

    <h6 style="font-weight: bold;font-size:0.8rem;margin-bottom:5px">
        KODE : {{ $model->kotor_code ?? null }}
    </h6>

    <div class="table-responsive" id="table_data">

        <table id="export" border="1" style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100%;"
            class="table table-bordered table-striped table-responsive-stack">
            <thead>
                <tr>
                    <th style="width: 5%;">No. </th>
                    <th style="width: 70%;">NAMA JENIS LINEN</th>
                    <th style="width: 10%;">QTY</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_berat = 0;
                @endphp

                @forelse($data as $table)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $table->jenis_nama }}</td>
                        <td>{{ $table->field_qty }}</td>
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
