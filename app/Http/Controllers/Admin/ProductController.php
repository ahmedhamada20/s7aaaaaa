<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    protected $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'product',
        'model' => 'App\Models\Product',
        'route' => 'admins/product',
    ];

    public function index()
    {
        $data = [
            'data' => $this->data['model']::withCount(['categoryTage'])->with(['category'])
                ->when(\request()->keyword != null, function ($query) {
                    $query->search(\request()->keyword);
                })
                ->when(\request()->status != null, function ($query) {
                    $query->whereStatus(\request()->status);
                })
                ->orderBy('id', 'desc')
                ->paginate(\request()->paginate ?? 20),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.index', $data);
    }


    public function create()
    {
        $data = [
            'categories' => Category::whereStatus(1)->whereNotNull('parent_id')->get(['id', 'name']),
            'tags' => Tag::whereStatus(1)->get(['id', 'name']),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create', $data);
    }


    public function store(Request $request)
    {

        $data = $this->data['model']::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'feature' => $request->feature,
            'status' => $request->status,
        ]);

        // Insert Many Photos
        if ($request->hasfile('FilenameMany')) {
            foreach ($request->file('FilenameMany') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('admin/pictures/' . '/' . $this->data['folderBlade'] . '/' . $data->id, $file->getClientOriginalName());

                // Inset Date
                Photo::create([
                    'Filename' => $name,
                    'photoable_id' => $data->id,
                    'photoable_type' => $this->data['model'],
                ]);
            }
        }


        $data->categoryTage()->attach($request->tags);

        return redirect($this->data['route']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = [
            'data' => $this->data['model']::findorfail($id),
            'categories' => Category::whereStatus(1)->whereNotNull('parent_id')->get(['id', 'name']),
            'tags' => Tag::whereStatus(1)->get(),
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'feature' => $request->feature,
            'status' => $request->status,
        ]);

        if (isset($request->tag_id)) {
            $data->categoryTage()->sync($request->tag_id);
        } else {
            $data->categoryTage()->sync(array());
        }

        // Insert Many Photos
        if ($request->hasfile('FilenameMany')) {
            foreach ($request->file('FilenameMany') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('admin/pictures/' . '/' . $this->data['folderBlade'] . '/' . $data->id, $file->getClientOriginalName());

                // Inset Date
                Photo::create([
                    'Filename' => $name,
                    'photoable_id' => $data->id,
                    'photoable_type' => $this->data['model'],
                ]);
            }
        }

        return redirect($this->data['route']);
    }


    public function destroy(Product $product)
    {
        if ($product->photos) {
            foreach ($product->photos as $row) {
                if (File::exists('admin/pictures/product/' . $row->photoable_id . '/' . $row->Filename)) {
                    File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $row->photoable_id . '/' . $row->Filename));
                    Photo::where('photoable_id', $row->photoable_id)->where('photoable_type', $this->data['model'])->delete();
                }
            }
        }

        $this->data['model']::destroy($product->id);
        return redirect($this->data['route']);
    }

    public function product_remove_image(Request $request)
    {
        $photo = Photo::findorfail($request->photo_id);
        if (File::exists('admin/pictures/product/' . $request->data_id . '/' . $photo->Filename)) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->data_id . '/' . $photo->Filename));
            Photo::where('photoable_id', $request->data_id)->where('photoable_type', $this->data['model'])->delete();
        };
        return true;
    }
}

