<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\news;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.news.';
    const PATH_UPLOAD = 'news';
    public function index()
    {
        $data = news::query()
            ->join('category', 'news.id_category', '=', 'category.id')
            ->join('users', 'news.id_author', '=', 'users.id')
            ->select('news.*', 'category.title as title_category', 'users.name as name_author')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, ['category' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = category::all();
        $author = User::all();
        return view(self::PATH_VIEW . __FUNCTION__, ['category' => $category, 'author' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $path = Storage::put(self::PATH_UPLOAD, $request->file('img'));
            if ($path) {
                $data['img'] = 'storage/' . $path;
                // Process the content to preserve line breaks and bold text
                $data['content'] = nl2br(e($request->input('content')));
                news::query()->create($data);
                return redirect()->route('admin.news.index')->with('success', 'Image uploaded successfully.');
            } else {
                return redirect()->route('admin.news.index')->with('error', 'Image upload failed.');
            }
        } else {
            return redirect()->route('admin.news.index')->with('error', 'No image file found.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = category::all();
        $author = User::all();
        $news = news::query()
            ->join('category', 'news.id_category', '=', 'category.id')
            ->join('users', 'news.id_author', '=', 'users.id')
            ->select('news.*', 'category.title as title_category', 'users.name as name_author')
            ->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['category' => $category, 'author' => $author, 'news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = category::all();
        $author = User::all();
        $news = news::query()
            ->join('category', 'news.id_category', '=', 'category.id')
            ->join('users', 'news.id_author', '=', 'users.id')
            ->select('news.*', 'category.title as title_category', 'users.name as name_author')
            ->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['category' => $category, 'author' => $author, 'news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = news::findOrFail($id);

        //dữ liệu từ form trừ ảnh.
        $data = $request->except('img');

        //kiểm tra xem có file 'img' không
        if ($request->hasFile('img')) {
            //xóa ảnh cũ
            Storage::delete($news->img);
            //lưu ảnh mới
            $path = Storage::put(self::PATH_UPLOAD, $request->file('img'));
            if ($path) {
                $data['img'] = 'storage/' . $path;
                $data['updated_at'] = now();
                $news->update($data);
                return redirect()->route('admin.news.index')->with('success', 'Image updated successfully.');
            } else {
                return redirect()->route('admin.news.index')->with('error', 'Image upload failed.');
            }
        } else {
            $data['updated_at'] = now();
            $news->update($data);
            return redirect()->route('admin.news.index')->with('success', 'news updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = news::findOrFail($id);

        // Kiểm tra và xóa cover từ storage nếu tồn tại
        if ($news->img && Storage::exists($news->img)) {
            Storage::delete($news->img);
        }
        // Xóa đối tượng news
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Xóa danh mục và cover thành công.');
    }
}
