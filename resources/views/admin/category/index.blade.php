@extends('admin.layouts.master')

@section('title')
    Category
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Categories</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('admin.category.create')}}" class="m-0 font-weight-bold text-primary">Add new Category</a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.category.index')}}" method="get">
                            @csrf


                            <div class="row">
                                <div class="col">
                                    <input type="text" name="keyword" class="form-control"
                                           value="{{old('keyword',request()->input('keyword'))}}"
                                           placeholder="enter name" aria-label="Recipient's username"
                                           aria-describedby="button-addon2">
                                </div>


                                <div class="col">
                                    <select class="form-control" name="status">
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option
                                            value="1" {{old('status' , request()->input('status')) == "1" ? 'selected' : ''}}>
                                            Active
                                        </option>
                                        <option
                                            value="0" {{old('status' , request()->input('status')) == "0" ? 'selected' : ''}}>
                                            No Active
                                        </option>
                                    </select>
                                </div>

                                <div class="col">
                                    <select class="form-control" name="paginate">
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option
                                            value="2" {{old('paginate' , request()->input('paginate')) == 2 ? 'selected' : ''}}>
                                            paginate 2
                                        </option>
                                        <option
                                            value="10" {{old('paginate' , request()->input('paginate')) == 10 ? 'selected' : ''}}>
                                            paginate 10
                                        </option>
                                        <option
                                            value="20" {{old('paginate' , request()->input('paginate')) == 20 ? 'selected' : ''}}>
                                            paginate 20
                                        </option>
                                        <option
                                            value="30" {{old('paginate' , request()->input('paginate')) == 30 ? 'selected' : ''}}>
                                            paginate 30
                                        </option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button class="btn btn-outline-success btn-block" type="submit" id="button-addon2">
                                        Search
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>product Count</th>
                        {{--                        <th>parent</th>--}}
                        <th>slug</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->product_count}}</td>
                            {{--                            <td>{{$row->parent  != null ? $row->parent->name : ''}}</td>--}}
                            <td>{{$row->slug}}</td>
                            <td>{{$row->status !=  1  ? 'No Active' : 'Active'}}</td>
                            <td>

                                <div class="row">
                                    <div class="col-2 offset-1">
                                        <a href="{{route('admin.category.edit',$row->id)}}"
                                           class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    </div>

                                    <div class="col-2 offset-1">
                                        <form action="{{route('admin.category.destroy',$row->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="oldfile" value="{{$row->photo->Filename ?? ''}}">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>


                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td>No Data</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                {{ $data->render("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
