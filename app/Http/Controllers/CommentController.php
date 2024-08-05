<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);
        if ($request->input('content') != '<p><br></p>') {
            Comment::create([
                'tintuc_id' => $request->input('tintuc_id'),
                'user_id' => Auth::id(),
                'parent_id' => $request->input('parent_id') ?: null,
                'content' => $request->input('content'),
            ]);
            return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
        }
        return redirect()->back()->with('error', 'Bình luận của bạn không được để trống');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Request $request)
    {
        try {
            $comment = Comment::findOrFail($request->commentId);
            $comment->delete();
            return response()->json(['success' => true, 'message' => 'Xóa bình luận thành công']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Xóa bình luận không thành công']);
        }
    }
}
