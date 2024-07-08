<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = DB::table('category')->get();
        $news = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title', 'category.id as id_dm')
            ->get();
        return view('client.category', ['category' => $category, 'news' => $news]);
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
        $category = DB::table('category')->get();
        $news = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title')
            ->where('category.id', $id)
            ->get();
        return view('client.category', ['news' => $news, 'category' => $category]);
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
