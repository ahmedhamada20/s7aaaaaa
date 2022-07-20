<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'state',
        'model' => 'App\Models\State',
        'route' => 'admins/state',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::with(['country'])->when(\request()->keyword != null, function ($query) {
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
            'countries' => Country::whereHas('states')->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create', $data);
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'country_id' => $request->country_id,
        ];

        return redirect($this->data['route']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = [
            'data' => $this->data['model']::findorfail($id),
            'countries' => Country::whereHas('states')->get(['id', 'name'])
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $this->data['model']::findorfail($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'country_id' => $request->country_id,
        ]);
        return redirect($this->data['route']);
    }


    public function destroy($id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }
}
