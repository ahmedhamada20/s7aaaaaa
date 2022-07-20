@extends('admin.layouts.master')

@section('title')
    Edit Product
@endsection

@section('css')

@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> Products</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"> Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.product.update','test')}}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="id" value="{{$data->id}}">

                <div class="row">
                    <div class="col">
                        <label>name</label>
                        <input type="text" name="name" value="{{$data->name}}"
                               class="form-control @error('name') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label>price</label>
                        <input type="number" name="price" value="{{$data->price}}" class="form-control">
                    </div>

                    <div class="col">
                        <label>quantity</label>
                        <input type="number" name="quantity" value="{{$data->quantity}}" class="form-control">
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>categories</label>
                        <select class="form-control" name="category_id">
                            @forelse($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $data->category_id ? 'selected' : null}}>{{$category->name}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="col">
                        <label>status</label>
                        <select class="form-control" name="status">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{$data->status == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->status == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>feature</label>
                        <select class="form-control" name="feature">
                            <option value="" disabled selected>-- choose --</option>
                            <option value="1" {{$data->feature == "1" ? 'selected' : null}}>Active</option>
                            <option value="0" {{$data->feature == "0" ? 'selected' : null}}> No Active</option>
                        </select>
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col">
                        <label>description</label>
                        <textarea class="form-control" id="summernote" name="description" rows="10">
                            {{$data->description}}
                        </textarea>
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col">
                        <label>tags</label>
                        <select class="js-example-basic-multiple form-control" name="tag_id[]" multiple>
                            @forelse($tags as $tag)
                                <option value="{{$tag->id}}"
                                @forelse($data->categoryTage as $row)
                                    {{$row->id == $tag->id ? 'selected' :''}}
                                    @empty
                                    @endforelse>
                                    {{$tag->name}}
                                </option>
                            @empty
                                <option value="" disabled selected>-- NO DATA IN Tage --</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col">
                        <label>Cover</label>
                        <input type="file" name="FilenameMany[]" id="image_updload" multiple accept="image/*"
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
                maxFileCount: 10,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($data->photos)
                        @foreach($data->photos as $row)
                        "{{asset('admin/pictures/product/' . $data->id . '/'  . $row->Filename)}}",
                    @endforeach

                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',

                initialPreviewConfig: [
                    @if($data->photos)
                        @foreach($data->photos as $row)
                    {
                        caption: "{{$row->Filename}}",
                        size: '111',
                        width: "120px",
                        url: "{{route('admin.product_remove_image',['data_id' => $data->id,'photo_id' => $row->id ,'photo_name' => $row->Filename, '_token' => csrf_token()])}}",
                        key: {{$row->id}}
                    },
                    @endforeach
                    @endif
                ]
            });
        });
    </script>
@endsection
