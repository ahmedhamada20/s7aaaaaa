@extends('admin.layouts.master')

@section('title')
    Edit state
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">state</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit state</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.state.update','test')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" value="{{$data->id}}" name="id">

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" required value="{{$data->name}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col">
                        <label>states</label>
                        <select class="form-control" name="state_id" required>
                            <option value="" disabled selected>-- Choose --</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{$state->id == $data->state_id ? 'selected' : ''}}>{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col">
                        <label>status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{$data->status == 1 ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->status == 0 ? 'selected' : null}}> No Active</option>
                        </select>
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

@endsection
