<x-layout>
    <div id="success-message" data-message="{{ session('success') }}" style="display: none;"></div>
    <x-card title="{{ ucfirst('customer') }}">
        <div class="card-table">
            <div class="form-table-container">
                <form id="filter-form" class="form-table-filter" method="GET" action="{{ route(module('getData')) }}">
                    <div class="row">
                        <x-input name="customer_code" type="text" placeholder="Search by Code" :value="request('customer_code')" col="6"/>
                        <x-input name="customer_nama" type="text" placeholder="Search by Nama" :value="request('customer_nama')" col="6"/>
                    </div>
                    <div class="row">
                        <x-select name="perpage" :options="['10' => '10', '20' => '20', '50' => '50', '100' => '100']" :value="request('perpage', 10)" col="2" id="perpage-select"/>
                        <x-select name="filter" :options="['' => 'All Filter', 'customer_code' => 'Customer Code', 'customer_nama' => 'Customer Nama']" :value="request('filter')" col="4"/>
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
                                    <x-th column="customer_code" text="Customer Code" />
                                    <x-th column="customer_nama" text="Customer Nama" />
                                    <x-th column="customer_alamat" text="Customer Alamat" />
                                    <x-th width="120px" column="customer_logo" text="Rs Logo"  />
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
                                            <x-action-table :model="$list" />
                                        </td>
                                        <x-td field="customer_code" :model="$list" />
                                        <x-td field="customer_nama" :model="$list" />
                                        <x-td field="customer_alamat" :model="$list" />
                                        <td data-label="Logo">
                                            <x-image src="{{ asset('storage/' . $list->customer_logo) }}" alt="RS Logo" popup="true" class="mb-3" rounded width="150"/>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No customer found</td>
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