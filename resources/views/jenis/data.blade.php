<x-layout>
    <div id="success-message" data-message="{{ session('success') }}" style="display: none;"></div>
    <x-card title="{{ ucfirst('jenis') }}">
        <div class="card-table">
            <div class="form-table-container">
                <form id="filter-form" class="form-table-filter" method="GET" action="{{ route(module('getData')) }}">
                    <div class="row">
                         <x-select name="jenis_code_rs" label="Rs" :model="$model" :options="$rs" />
                         <x-input name="jenis_nama" type="text" placeholder="Search by Jenis Nama" :value="request('jenis_nama')" col="6"/>
                     </div>
                    <div class="row">
                        <x-select name="perpage" :options="['10' => '10', '20' => '20', '50' => '50', '100' => '100']" :value="request('perpage', 10)" col="2" id="perpage-select"/>
                        <x-select name="filter" :options="['' => 'All Filter', 'jenis_id' => 'Jenis Id', 'jenis_nama' => 'Jenis Nama']" :value="request('filter')" col="4"/>
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
                                    <x-th column="jenis_id" text="Id" :model="$data->first()" />
                                    <x-th column="jenis_code_rs" text="Rs" :model="$data->first()" />
                                    <x-th column="jenis_nama" text="Jenis Nama" :model="$data->first()" />
                                    <x-th column="jenis_harga" text="Harga" :model="$data->first()" />
                                    <x-th column="jenis_fee" text="Fee" :model="$data->first()" />
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
                                        <x-td field="jenis_id" :model="$list" />
                                        <x-td field="rs_nama" :model="$list" />
                                        <x-td field="jenis_nama" :model="$list" />
                                        <x-td field="jenis_harga" :model="$list" />
                                        <x-td field="jenis_fee" :model="$list" />
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No jeniss found</td>
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