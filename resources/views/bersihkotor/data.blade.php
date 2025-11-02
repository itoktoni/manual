<x-layout>
    <div id="success-message" data-message="{{ session('success') }}" style="display: none;"></div>
    <x-card title="{{ ucfirst('transaksi') }}">
        <div class="card-table">
            <div class="form-table-container">
                <form id="filter-form" class="form-table-filter" method="GET" action="{{ route(module('getData')) }}">
                    <div class="row">
                        <x-input name="bersih_code" type="text" placeholder="Search by Transaksi Id" :value="request('bersih_code')" col="6"/>
                        <x-input name="bersih_tanggal" type="date" placeholder="Search by Transaksi Id Jenis" :value="request('bersih_tanggal')" col="6"/>
                    </div>
                    <div class="row">
                        <x-select name="perpage" :options="['10' => '10', '20' => '20', '50' => '50', '100' => '100']" :value="request('perpage', 10)" col="2" id="perpage-select"/>
                        <x-select name="filter" :options="['' => 'All Filter', 'bersih_id' => 'Transaksi Id', 'bersih_id_jenis' => 'Transaksi Id Jenis']" :value="request('filter')" col="4"/>
                        <x-input name="search" type="text" placeholder="Enter search term" :value="request('search')" col="6"/>
                    </div>
                    <div class="form-actions">
                        <x-button type="button" class="secondary" :attributes="['onclick' => 'window.location.href=\'' . url()->current() . '\'']">Reset</x-button>
                        <x-button type="submit" class="primary">Search</x-button>
                    </div>
                </form>
                <div class="form-table-content">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="checkbox-column"><input type="checkbox" class="checkall" /></th>
                                    <th class="text-center actions">Actions</th>
                                    <x-th column="bersih_code" text="Code" />
                                    <x-th :sortable=true column="bersih_rs" text="Rumah Sakit" />
                                    <x-th :sortable=true column="bersih_tanggal" text="Tanggal" />
                                    <x-th column="bersih_qty" text="Qty" />
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hide-lg">
                                    <td data-label="Check All Data" class="checkbox-column">
                                        <input type="checkbox" class="checkall" />
                                    </td>
                                </tr>
                                @forelse($data as $list)
                                    <tr>
                                        <td class="checkbox-column"><input type="checkbox" class="row-checkbox" value="{{ $list->field_key }}" /></td>
                                        <td data-label="Actions">
                                            <x-action-table :model="$list"/>
                                        </td>
                                        <x-td field="bersih_code" :model="$list" />
                                        <x-td field="bersih_rs_nama" :model="$list" />
                                        <td data-label="Tanggal">{{ formatDate($list->bersih_tanggal) }}</td>
                                        <x-td field="bersih_qty" :model="$list" />
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="18" class="text-center">No transaksi found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-pagination :data="$data" />
            </div>
        </div>
        <x-footer type="list" />

        <form id="bulk-delete-form" method="POST" action="{{ route(module('postBulkDelete')) }}" style="display: none;">
            @csrf
            <input type="hidden" name="ids" id="bulk-delete-ids">
        </form>
    </x-card>

</x-layout>