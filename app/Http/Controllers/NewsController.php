<?php

namespace App\Http\Controllers;

use App\Models\news;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //dùng increment để tăng view mỗi khi gọi hàm
        news::where('id', $id)->increment('view');

        // lấy tin tức có id bằng id truyền vào
        $news = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title', 'category.id as category_id')
            ->where('news.id', $id)
            ->first();

        // lấy danh mục và đếm số bài viết có trong danh mục
        $category = DB::table('category')
            ->join('news', 'category.id', '=', 'news.id_category')
            ->select('category.*', DB::raw('COUNT(category.id) as tongbaiviet'))
            ->groupBy('category.id')
            ->get();
        // lấy bài viết trước
        $previousNews = DB::table('news')
            ->where('ID', '<', $id)
            ->orderBy('ID', 'desc')
            ->first();
        // lấy bài viết sau
        $nextNews = DB::table('news')
            ->where('ID', '>', $id)
            ->orderBy('ID', 'asc')
            ->first();

        //lấy bài viết trước và sau của bài viết hiện tại
        $newsbetween = collect([$previousNews, $nextNews])->filter();

        //Bài đăng liên quan
        $relatednews = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.id as category_id')
            ->where('category.id', $news->category_id)
            ->get();

        //lấy comment của bài viết
        $totalComments = DB::table('comment')
            ->select(DB::raw('COUNT(tintuc_id) as totalComments'))
            ->groupBy('tintuc_id')
            ->get();


        // Lấy comment của bài viết
        $comments = DB::table('comment')
            ->join('users', 'comment.user_id', '=', 'users.id')
            ->select('comment.*', 'users.name', 'users.image')
            ->where('comment.tintuc_id', $id)
            ->get();

        // Khởi tạo một mảng để lưu trữ các bình luận theo cha-con
        $commentsByParents = [];

        // Lặp qua tất cả các bình luận
        foreach ($comments as $comment) {
            // Kiểm tra nếu bình luận không có cha (parent_id là null)
            if ($comment->parent_id === null) {
                // Thêm thuộc tính 'replies' là một mảng rỗng cho bình luận gốc
                $comment->replies = [];
                // Lưu trữ bình luận vào mảng với id của nó làm key
                $commentsByParents[$comment->id] = $comment;
            } else {
                // Nếu bình luận có parent_id, tức là bình luận trả lời
                // Kiểm tra xem bình luận gốc đã được lưu trữ trong mảng chưa
                if (isset($commentsByParents[$comment->parent_id])) {
                    // Thêm bình luận trả lời vào mảng 'replies' của bình luận gốc
                    $commentsByParents[$comment->parent_id]->replies[] = $comment;
                }
            }
        }

        // Giải thích:
        // 1. Lấy tất cả các bình luận của bài viết có id = $id từ bảng comment và kết hợp với bảng users để lấy thông tin người dùng.
        // 2. Khởi tạo một mảng trống $commentsByParents để lưu trữ bình luận theo cấu trúc cha-con.
        // 3. Lặp qua từng bình luận, kiểm tra nếu bình luận là bình luận gốc (parent_id là null), tạo một mảng replies rỗng và lưu bình luận vào mảng $commentsByParents.
        // 4. Nếu bình luận là bình luận trả lời (parent_id không null), kiểm tra xem bình luận gốc đã tồn tại trong mảng $commentsByParents chưa, nếu có thì thêm bình luận trả lời vào mảng replies của bình luận gốc.

        // return
        return view(
            'client.newsdetail',
            [
                'tintuc' => $news,
                'danhmuc' => $category,
                'tintuctruocsau' => $newsbetween,
                'ID' => $id,
                'tintuclq' => $relatednews,
                'comments' => $commentsByParents,
                'totalComments' => $totalComments,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
