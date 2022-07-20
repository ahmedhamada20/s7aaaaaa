@extends('admin.layouts.master')

@section('title')
    product Review
@endsection

@section('css')
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> product Review</h1>
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.productReview.index') }}" method="get">
                            @csrf


                            <div class="row">
                                <div class="col">
                                    <input type="text" name="keyword" class="form-control"
                                           value="{{ old('keyword', request()->input('keyword')) }}"
                                           placeholder="enter name"
                                           aria-label="Recipient's username" aria-describedby="button-addon2">
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
                                            value="2" {{ old('paginate', request()->input('paginate')) == 2 ? 'selected'    : '' }}>
                                            paginate 2
                                        </option>
                                        <option
                                            value="10" {{ old('paginate', request()->input('paginate')) == 10 ? 'selected' : '' }}>
                                            paginate 10
                                        </option>
                                        <option value="20" {{ old('paginate', request()->input('paginate')) == 20 ?
                                        'selected' : '' }}>
                                            paginate 20
                                        </option>
                                        <option value="30" {{ old('paginate', request()->input('paginate')) == 30 ?
                                        'selected' : '' }}>
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
                        <th>user</th>
                        <th>product</th>
                        <th>name</th>
                        <th>email</th>
                        <th>title</th>
                        <th>status</th>
                        <th>rating</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->user->full_name }}</td>
                            <td>{{ $row->product->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->status() }}</td>
                            <td>{{ $row->rating }}</td>
                            <td>

                                <div class="row">
                                    <div class="col-2 offset-1">
                                        <a href="{{ route('admin.productReview.edit', $row->id) }}"
                                           class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    </div>

                                    <div class="col-2 offset-1">
                                        <form action="{{ route('admin.productReview.destroy', $row->id) }}"
                                              method="post">
                                            @method('DELETE')
                                            @csrf
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
                {!! $data->appends(Request::all())->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
