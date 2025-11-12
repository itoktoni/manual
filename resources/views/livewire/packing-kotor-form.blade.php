<div class="row">

<x-select name="customer" id="customer" :col="6" wire:model.live="customerField" label="Customer" :options="$customer" />
<x-input name="tanggal" id="tanggal" type="date" :col="4" wire:model.live="tanggal" label="Tanggal" />

<div class="col-2">
    <h5 style="text-align: right;position:relative;margin-top:4rem">
        <input type="checkbox" wire:model.live="checked" style="margin-left: 1rem;" name="checked" id="fill"> <span style="posi">Isi Sesuai QC</span>
    </h5>
</div>

<x-select name="jenis" id="jenis" :col="6" wire:model.live="jenisField" label="Jenis Linen" :options="$jenis" />
<x-input name="qc" type="number" :col="2" wire:model.live="qcValue" label="QC" readonly/>
<x-input name="bc" type="number" :col="2" wire:model.live="bcValue" label="Bersih" readonly/>
<x-input name="qty" type="number" :col="2" wire:model.live="qty" label="QTY" />

</div>