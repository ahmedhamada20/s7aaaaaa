@extends('admin.layouts.master')

@section('title')
    Add new userAddress
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">userAddress</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Add new userAddress</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.userAddress.store')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>address Title</label>
                        <input type="text" name="address_title" required value="{{old('address_title')}}"
                               class="form-control @error('address_title') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>users</label>
                        <select class="form-control typeahead" name="user_id">
                            {{--                            <option value="" disabled selected>-- choose --</option>--}}
                            @forelse($users as $user)
                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>countries</label>
                        <select class="form-control" name="country_id">
                            <option value="" disabled selected>-- choose --</option>
                            @forelse($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>states</label>
                        <select class="form-control" name="state_id">
                            <option value="" disabled selected>-- choose --</option>
                            @forelse($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div class="col">
                        <label>cities</label>
                        <select class="form-control" name="citi_id">
                            <option value="" disabled selected>-- choose --</option>
                            @forelse($cities as $citiy)
                                <option value="{{$citiy->id}}">{{$citiy->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>default_address</label>
                        <select class="form-control" name="default_address">
                            <option value="1" {{old('default_address') == 1 ? 'selected' : null}}>Active</option>
                            <option value="0" {{old('default_address') == 0 ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>first_name</label>
                        <input type="text" name="first_name" required value="{{old('first_name')}}"
                               class="form-control @error('first_name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>last_name</label>
                        <input type="text" name="last_name" required value="{{old('last_name')}}"
                               class="form-control @error('last_name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>address</label>
                        <input type="text" name="address" required value="{{old('address')}}"
                               class="form-control @error('address') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>address2</label>
                        <input type="text" name="address2" required value="{{old('address2')}}"
                               class="form-control @error('address2') is-invalid @enderror">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col">
                        <label>email</label>
                        <input type="email" name="email" required value="{{old('email')}}"
                               class="form-control @error('email') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>phone</label>
                        <input type="number" name="phone" required value="{{old('phone')}}"
                               class="form-control @error('phone') is-invalid @enderror">
                    </div>


                    <div class="col">
                        <label>zip_code</label>
                        <input type="number" name="zip_code" required value="{{old('zip_code')}}"
                               class="form-control @error('zip_code') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>po_box</label>
                        <input type="number" name="po_box" required value="{{old('po_box')}}"
                               class="form-control @error('po_box') is-invalid @enderror">
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
