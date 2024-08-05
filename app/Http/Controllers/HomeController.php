<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //lấy tất cả các tin tức có join bảng danhmuc để lấy tên danh mục
        $news = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title')
            ->get();
        // lấy tin tức có lượt view cao nhất để làm banner
        $newsTopView = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title')
            ->orderBy('view', 'desc')
            ->first();
        // lấy danh mục
        $category = DB::table('category')->get();
        // lấy tin tức hàng tuần. Carbon để lấy tuần hiện tại theo thời gian thực
        $weekNews = DB::table('news')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->select('news.*', 'category.title as category_title')
            ->whereBetween('news.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        // dd($weekNews);
        return view('client.index', ['tintuc' => $news, 'danhmuc' => $category, 'tintuctop' => $newsTopView, 'tintuchangtuan' => $weekNews,]);
    }
}
