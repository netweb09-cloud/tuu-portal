@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">Kết quả tìm kiếm cho: <span class="text-primary">"{{ $keyword }}"</span></h2>

    <section class="mb-5">
        <h4 class="border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-text"></i> Văn bản & Quy định ({{ $documents->count() }})</h4>
        @if($documents->isNotEmpty())
            <div class="table-responsive shadow-sm">
                <table class="table table-hover bg-white align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Số hiệu</th>
                            <th>Tên văn bản</th>
                            <th>Tải về</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $doc)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $doc->doc_number }}</span></td>
                            <td class="fw-bold">{{ $doc->title }}</td>
                            <td><a href="{{ asset('storage/'.$doc->file_path) }}" class="btn btn-sm btn-outline-danger">PDF</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted italic">Không tìm thấy văn bản nào.</p>
        @endif
    </section>

    <section>
        <h4 class="border-bottom pb-2 mb-3"><i class="bi bi-newspaper"></i> Tin tức & Bài viết ({{ $posts->count() }})</h4>
        <div class="row g-3">
            @forelse($posts as $post)
            <div class="col-12">
                <div class="card border-0 shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/'.$post->thumbnail) }}" class="rounded me-3" style="width: 100px; height: 70px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-1"><a href="/post/{{ $post->slug }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h6>
                            <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted ms-3">Không tìm thấy bài viết nào.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection