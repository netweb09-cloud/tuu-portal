<div class="card h-100 border-0 shadow-sm hover-up overflow-hidden">
    <div class="position-relative overflow-hidden" style="height: 180px;">
        <img src="{{ asset('storage/' . $post->thumbnail) }}" 
             class="card-img-top w-100 h-100" 
             style="object-fit: cover;" 
             alt="{{ $post->title }}">
        @if($post->category)
            <div class="position-absolute top-0 start-0 p-2">
                <span class="badge bg-primary opacity-90 fw-normal">{{ $post->category->name }}</span>
            </div>
        @endif
    </div>

    <div class="card-body p-3">
        <div class="d-flex align-items-center mb-2 text-secondary" style="font-size: 0.75rem;">
            <i class="bi bi-calendar3 me-1"></i> {{ $post->created_at->format('d/m/Y') }}
        </div>
        
        <h6 class="card-title fw-bold mb-3" style="line-height: 1.5; text-transform: none !important;">
            <a href="{{ url('/post/' . $post->slug) }}" class="text-dark text-decoration-none stretched-link">
                {{ Str::limit($post->title, 80, '...') }}
            </a>
        </h6>

        <p class="card-text text-muted mb-0" style="font-size: 0.85rem; line-height: 1.6; text-transform: none !important;">
            {{ Str::words($post->description, 130, '...') }}
        </p>
    </div>
</div>