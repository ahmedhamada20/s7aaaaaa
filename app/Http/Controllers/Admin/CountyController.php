<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'country',
        'model' => 'App\Models\Country',
        'route' => 'admins/country',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::withCount(['states'])->when(\request()->keyword != null, function ($query) {
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
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index');
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
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
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $this->data['model']::findorfail($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect($this->data['route']);
    }


    public function destroy($id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }
}
