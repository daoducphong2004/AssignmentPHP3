<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\news;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.account.';
    const PATH_UPLOAD = 'account';
    public function index()
    {
        $users = User::all();
        return view(self::PATH_VIEW . __FUNCTION__, ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($path) {
                $data['image'] = 'storage/' . $path;
                $data['password'] = Hash::make($request->password);
                User::query()->create($data);
                return redirect()->route('admin.account.index')->with('success', 'Image uploaded successfully.');
            } else {
                return redirect()->route('admin.account.index')->with('error', 'Image upload failed.');
            }
        } else {
            return redirect()->route('admin.account.index')->with('error', 'No image file found.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $news = news::query()
        ->where('id_author', $id)
        ->get();
        return view(self::PATH_VIEW . __FUNCTION__, ['user'=>$user,'news'=>$news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)

    {
        $user = User::findOrFail($id);

        //dữ liệu từ form trừ ảnh.
        $data = $request->except('image');

        //kiểm tra xem có file 'image' không
        if ($request->hasFile('image')) {
            //xóa ảnh cũ
            Storage::delete($user->image);
            //lưu ảnh mới
            $path = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($path) {
                $data['image'] = 'storage/' . $path;
                $data['updated_at'] = now();
                $user->update($data);
                return redirect()->route('admin.account.index')->with('success', 'Image updated successfully.');
            } else {
                return redirect()->route('admin.account.index')->with('error', 'Image upload failed.');
            }
        } else {
            $data['updated_at'] = now();
            $user->update($data);
            return redirect()->route('admin.account.index')->with('success', 'Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Kiểm tra và xóa cover từ storage nếu tồn tại
        if ($user->image && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }
        // Xóa đối tượng user
        $user->delete();

        return redirect()->route('admin.account.index')->with('success', 'Xóa danh mục và cover thành công.');
    }
}
