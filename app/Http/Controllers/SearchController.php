<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class SearchController extends Controller
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
        //
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
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ input
        $keyword = $request->input('keyword');

        // Tìm kiếm trong bảng TinTuc
        $results = news::where('title', 'like', "%$keyword%")
                        ->orWhere('content', 'like', "%$keyword%")
                        ->get();

        // Trả về view hiển thị kết quả tìm kiếm
        return view('client.search', compact('results', 'keyword'));
    }
}
