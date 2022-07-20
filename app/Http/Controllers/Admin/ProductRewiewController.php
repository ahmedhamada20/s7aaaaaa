<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductRewiewController extends Controller
{
    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'productReview',
        'model' => 'App\Models\ProductReview',
        'route' => 'admins/productReview',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::with(['product', 'user'])
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
        //
    }


    public function store(Request $request)
    {
        //
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
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'user_id' => $request->user_id ?? $data->user_id,
            'product_id' => $request->product_id ?? $data->product_id,
            'name' => $request->name ?? $data->name,
            'email' => $request->email ?? $data->email,
            'title' => $request->title ?? $data->title,
            'massage' => $request->massage ?? $data->massage,
            'status' => $request->status ?? $data->status,
            'rating' => $request->rating ?? $data->rating,
        ]);
        return redirect($this->data['route']);
    }


    public function destroy($id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }
}
