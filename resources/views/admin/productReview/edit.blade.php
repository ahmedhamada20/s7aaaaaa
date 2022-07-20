@extends('admin.layouts.master')

@section('title')
    Edit Product Review
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> Edit Product Review</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"> Edit Product Review</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.productReview.update','test')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" value="{{$data->id}}" name="id">

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" value="{{$data->name}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>email</label>
                        <input type="email" name="email" value="{{$data->email}}"
                               class="form-control @error('email') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>title</label>
                        <input type="text" name="title" value="{{$data->title}}"
                               class="form-control @error('title') is-invalid @enderror">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>Product</label>
                        <input type="text" readonly class="form-control"  value="{{$data->product->name}}">
                        <input type="hidden" readonly class="form-control" name="product_id" value="{{$data->product_id}}">
                    </div>

                    <div class="col">
                        <label>User</label>
                        <input type="text" readonly class="form-control" value="{{$data->user->full_name}}">
                        <input type="hidden" readonly class="form-control" name="user_id" value="{{$data->user_id}}">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{$data->status == 1 ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->status == 0 ? 'selected' : null}}>No Active</option>
                        </select>
                    </div>


                    <div class="col">
                        <label>Rating</label>
                        <select class="form-control" name="rating">
                            <option value="1"{{$data->rating == 1 ? 'selected' : null}}>1</option>
                            <option value="2"{{$data->rating == 2 ? 'selected' : null}}>2</option>
                            <option value="3"{{$data->rating == 3 ? 'selected' : null}}>3</option>
                            <option value="4"{{$data->rating == 4 ? 'selected' : null}}>4</option>
                            <option value="5"{{$data->rating == 5 ? 'selected' : null}}>5</option>
                        </select>
                    </div>
                </div>


                <br>

                <div class="row">
                    <div class="col">
                        <label>massage</label>
                        <textarea id="summernote" class="form-control" name="massage">
                            {{$data->massage}}
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

@endsection
