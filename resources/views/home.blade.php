@extends('layouts.app')

@section('content')
<div id="mainCarousel" class="carousel slide carousel-fade shadow-sm" data-bs-ride="carousel" data-bs-interval="5000">
    
    <div class="carousel-indicators">
        @foreach($sliders as $index => $slide)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}" 
                class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}">
            </button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($sliders as $index => $slide)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            @if($slide->show_title || $slide->link)
                <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.3); z-index: 1;"></div>
            @endif
            
            <img src="{{ asset('storage/' . $slide->image_path) }}" class="d-block w-100" style="height: 600px; object-fit: cover;">
            
            <div class="carousel-caption d-none d-md-block text-start" style="bottom: 25%; left: 10%; z-index: 2;">
                @if($slide->show_title && $slide->title)
                    <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">
                        {{ $slide->title }}
                    </h1>
                @endif

                @if($slide->link)
                    <a href="{{ $slide->link }}" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm animate__animated animate__fadeInUp">
                        XEM CHI TIẾT <i class="bi bi-arrow-right-circle ms-2"></i>
                    </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev" style="z-index: 3;">
        <span class="carousel-control-prev-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next" style="z-index: 3;">
        <span class="carousel-control-next-icon p-3 rounded-circle bg-dark bg-opacity-25" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-9">
            @foreach($categoriesWithPosts as $parent)
                @if($parent->children->pluck('posts')->flatten()->count() > 0)
                    <div class="parent-section mb-5">
                        <h2 class="fw-bold text-navy border-bottom border-3 border-primary pb-2 mb-4 text-uppercase">
                            {{ $parent->name }}
                        </h2>

                        @foreach($parent->children as $child)
                            @if($child->posts->count() > 0)
                                <div class="sub-category-block mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="fw-bold mb-0 text-primary" style="font-size: 1.1rem;">
                                            {{ $child->name }}
                                        </h4>
                                        <a href="{{ url('/category/'.$child->slug) }}" class="small text-decoration-none fw-bold text-muted">Xem thêm</a>
                                    </div>

                                    <div class="row g-3">
                                        @foreach($child->posts as $post)
                                            <div class="col-md-4"> {{-- Đổi thành col-md-4 để hiện 3 bài/dòng trong cột 8 --}}
                                                @include('partials.post-card', ['post' => $post])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
        <!--Sidebar-->

        <div class="col-lg-3 d-none d-lg-block">
            <aside class="sticky-top" style="top: 100px; z-index: 10;">
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom border-primary border-2">
                        <h5 class="fw-bold text-navy mb-0 py-1">
                            <i class="bi bi-link-45deg me-2"></i>LIÊN KẾT WEBSITE
                        </h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="https://moet.gov.vn" target="_blank" class="list-group-item list-group-item-action py-3 sidebar-link-item d-flex align-items-center">
                            <i class="bi bi-globe2 me-3 text-primary"></i> Bộ Giáo dục và Đào tạo
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 sidebar-link-item d-flex align-items-center">
                            <i class="bi bi-mortarboard me-3 text-primary"></i> Cổng thông tin sinh viên
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 sidebar-link-item d-flex align-items-center">
                            <i class="bi bi-book me-3 text-primary"></i> Thư viện điện tử TUU
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 sidebar-link-item d-flex align-items-center">
                            <i class="bi bi-person-badge me-3 text-primary"></i> Hệ thống E-Learning
                        </a>
                        <a href="http://congdoanvn.org.vn/" target="_blank" class="list-group-item list-group-item-action py-3 sidebar-link-item d-flex align-items-center">
                            <i class="bi bi-flag me-3 text-primary"></i> Tổng Liên đoàn Lao động VN
                        </a>
                    </div>
                </div>

                <div class="p-4 bg-primary text-white rounded shadow-sm text-center">
                    <h6 class="small opacity-75">HOTLINE HỖ TRỢ</h6>
                    <div class="fs-4 fw-bold">(024) 3857 3204</div>
                </div>

            </aside>
        </div>

         <!--Sidebar-->
    </div>
</div>


       <!------------------------------------>
        <section class="quick-links my-5">
            <div class="container">
                <div class="row g-3 text-center">
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none d-block p-4 shadow-sm rounded bg-white border-bottom border-primary border-4 transition-hover">
                            <div class="icon-box mb-2">
                                <i class="bi bi-pencil-square fs-1 text-primary"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Đăng ký học</h6>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none d-block p-4 shadow-sm rounded bg-white border-bottom border-success border-4 transition-hover">
                            <div class="icon-box mb-2">
                                <i class="bi bi-mortarboard fs-1 text-success"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Quản lý điểm</h6>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none d-block p-4 shadow-sm rounded bg-white border-bottom border-warning border-4 transition-hover">
                            <div class="icon-box mb-2">
                                <i class="bi bi-laptop fs-1 text-warning"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Học trực tuyến</h6>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#" class="text-decoration-none d-block p-4 shadow-sm rounded bg-white border-bottom border-danger border-4 transition-hover">
                            <div class="icon-box mb-2">
                                <i class="bi bi-wallet2 fs-1 text-danger"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Học phí</h6>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .transition-hover:hover {
                transform: translateY(-5px);
                transition: all 0.3s ease;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            }
        </style>
        <!------------------------------------>

@endsection

