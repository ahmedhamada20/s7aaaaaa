<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'category',
        'model' => 'App\Models\Category',
        'route' => 'admin.category',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::withCount('product')->with(['photo'])
                ->when(\request()->keyword != null, function ($query) {
                    $query->search(\request()->keyword);
                })
                ->when(\request()->status != null, function ($query) {
                    $query->whereStatus(\request()->status);
                })
                ->paginate(\request()->paginate ?? 10),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index', $data);
    }


    public function create()
    {
        $data = [
            'categories' => $this->data['model']::whereNull('parent_id')->get(['id', 'name'])
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create', $data);
    }


    public function store(Request $request)
    {

        $data = $this->data['model']::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,

        ]);
        // Inset One Photo

        if ($file = $request->file('cover')) {
            $file_name = $file->getClientOriginalName();
            $file_name_Extension = $request->file('cover')->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $file_name)[0] . '_.' . $file_name_Extension;

            if ($file->move('admin/pictures/' . $this->data['folderBlade'] . '/' . $data->id, $file_to_store)) {
                Photo::create([
                    'Filename' => $file_to_store,
                    'photoable_id' => $data->id,
                    'photoable_type' => $this->data['model'],
                ]);
            }
        }

        return redirect()->route('admin.category.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = [
            'data' => $this->data['model']::findorfail($id),
            'categories' => $this->data['model']::whereNull('parent_id')->get(['id', 'name'])

        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,

        ]);
        // Inset One Photo

        if ($file = $request->file('cover')) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->id . '/' . $request->oldfile));
            $file_name = $file->getClientOriginalName();
            $file_name_Extension = $request->file('cover')->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $file_name)[0] . '_.' . $file_name_Extension;
            if ($file->move('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->id, $file_to_store)) {
                Photo::updateOrCreate([
                    'photoable_id' => $request->id,
                    'photoable_type' => $this->data['model'],
                ], [
                    'Filename' => $file_to_store,
                    'photoable_id' => $data->id,
                    'photoable_type' => $this->data['model'],
                ]);
            }
        }


        return redirect()->route('admin.category.index');
    }


    public function destroy(Request $request, $id)
    {
        $this->data['model']::destroy($id);
        if ($request->oldfile) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $id . '/' . $request->oldfile));
            Photo::where('photoable_id', $request->id)->where('photoable_type', $this->data['model'])->delete();
        }
        return redirect()->route('admin.category.index');
    }

    public function category_remove_image(Request $request)
    {
        $photo = Photo::findorfail($request->photo_id);
        if (File::exists('admin/pictures/category/' . $request->data_id . '/' . $photo->Filename)) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->data_id . '/' . $photo->Filename));
            Photo::where('photoable_id', $request->data_id)->where('photoable_type', $this->data['model'])->delete();
        };
        return true;
    }
}
