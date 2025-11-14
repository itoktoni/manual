<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Http\Requests\PostingRequest;
use App\Models\Posting;
use App\Services\PostingService;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    use ControllerHelper, PostingService;

    protected $model;

    public function __construct(Posting $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route($this->module('getData'));
    }

    public function share($data = [])
    {
        $customer = Query::getCustomerData();
        $type = TransactionType::getOptions();

        return array_merge([
            'model' => false,
            'customer' => $customer,
            'type' => $type,
        ], $data);
    }

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data = $this->model
            ->addSelect(['posting.*','customer_nama', 'jenis_nama'])
            ->leftJoinRelationship('has_customer')
            ->leftJoinRelationship('has_jenis')
            ->filter(request())->paginate($perPage);
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
    public function postCreate(PostingRequest $request)
    {
        $check = $this->save($request->data, $request->customer, $request->start, $request->end, $request->type);
        if($check == true)
        {
            $redirectRoute = $this->module('getData');
            $successMessage = ucfirst($this->getModuleName()) . ' created successfully';
            $this->json($data, $successMessage, 201);
        }

        return redirect()->route($redirectRoute)->with('success', $successMessage);
    }

    /**
     * Display the specified resource.
     */
    public function getShow($code)
    {
        $this->model = $this->getModel($code);
        return $this->views($this->module(), $this->share([
            'model' => $this->model,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getUpdate($code)
    {
        $model = $this->model->findOrFail($code);

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(Request $request, Posting $posting)
    {
        return $this->update($request->all(), $posting);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getDelete($code)
    {
        $this->model = $this->model->findOrFail($code);
        $this->model->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->model::whereIn($this->model->field_key(), $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }
}