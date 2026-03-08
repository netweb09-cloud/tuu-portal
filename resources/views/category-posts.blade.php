@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="border-bottom border-primary border-3 mb-5 pb-3">
        <h1 class="fw-bold text-uppercase" style="color: #003366;">{{ $category->name }}</h1>
        <p class="text-muted">Tổng hợp các bài viết thuộc chuyên mục {{ $category->name }}</p>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 transition-hover">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <a href="/post/{{ $post->slug }}" class="text-dark text-decoration-none">{{ Str::limit($post->title, 70) }}</a>
                        </h5>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar-event"></i> {{ $post->created_at->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <img src="https://via.placeholder.com/150?text=Empty" class="mb-3">
                <p class="text-muted">Hiện chưa có bài viết nào trong chuyên mục này.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection