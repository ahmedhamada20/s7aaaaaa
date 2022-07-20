@extends('admin.layouts.master')

@section('title')
    Edit Product Coupon
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Product Coupon</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"> Edit Product Coupon</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.productCoupon.update','test')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" value="{{$data->id}}" name="id">

                <div class="row">
                    <div class="col">
                        <label>code</label>
                        <input type="text" name="code" value="{{$data->code}}"
                               class="form-control @error('code') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>type</label>
                        <input type="text" name="type" value="{{$data->type}}"
                               class="form-control @error('type') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>Start Data</label>
                        <input type="text" id="start_data" name="start_data" class="form-control" value="{{$data->start_data->format('Y-m-d')}}">
                    </div>

                    <div class="col">
                        <label>End Data</label>
                        <input type="text" id="end_data" name="end_data" class="form-control" value="{{$data->end_data->format('Y-m-d')}}">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>use coupon</label>
                        <input type="number" class="form-control" name="use_coupon" value="{{$data->use_coupon}}">
                    </div>

                    <div class="col">
                        <label>value</label>
                        <input type="number" class="form-control" name="value" value="{{$data->value}}">
                    </div>


                    <div class="col">
                        <label>couponsUsed</label>
                        <input type="number" class="form-control" name="couponsUsed" value="{{$data->couponsUsed}}">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>description</label>
                        <textarea id="summernote" class="form-control" name="description">
                            {{$data->description}}
                        </textarea>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('admin/data/picker.js')}}"></script>
    <script src="{{asset('admin/data/picker.date.js')}}"></script>

    <script>
        // The date picker (read the docs)
        $('#start_data').pickadate();
        $('#end_data').pickadate();
    </script>
@endsection
