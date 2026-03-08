@extends('layouts.app')

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb p-2 bg-light rounded">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            @if($category->parent)
                <li class="breadcrumb-item"><a href="{{ url('/category/'.$category->parent->slug) }}">{{ $category->parent->name }}</a></li>
            @endif
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <h2 class="fw-bold border-start border-4 border-primary ps-3 mb-4 text-navy">{{ $category->name }}</h2>

    <div class="row g-4">
        @foreach($posts as $post)
            <div class="col-md-4">
                @include('partials.post-card', ['post' => $post])
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
</div>
@endsection