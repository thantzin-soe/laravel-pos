<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Image;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::latest()->paginate(10);
        return view('backend.admin.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.admin.create', compact('roles'));
    }

    public function store(AdminStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'profile_images/'.$filename;

            $image = Image::make($file)->resize(250, 250)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $data['photo'] = $result->getPublicId();
            $data['photo_url'] = $result->getSecurePath();
        }

        $user = User::create($data);

        $user->assignRole($request->role_id);

        $notification = [
            'message' => 'Admin user created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admins.index')->with($notification);
    }


    public function edit(User $admin)
    {
        $roles = Role::all();
        return view('backend.admin.edit', compact('admin', 'roles'));
    }

    public function update(User $admin, AdminUpdateRequest $request)
    {
        $data = $request->safe()->except(['image']);

        $admin->update($data);

        $admin->roles()->detach();
        $admin->assignRole($request->role_id);

        $notification = [
            'message' => 'Admin user updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admins.index')->with($notification);
    }


    public function destroy(User $admin)
    {
        if ($admin->photo) {
            Storage::disk('cloudinary')->delete($admin->photo);
        }

        $admin->delete();

        $notification = [
            'message' => 'Admin user deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admins.index')->with($notification);
    }
}
