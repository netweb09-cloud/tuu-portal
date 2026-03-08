<?php

namespace App\Http\Controllers;

use App\Models\Post;
//use App\Models\Document;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        // Tìm kiếm trong bài viết (Tìm theo tiêu đề hoặc nội dung)
        $posts = Post::where('is_published', true)
            ->where(function($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                      ->orWhere('content', 'LIKE', "%{$keyword}%");
            })->latest()->get();

        // Tìm kiếm trong văn bản (Tìm theo tiêu đề hoặc số hiệu)
       // $documents = Document::where('title', 'LIKE', "%{$keyword}%")
        //    ->orWhere('doc_number', 'LIKE', "%{$keyword}%")
        //    ->latest()->get();

       // return view('search-results', compact('posts', 'documents', 'keyword'));
    }
}