@extends('admin.layouts.master')

@section('title')
    Add new Product Coupon
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Add new Product Coupon</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"> Add new Product Coupon</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.productCoupon.store')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>code</label>
                        <input type="text" name="code" required value="{{old('code')}}"
                               class="form-control @error('code') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>type</label>
                        <input type="text" name="type" required value="{{old('type')}}"
                               class="form-control @error('type') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>Start Data</label>
                        <input type="text" name="start_data" id="start_data" class="form-control" required>
                    </div>

                    <div class="col">
                        <label>End Data</label>
                        <input type="text" name="end_data" id="end_data" class="form-control" required>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>use coupon</label>
                        <input type="number" class="form-control" name="use_coupon" required>
                    </div>

                    <div class="col">
                        <label>value</label>
                        <input type="number" class="form-control" name="value" required>
                    </div>


                    <div class="col">
                        <label>couponsUsed</label>
                        <input type="number" class="form-control" name="couponsUsed" required>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>description</label>
                        <textarea id="summernote" class="form-control" name="description"></textarea>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-success">Add new</button>
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
