<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{

    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'shippingCompany',
        'model' => 'App\Models\ShippingCompany',
        'route' => 'admins/shippingCompany',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::withCount('shippingCompany')
                ->when(\request()->keyword != null, function ($query) {
                    $query->search(\request()->keyword);
                })
                ->when(\request()->status != null, function ($query) {
                    $query->whereStatus(\request()->status);
                })
                ->paginate(\request()->paginate ?? 10),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index', $data);
    }


    public function create()
    {
        $data = [
            'countries' => Country::whereHas('states')->whereStatus(true)->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create', $data);
    }


    public function store(Request $request)
    {

        $data = $this->data['model']::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'fast' => $request->fast,
            'cost' => $request->cost,
            'status' => $request->status,
        ]);

        $data->shippingCompany()->attach($request->country_id);
        return redirect()->route('admin.category.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = [
            'data' => $this->data['model']::findorfail($id),
            'countries' => Country::whereHas('states')->whereStatus(true)->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'fast' => $request->fast,
            'cost' => $request->cost,
            'status' => $request->status,

        ]);
        if (isset($request->country_id)) {
            $data->shippingCompany()->sync($request->country_id);
        } else {
            $data->shippingCompany()->sync(array());
        }

        return redirect($this->data['route']);
    }


    public function destroy(Request $request, $id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }

}
