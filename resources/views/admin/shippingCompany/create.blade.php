@extends('admin.layouts.master')

@section('title')
    Add new shippingCompany
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">shippingCompany</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Add new shippingCompany</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.shippingCompany.store')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" required value="{{old('name')}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>code</label>
                        <input type="text" name="code" required value="{{old('code')}}"
                               class="form-control @error('code') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>countries</label>
                        <select class="form-control js-example-basic-multiple" multiple name="country_id[]">
                            <option value="" disabled selected>-- choose --</option>
                            @forelse($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>states</label>
                        <select class="form-control" name="status">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{old('status') == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status') == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>


                    <div class="col">
                        <label>fast</label>
                        <select class="form-control" name="fast">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{old('status') == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status') == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>


                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>cost</label>
                        <input type="text" name="cost" required value="{{old('cost')}}"
                               class="form-control @error('cost') is-invalid @enderror">
                    </div>

                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>description</label>
                        <textarea class="form-control" required name="description" id="summernote"></textarea>
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


    <script>
        $('.typeahead').typeahead();
    </script>
@endsection
