@extends('admin.layouts.master')

@section('title')
    Add new Customer
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Add new Customer</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Add new Customer</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.customer.store')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>First Name</label>
                        <input type="text" name="first_name" required value="{{old('first_name')}}"
                               class="form-control @error('first_name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>Last Name</label>
                        <input type="text" name="last_name" required value="{{old('first_name')}}"
                               class="form-control @error('first_name') is-invalid @enderror">
                    </div>


                    <div class="col">
                        <label>User Name</label>
                        <input type="text" name="username" required value="{{old('username')}}"
                               class="form-control @error('username') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>Password</label>
                        <input type="password" name="password" required value="{{old('password')}}"
                               class="form-control @error('password') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col">
                        <label>phone</label>
                        <input type="number" name="phone" class="form-control" required>
                    </div>

                    <div class="col">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="" disabled selected>-- Choose --</option>
                            <option value="1" {{old('status') == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('status') == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>Cover</label>
                        <input type="file" name="photo" id="image_updload" multiple accept="image/*"
                               class="file-input-overview">
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
