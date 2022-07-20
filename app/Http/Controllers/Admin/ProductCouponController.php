<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCouponController extends Controller
{
    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'productCoupon',
        'model' => 'App\Models\ProductCoupon',
        'route' => 'admins/productCoupon',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::when(\request()->code != null, function ($query) {
                $query->search(\request()->code);
            })
                ->when(\request()->status != null, function ($query) {
                    $query->whereStatus(\request()->status);
                })
                ->when(\request()->start_data != null, function ($query) {
                    $query->whereStartDate(\request()->start_data);
                })
                ->when(\request()->end_data != null, function ($query) {
                    $query->search(\request()->end_data);
                })
                ->paginate(\request()->paginate ?? 10),
        ];

        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index', $data);
    }

    public function create()
    {
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create');
    }

    public function store(Request $request)
    {

        $this->data['model']::create([
            'code' => $request->code,
            'type' => $request->type,
            'start_data' => $request->start_data,
            'end_data' => $request->end_data,
            'description' => $request->description,
            'use_coupon' => $request->use_coupon,
            'value' => $request->value,
            'couponsUsed' => $request->couponsUsed,
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
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->data['model']::findorfail($request->id)->update([
            'code' => $request->code,
            'type' => $request->type,
            'start_data' => $request->start_data,
            'end_data' => $request->end_data,
            'description' => $request->description,
            'use_coupon' => $request->use_coupon,
            'value' => $request->value,
            'couponsUsed' => $request->couponsUsed,
        ]);
        return redirect($this->data['route']);
    }

    public function destroy(Request $request, $id)
    {
        $this->data['model']::destroy($id);
        return redirect($this->data['route']);
    }
}
