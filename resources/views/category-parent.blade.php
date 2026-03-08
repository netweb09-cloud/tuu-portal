@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-navy text-uppercase">{{ $category->name }}</h1>
        <div class="mx-auto bg-primary" style="height: 4px; width: 80px;"></div>
    </div>

    @foreach($subCategories as $sub)
        @if($sub->posts->count() > 0)
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h3 class="fw-bold text-primary mb-0" style="font-size: 1.4rem;">
                    <i class="bi bi-tag-fill me-2"></i>{{ $sub->name }}
                </h3>
                <a href="{{ url('/category/'.$sub->slug) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                    Xem tất cả <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach($sub->posts as $post)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up">
                        <img src="{{ asset('storage/'.$post->thumbnail) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold">
                                <a href="{{ url('/post/'.$post->slug) }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($post->title, 80) }}
                                </a>
                            </h6>
                            <p class="card-text small text-secondary">
                                <strong class="text-dark">{{ $post->short_description }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    @endforeach
</div>
@endsection