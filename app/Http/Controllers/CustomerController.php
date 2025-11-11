<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use ControllerHelper;

    protected $model;

    public function __construct(Customer $model)
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

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data = $this->model->filter(request())->paginate($perPage);
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
    public function postCreate()
    {
        $validated = request()->validate($this->model->rules());
        $customer = $this->model->create($validated);
        $redirectUrl = route($this->module('getData')) . '?customer=' . $customer->customer_code;
        return redirect($redirectUrl)->with('success', 'Customer created successfully');
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
    public function postUpdate(Request $request)
    {
        $code = $request->input('customer_code');
        $model = $this->model->findOrFail($code);
        return $this->update($request->all(), $model);
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