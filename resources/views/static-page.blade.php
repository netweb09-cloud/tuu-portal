@extends('layouts.app')

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active">{{ $page->title }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="fw-bold text-primary mb-4">{{ $page->title }}</h1>
            <hr>
            <div class="content-detail mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection