<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\news;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->middleware('auth');

    }
    const PATH_VIEW = 'admin.comment.';
    const PATH_UPLOAD = 'comment';
    public function index()
    {
            $comment = Comment::query()
            ->join('news', 'comment.tintuc_id', '=', 'news.id')
            ->join('users', 'comment.user_id', '=', 'users.id')
            ->select('comment.tintuc_id', 'news.title', 'news.img', DB::raw('COUNT(comment.id) as total_comments'))
            ->groupBy('comment.tintuc_id', 'news.title', 'news.img')
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, ['comment' => $comment]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = news::all();
        $user = User::all();
        return view(self::PATH_VIEW . __FUNCTION__, ['news' => $news,'user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'tintuc_id' => $request->tintuc_id,
            'user_id' => $request->user_id, // Sẽ đổi khi làm tài khoản
            'parent_id' => $request->parent_id ?: null, // để parnet_id là null khi $request->parent_id không có
            'content' => $request->content,
        ]);
            return redirect()->route('admin.comment.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = news::query()->findOrFail($id);
        $comment = Comment::query()
        ->join('users', 'comment.user_id', '=', 'users.id')
        ->select('comment.*', 'users.name','users.email')
        ->where('comment.tintuc_id', $id)
        ->get();
        return view(self::PATH_VIEW . __FUNCTION__, ['news' => $news, 'comments'=>$comment,'news_id'=>$id]);
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
        $comment = comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }
}
