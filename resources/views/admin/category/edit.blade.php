@extends('admin.layouts.master')

@section('title')
    Edit Category
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Categories</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit Category</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.category.update','test')}}" method="post" autocomplete="off"
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
                        <label>categories</label>
                        <select class="form-control" name="parent_id">
                            <option value="" disabled selected>-- choose --</option>
                            @forelse($categories as $category)
                                <option
                                    value="{{$category->id}}" {{$category->id == $data->parent_id ? 'selected' : ''}}>{{$category->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


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
                        <label>Cover</label>
                        <input type="file" name="cover" id="image_updload" multiple accept="image/*"
                               class="file-input-overview">
                        <input type="hidden" name="oldfile" value="{{$data->photo->Filename ?? ''}}">
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
        $(function () {
            $("#image_updload").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($data->photo)
                        "{{asset('admin/pictures/category/' . $data->id . '/'  . $data->photo->Filename)}}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',

                @if($data->photo)
                initialPreviewConfig: [
                    {
                        caption: "{{$data->photo->Filename}}",
                        size: '111',
                        width: "120px",
                        url: "{{route('admin.category_remove_image',['data_id' => $data->id,'photo_id' => $data->photo->id ,'photo_name' => $data->photo->Filename, '_token' => csrf_token()])}}",
                        key: {{$data->photo->id}}
                    }
                ]
                @endif

            });
        });
    </script>
@endsection
