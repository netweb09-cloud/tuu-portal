<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\SearchController;
use App\Models\Slider;

/*Route::get('/', function () {
    // 1. Lấy dữ liệu từ Database
    $sliders = Slider::where('is_active', true)->orderBy('order', 'asc')->get();
    $posts = Post::with('category')->where('is_published', true)->latest()->take(4)->get();
    //$documents = Document::latest()->take(6)->get();

    // 2. Truyền sang View (Phải khớp tên biến)
    return view('home', [
        'sliders' => $sliders,   // Tên bên trái là tên biến dùng ngoài Blade ($sliders)
        'posts' => $posts,
        //'documents' => $documents,
    ]);
});

*/

Route::get('/post/{slug}', function ($slug) {
    $post = \App\Models\Post::with(['category.parent'])->where('slug', $slug)->firstOrFail();
    
    // Lấy thêm bài viết liên quan (cùng danh mục) để hiển thị ở Sidebar hoặc phía dưới
    $relatedPosts = \App\Models\Post::where('category_id', $post->category_id)
        ->where('id', '!=', $post->id)
        ->latest()
        ->take(5)
        ->get();

    return view('post-detail', compact('post', 'relatedPosts'));
});

Route::get('/', function () {
    $categoriesWithPosts = \App\Models\Category::whereNull('parent_id')
        ->with(['children' => function ($query) {
            $query->with(['posts' => function ($p) {
                $p->where('is_published', true)->latest()->take(3);
            }])->orderBy('order', 'asc');
        }])
        ->orderBy('order', 'asc')
        ->get();

    $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
    //$documents = \App\Models\Document::latest()->take(6)->get();

    return view('home', compact('categoriesWithPosts', 'sliders'));
});

Route::get('/search', [SearchController::class, 'index']);

Route::get('/page/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
    return view('static-page', compact('page'));
});

Route::get('/category/{slug}', function ($slug) {
    $category = \App\Models\Category::where('slug', $slug)->with('children')->firstOrFail();

    // Nếu là danh mục cha (có danh mục con)
    if ($category->children->count() > 0) {
        $subCategories = \App\Models\Category::where('parent_id', $category->id)
            ->with(['posts' => function ($query) {
                $query->where('is_published', true)->latest()->take(6);
            }])
            ->orderBy('order', 'asc')
            ->get();
            
        return view('category-parent', compact('category', 'subCategories'));
    }

    // Nếu là danh mục con (không có con) -> Hiển thị danh sách bài viết bình thường
    $posts = \App\Models\Post::where('category_id', $category->id)
        ->where('is_published', true)
        ->latest()
        ->paginate(12);

    return view('category-child', compact('category', 'posts'));
});