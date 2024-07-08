<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.category.';
    const PATH_UPLOAD = 'category';
    public function index()
    {
        $data = category::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, ['category' => $data]);
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
                Category::query()->create($data);
                return redirect()->route('admin.category.index')->with('success', 'Image uploaded successfully.');
            } else {
                return redirect()->route('admin.category.index')->with('error', 'Image upload failed.');
            }
        } else {
            return redirect()->route('admin.category.index')->with('error', 'No image file found.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = category::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = category::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = category::findOrFail($id);

        //dữ liệu từ form trừ ảnh.
        $data = $request->except('image');

        //kiểm tra xem có file 'image' không
        if ($request->hasFile('image')) {
            //xóa ảnh cũ
            Storage::delete($category->image);
            //lưu ảnh mới
            $path = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($path) {
                $data['image'] = 'storage/' . $path;
                $data['updated_at'] = now();
                $category->update($data);
                return redirect()->route('admin.category.index')->with('success', 'Image updated successfully.');
            } else {
                return redirect()->route('admin.category.index')->with('error', 'Image upload failed.');
            }
        } else {
            $data['updated_at'] = now();
            $category->update($data);
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra và xóa cover từ storage nếu tồn tại
        if ($category->image && Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        // Xóa đối tượng category
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục và cover thành công.');
    }
}
