@extends('admin.layouts.master')

@section('title')
    Add new tage
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">tage</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Add new tage</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.tage.store')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" required value="{{old('name')}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col">
                        <label>status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{old('status') == 1 ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status') == 0 ? 'selected' : null}}> No Active</option>
                        </select>
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
        $(function () {
            $("#image_updload").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
