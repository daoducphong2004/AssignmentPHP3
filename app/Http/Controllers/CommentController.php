<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
   public function store(Request $request, $tintuc_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        
        Comment::create([
            'tintuc_id' => $tintuc_id,
            'user_id' => Auth::id(), // Sẽ đổi khi làm tài khoản
            'parent_id' => $request->parent_id ?: null, // để parnet_id là null khi $request->parent_id không có 
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
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
    public function destroy(string $id)
    {
        //
    }
}
