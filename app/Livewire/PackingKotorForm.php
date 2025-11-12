<?php

namespace App\Livewire;

use App\Helpers\Query;
use App\Models\BersihKotor;
use App\Models\DetailKotor;
use Livewire\Component;

class PackingKotorForm extends Component
{
    public $model;
    public $customer = [];
    public $jenis = [];
    public $qc = null;
    public $kotor = null;

    // Form fields
    public $customerField = '';
    public $tanggal = '';
    public $jenisField = '';
    public $qcValue = 0;
    public $bcValue = 0;
    public $qty = 0;
    public $checked = false;

    // Edit mode
    public $isEdit = false;

    protected $rules = [
        'customerField' => 'required',
        'tanggal' => 'required',
        'jenisField' => 'required',
        'qty' => 'required|numeric',
    ];

    public function mount($model = null)
    {
        $this->customer = Query::getCustomerData();
        $this->tanggal = date('Y-m-d');

        // Check if we're in edit mode
        if ($model) {
            $this->isEdit = true;
            $this->model = $model;
            $this->customerField = $model->bkotor_code_customer ?? '';
            $this->tanggal = $model->bkotor_tanggal ?? date('Y-m-d');
            $this->jenisField = $model->bkotor_id_jenis ?? '';
            $this->qty = $model->bkotor_qty ?? 0;

            // Load jenis options for this customer
            if ($this->customerField) {
                $this->jenis = Query::getJenisData($this->customerField);
            }

            // Load QC data
            $this->loadQcData();
        } else {
            // Create mode - check for URL parameters
            $this->customerField = request()->get('customer', '');
            $this->tanggal = request()->get('tanggal', date('Y-m-d'));
            $this->jenisField = request()->get('jenis', '');
            $this->checked = request()->get('fill') == 'checked';

            // Load jenis options if customer is selected
            if ($this->customerField) {
                $this->jenis = Query::getJenisData($this->customerField);
            }

            // Load QC data and calculate if fill is checked
            if ($this->customerField && $this->jenisField && $this->tanggal) {
                $this->loadQcData();
                $this->calculateKotor();
            }
        }
    }

    public function updatedCustomerField()
    {
        // Reset dependent fields
        $this->jenisField = '';
        $this->jenis = [];
        $this->qcValue = 0;
        $this->bcValue = 0;
        $this->kotor = null;

        // Load jenis options for selected customer
        if ($this->customerField) {
            $this->jenis = Query::getJenisData($this->customerField);
        }
    }

    public function updatedTanggal()
    {
        // Reload QC data when tanggal changes
        $this->loadQcData();
        if ($this->checked) {
            $this->calculateKotor();
        }
    }

    public function updatedJenisField()
    {
        // Reload QC data when jenis changes
        $this->loadQcData();
        if ($this->checked) {
            $this->calculateKotor();
        }
    }

    public function updatedChecked()
    {
        if($this->checked)
        {
            $this->calculateKotor();
        }
        else
        {
            $this->qty = 0;
        }
    }

    public function loadQcData()
    {
        if ($this->customerField && $this->tanggal && $this->jenisField) {
            $this->qc = DetailKotor::where('customer_code', $this->customerField)
                ->where('tanggal', $this->tanggal)
                ->where('jenis_id', $this->jenisField)
                ->first();

            $this->qcValue = $this->qc->qc ?? 0;
            $this->bcValue = $this->qc->bc ?? 0;
        } else {
            $this->qcValue = 0;
            $this->bcValue = 0;
            $this->qc = null;
        }
    }

    public function calculateKotor()
    {
        $this->qty = 0;

        if ($this->qc) {
            $this->kotor = ($this->qc->qc ?? 0) - ($this->qc->bc ?? 0);
            $this->qty = $this->kotor;
        }
    }

    public function render()
    {
        return view('livewire.packing-kotor-form');
    }
}