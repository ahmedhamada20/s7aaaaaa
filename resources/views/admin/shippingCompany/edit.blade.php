@extends('admin.layouts.master')

@section('title')
    updated shippingCompany
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">shippingCompany</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">updatedshippingCompany</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.shippingCompany.update','test')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{$data->id}}">

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" required value="{{$data->name}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>code</label>
                        <input type="text" name="code" required value="{{$data->code}}"
                               class="form-control @error('code') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>countries</label>
                        <select class="form-control" multiple name="country_id[]">
                            @forelse($countries as $country)
                                <option value="{{$country->id}}"
                                @forelse($data->shippingCompany as $row)
                                    {{$row->id == $country->id ? 'selected' : ''}}
                                    @empty
                                    @endforelse>
                                    {{$country->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>states</label>
                        <select class="form-control" name="status">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{$data->status == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->status == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>


                    <div class="col">
                        <label>fast</label>
                        <select class="form-control" name="fast">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{$data->status == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->status == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>


                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>cost</label>
                        <input type="text" name="cost" required value="{{$data->cost}}"
                               class="form-control @error('cost') is-invalid @enderror">
                    </div>

                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>description</label>
                        <textarea class="form-control" required name="description" id="summernote">
                            {!! $data->description !!}
                        </textarea>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-success">Updated</button>
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
