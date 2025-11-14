<?php
namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Http\Requests\ReportRequest;
use App\Models\Customer;
use App\Models\Posting;
use App\Models\Ruangan;
use App\Traits\ControllerHelper;
use Carbon\CarbonPeriod;

class ReportInvoiceController extends Controller
{
    use ControllerHelper;

    protected $model;

    public function __construct(Ruangan $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route($this->module('getCreate'));
    }

    public function share($data = [])
    {
        $customer = Query::getCustomerData();

        return array_merge([
            'model'    => false,
            'customer' => $customer,
        ], $data);
    }

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data    = $this->model->leftJoinRelationship('has_customer')
            ->addSelect('customer.customer_nama as customer_nama')
            ->filter(request())
            ->paginate($perPage);
        $data->appends(request()->query());

        return $this->views($this->module(), [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCreate()
    {
        return $this->views($this->module('form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(ReportRequest $request)
    {
        if($request->posting)
        {
            Query::posting($request);
        }

        $data = Posting::query()
                ->addSelect(['*'])
                ->leftJoinRelationship('has_jenis')
                ->where('tanggal', '>=', $request->start)
                ->where('tanggal', '<=', $request->end)
                ->where('type', TransactionType::KOTOR)
                ->where('bersih', '>', 0)
                // ->showSql()
                ->get();

        $customer = Customer::where('customer_code', $request->customer)->with('has_jenis')->first();
        $periode = CarbonPeriod::create($request->start, $request->end);

         return $this->views($this->module('report'), [
            'data' => $data,
            'customer' => $customer,
            'jenis' => $customer->has_jenis ?? false,
            'request' => $request,
            'periode' => $periode,
        ]);
    }
}
