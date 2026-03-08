@extends('layouts.app')

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-3 bg-light rounded shadow-sm">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
            
            {{-- Nếu có danh mục cha --}}
            @if($post->category->parent)
                <li class="breadcrumb-item">
                    <a href="{{ url('/category/' . $post->category->parent->slug) }}" class="text-decoration-none">
                        {{ $post->category->parent->name }}
                    </a>
                </li>
            @endif
            
            {{-- Danh mục hiện tại --}}
            <li class="breadcrumb-item">
                <a href="{{ url('/category/' . $post->category->slug) }}" class="text-decoration-none">
                    {{ $post->category->name }}
                </a>
            </li>
            
            <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $post->title }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-8">
            <article>
                <h1 class="fw-bold mb-3 text-navy" style="text-transform: none; line-height: 1.3;">
                    {{ $post->title }}
                </h1>
                
                <div class="d-flex align-items-center text-muted small mb-4 border-bottom pb-3">
                    <span class="me-3"><i class="bi bi-calendar3 me-1"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                    <span class="me-3"><i class="bi bi-folder2-open me-1"></i> {{ $post->category->name }}</span>
                    <span><i class="bi bi-eye me-1"></i> Lượt xem: 1,234</span>
                </div>

                <div class="post-sapo mb-4 p-4 bg-light border-start border-4 border-primary shadow-sm rounded-end">
                    <p class="mb-0 fw-bold" style="font-size: 1.15rem; line-height: 1.7; color: #2c3e50;">
                        {{ $post->description }}
                    </p>
                </div>

                <div class="post-content mb-5" style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                    {!! $post->content !!}
                </div>

                <div class="share-box p-3 border-top border-bottom d-flex align-items-center mb-5">
                    <span class="fw-bold me-3">CHIA SẺ:</span>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-info btn-sm rounded-circle me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="btn btn-outline-danger btn-sm rounded-circle"><i class="bi bi-envelope"></i></a>
                </div>
            </article>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-block mb-5">
                <h5 class="fw-bold text-uppercase border-start border-4 border-primary ps-2 mb-4">Bài viết liên quan</h5>
                <div class="list-group list-group-flush shadow-sm rounded border">
                    @foreach($relatedPosts as $rPost)
                    <a href="{{ url('/post/'.$rPost->slug) }}" class="list-group-item list-group-item-action py-3">
                        <div class="row g-2">
                            <div class="col-4">
                                <img src="{{ asset('storage/'.$rPost->thumbnail) }}" class="img-fluid rounded" style="height: 60px; object-fit: cover; width: 100%;">
                            </div>
                            <div class="col-8">
                                <h6 class="mb-1 fw-bold small" style="line-height: 1.4;">{{ Str::limit($rPost->title, 50) }}</h6>
                                <small class="text-muted" style="font-size: 0.7rem;">{{ $rPost->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-banner rounded overflow-hidden shadow-sm mb-4">
                <img src="https://via.placeholder.com/400x250" class="img-fluid w-100" alt="Banner">
            </div>
        </div>
    </div>
</div>
@endsection