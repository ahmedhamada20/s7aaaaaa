<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{

    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'userAddress',
        'model' => 'App\Models\UserAddress',
        'route' => 'admins/userAddress',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::with(['user', 'country', 'state', 'citiy'])
                ->when(\request()->keyword != null, function ($query) {
                    $query->search(\request()->keyword);
                })
                ->when(\request()->status != null, function ($query) {
                    $query->whereDefaultAddress(\request()->status);
                })
                ->paginate(\request()->paginate ?? 10),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index', $data);
    }


    public function create()
    {
        $data = [
            'users' => User::whereStatus(true)->get(['id','first_name','last_name']),
            'countries' => Country::whereStatus(true)->get(['id', 'name']),
            'states' => State::whereStatus(true)->get(['id', 'name']),
            'cities' => City::whereStatus(true)->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create', $data);
    }


    public function store(Request $request)
    {

        $data = $this->data['model']::create([
            'user_id' => $request->user_id,
            'address_title' => $request->address_title,
            'default_address' => $request->default_address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'citi_id' => $request->citi_id,
            'first_name' => $request->first_name,
            'address' => $request->address,
            'address2' => $request->address2,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'po_box' => $request->po_box,
        ]);


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
            'users' => User::whereStatus(true)->get(['id','first_name','last_name']),
            'countries' => Country::whereStatus(true)->get(['id', 'name']),
            'states' => State::whereStatus(true)->get(['id', 'name']),
            'cities' => City::whereStatus(true)->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'user_id' => $request->user_id,
            'address_title' => $request->address_title,
            'default_address' => $request->default_address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'citi_id' => $request->citi_id,
            'first_name' => $request->first_name,
            'address' => $request->address,
            'address2' => $request->address2,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'po_box' => $request->po_box,
        ]);


        return redirect($this->data['route']);
    }


    public function destroy(Request $request, $id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }

}
