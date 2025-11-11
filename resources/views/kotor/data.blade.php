<x-layout>
    <div id="success-message" data-message="{{ session('success') }}" style="display: none;"></div>
    <x-card title="{{ ucfirst('transaksi') }}">
        <div class="card-table">
            <div class="form-table-container">
                <form id="filter-form" class="form-table-filter" method="GET" action="{{ route(module('getData')) }}">
                    <div class="row">
                        <x-input :col="2" name="kotor_tanggal" type="date" placeholder="Search by Tanggal" :value="request('kotor_tanggal')"/>
                        <x-input :col="4" name="kotor_code" type="text" placeholder="Search by Code" :value="request('kotor_code')"/>
                        <x-select :col="6" name="customer_code" label="Customer" :model="$model" :options="$customer" />
                    </div>
                    <div class="row">
                        <x-select name="perpage" :options="['10' => '10', '20' => '20', '50' => '50', '100' => '100']" :value="request('perpage', 10)" col="2" id="perpage-select"/>
                        <x-select name="filter" :options="['' => 'All Filter', 'customer_code' => 'Nama Customer']" :value="request('filter')" col="4"/>
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
                                    <x-th column="kotor_code" text="Code" />
                                    <x-th :sortable=true column="kotor_rs" text="Customer" />
                                    <x-th :sortable=true column="kotor_tanggal" text="Tanggal" />
                                    <x-th column="kotor_qty" text="Qty" />
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
                                             <x-action-table :model="$list" type="disable">
                                                <a href="{{ route(module('getUpdate'), ['code' => $list->field_key]) }}" class="button primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <button type="button" class="button danger" onclick="confirmDelete('{{ route(module('getDelete'), $list) }}', '{{ $list->field_key }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <a target="_blank" href="{{ route(module('getPrint'), ['code' => $list->field_key]) }}" class="button success">
                                                    Print
                                                </a>

                                            </x-action-table>
                                        </td>
                                        <x-td field="kotor_code" :model="$list" />
                                        <x-td field="customer_nama" :model="$list" />
                                        <td data-label="Tanggal">{{ formatDate($list->kotor_tanggal) }}</td>
                                        <x-td field="kotor_qty" :model="$list" />
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