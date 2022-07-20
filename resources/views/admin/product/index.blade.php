@extends('admin.layouts.master')

@section('title')
    Product
@endsection

@section('css')

@endsection

@section('content')

    <h1>Product</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('admin.product.create')}}" class="m-0 font-weight-bold text-primary">Add new product</a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.product.index')}}" method="get">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="keyword"  placeholder="name Product" value="{{old('keyword',request()->input('keyword'))}}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="status">
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option value="1" {{old('status' , request()->input('status')) == "1" ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{old('status' , request()->input('status')) == "0" ? 'selected' : ''}}>No Active</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="paginate">
                                        <option value="" disabled selected>-- Choose --</option>
                                        <option value="5" {{old('paginate' , request()->input('paginate')) == 5 ? 'selected' : ''}}>paginate 5</option>
                                        <option value="20" {{old('paginate' , request()->input('paginate')) == 20 ? 'selected' : ''}}>paginate 20</option>
                                        <option value="40" {{old('paginate' , request()->input('paginate')) == 40 ? 'selected' : ''}}>paginate 40</option>
                                        <option value="60" {{old('paginate' , request()->input('paginate')) == 60 ? 'selected' : ''}}>paginate 60</option>
                                        <option value="80" {{old('paginate' , request()->input('paginate')) == 80 ? 'selected' : ''}}>paginate 80</option>
                                        <option value="100" {{old('paginate' , request()->input('paginate')) == 500 ? 'selected' : ''}}>paginate 100</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-success btn-block">Search</button>
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
                        <th>Tage Count</th>
                        <th>Category</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->category_tage_count}}</td>
                            <td>{{$row->category->name}}</td>
                            <td>{{number_format($row->price,2)}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>{{$row->status()}}</td>
                            <td>
                                <a href="{{route('admin.product.edit',$row->id)}}" class="btn btn-sm btn-success"><i
                                        class="fa fa-edit"></i></a>
                                <form action="{{route('admin.product.destroy',$row->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="oldfile" value="{{$row->photo->Filename ?? ''}}">
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="8">No Data</td>
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

