<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{
    protected $data = [
        'folderMain' => 'admin.',
        'folderBlade' => 'supervisor',
        'model' => 'App\Models\User',
        'route' => 'admins/supervisor',
    ];


    public function index()
    {
        $data = [
            'data' => $this->data['model']::with(['photo'])->whereType('supervisor')
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
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.create');
    }


    public function store(Request $request)
    {
        $data = $this->data['model']::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'type' => "supervisor",
        ]);

        // Inset One Photo

        if ($file = $request->file('photo')) {
            $file_name = $file->getClientOriginalName();
            $file_name_Extension = $request->file('photo')->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $file_name)[0] . '_.' . $file_name_Extension;

            if ($file->move('admin/pictures/' . $this->data['folderBlade'] . '/' . $data->id, $file_to_store)) {
                Photo::create([
                    'Filename' => $file_to_store,
                    'photoable_id' => $data->id,
                    'photoable_type' => $this->data['model'],
                ]);
            }
        }

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
        ];
        return view($this->data['folderMain'] . $this->data['folderBlade'] . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->data['model']::findorfail($request->id);
        $data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'type' => "supervisor",

        ]);
        // Inset One Photo

        if ($file = $request->file('photo')) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->id . '/' . $request->oldfile));
            $file_name = $file->getClientOriginalName();
            $file_name_Extension = $request->file('photo')->getClientOriginalExtension();
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
        return redirect($this->data['route']);

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

    public function supervisor_remove_image(Request $request)
    {
        $photo = Photo::findorfail($request->photo_id);
        if (File::exists('admin/pictures/supervisor/' . $request->data_id . '/' . $photo->Filename)) {
            File::delete(public_path('admin/pictures/' . $this->data['folderBlade'] . '/' . $request->data_id . '/' . $photo->Filename));
            Photo::where('photoable_id', $request->data_id)->where('photoable_type', $this->data['model'])->delete();
        };
        return true;
    }
}
