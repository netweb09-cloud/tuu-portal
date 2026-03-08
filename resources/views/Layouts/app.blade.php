<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUU Portal - Cổng thông tin Trường Đại học Công đoàn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .navbar-brand { font-weight: bold; color: #0056b3; }
        .hero-section { background: #f8f9fa; padding: 60px 0; }
        .card-news img { height: 200px; object-fit: cover; }
        /* Màu xanh Navy chuyên nghiệp */
        footer {
            background-color: #001f3f !important; /* Mã màu Navy chuẩn */
            border-top: 4px solid #ffc107; /* Thêm một đường kẻ vàng ở trên cùng để tạo điểm nhấn */
        }

        /* Tùy chỉnh màu chữ phụ để dễ đọc trên nền xanh đậm */
        footer .text-secondary {
            color: #cbd5e0 !important; 
        }

        footer hr.border-secondary {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        /* Đảm bảo ảnh luôn cân đối và không bị méo */
        .carousel-item img {
            height: 500px; /* Độ cao cố định cho Desktop */
            object-fit: cover; /* Cắt ảnh sao cho vừa khung hình */
        }

        /* Trên điện thoại thì hạ thấp độ cao xuống cho dễ nhìn */
        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px;
            }
        }
        /* Tùy chỉnh màu sắc chủ đạo theo phong cách TUU */
        :root {
            --primary-u: #003366; 
            --secondary-u: #ffc107;
        }

        .bg-primary { background-color: var(--primary-u) !important; }
        .text-primary { color: var(--primary-u) !important; }

        /* Hiệu ứng cho các khối tin tức */
        .card-hover {
            transition: all 0.3s ease;
            border: none !important;
        }
        .card-hover:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }

        .carousel-indicators [data-bs-target] {
            width: 40px;
            height: 6px;
            border-radius: 3px;
            background-color: #fff;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        .carousel-indicators .active {
            width: 60px; /* Khi active thì dài ra nhìn rất hiện đại */
            opacity: 1;
            background-color: var(--secondary-u); /* Màu vàng */
        }

        /* Hiệu ứng zoom nhẹ khi chuyển ảnh */
        .carousel-item img {
            transition: transform 5s linear;
        }
        .carousel-item.active img {
            transform: scale(1.1);
        }

        /* Hiệu ứng cho nút mũi tên khi hover */
        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            background-color: var(--primary-u) !important;
            opacity: 1;
        }
        /* Màu Navy ton-sur-ton với Footer */
        .navbar {
            background-color: #fff;
            border-bottom: 3px solid #001f3f; /* Màu xanh Navy */
        }

        /* Hiệu ứng Hover xổ Menu */
        @media (min-width: 992px) {
            .dropdown-hover:hover > .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }

        .dropdown-menu {
            min-width: 220px;
            border-radius: 0 0 8px 8px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #001f3f;
            padding-left: 1.5rem;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: #333;
            font-size: 0.9rem;
            padding: 1rem 1.2rem !important;
        }

        .nav-link:hover {
            color: #001f3f;
        }
        .search-box-container {
            display: flex;
            align-items: center;
    }

    .search-box {
        position: relative;
        height: 40px;
        display: flex;
        align-items: center;
        transition: all 0.4s ease;
    }

    .search-input {
        width: 0; /* Mặc định ẩn ô nhập */
        height: 100%;
        border: none;
        outline: none;
        background: #f1f1f1;
        border-radius: 20px;
        padding: 0;
        transition: all 0.4s ease;
        font-size: 0.9rem;
        opacity: 0;
    }

    .search-btn {
        background: none;
        border: none;
        color: var(--primary-u); /* Màu xanh Navy của bạn */
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px 10px;
        transition: all 0.3s ease;
    }

    /* Khi active: Ô nhập dài ra và hiện lên */
    .search-box.active {
        background: #f1f1f1;
        border-radius: 20px;
        padding-left: 15px;
    }

    .search-box.active .search-input {
        width: 200px; /* Độ dài khi mở ra */
        padding: 0 10px;
        opacity: 1;
    }

    .search-box.active .search-btn {
        color: #333;
    }

    .category-section {
        background: #fff;
        padding: 10px;
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-title a:hover {
        color: var(--primary-u) !important;
    }

    /* Hiệu ứng gạch chân tiêu đề Category */
    .category-section h3 {
        position: relative;
    }

    .breadcrumb {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F285"; /* Icon chevron của Bootstrap Icons */
        font-family: "bootstrap-icons";
        font-size: 0.7rem;
        color: #adb5bd;
    }

    .text-navy {
        color: #001f3f;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    .post-content table {
        width: 100% !important;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }
    #top-banner {
        background-color: #ffffff;
        z-index: 1020;
    }

    /* Đảm bảo navbar luôn nằm trên cùng */
    .sticky-top {
        top: 0;
    }

    /* Loại bỏ gạch chân khi di chuột vào hotline */
    .banner-right a:hover {
        color: #b30000 !important; /* Đỏ đậm hơn một chút khi hover */
    }
    /* Sidebar cố định khi cuộn trong phạm vi cột của nó */
    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px; /* Cách Menu một khoảng để không bị đè */
    }

    /* Sửa lại Sidebar Link Item cho đẹp */
    .sidebar-link-item {
        font-size: 0.95rem;
        transition: all 0.2s;
        border-left: 3px solid transparent !important;
    }

    .sidebar-link-item:hover {
        border-left: 3px solid #001f3f !important;
        background-color: #f0f4f8;
        padding-left: 20px;
    }
    
</style>
</head>
<body>

    <div id="top-banner" class="bg-white d-none d-md-block" style="transition: all 0.4s ease; height: 150px; overflow: hidden; border-bottom: 1px solid #f0f0f0;">
        <div class="container" style="margin: 0 auto; height: 100%;">
            <div class="d-flex justify-content-between align-items-center h-100">
                
                <div class="banner-left">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/bannerdhcd.jpg') }}" 
                            alt="Logo Trường Đại học Công đoàn" 
                            style="height: 130px; width: auto; display: block;">
                    </a>
                </div>

                <div class="banner-right text-end">
                    <div class="text-secondary small text-uppercase mb-1" style="letter-spacing: 1px; font-weight: 500;">
                        Hotline hỗ trợ
                    </div>
                    <a href="tel:02438573204" class="fw-bold text-danger text-decoration-none d-flex align-items-center justify-content-end" style="font-size: 1.8rem; line-height: 1;">
                        <i class="bi bi-telephone-outbound-fill me-2" style="font-size: 1.4rem;"></i> 
                        (024) 3857 3204
                    </a>
                </div>

            </div>
        </div>
    </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="/">TUU PORTAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    
                    <ul class="navbar-nav ms-auto ">
                        <div class="search-box-container ms-lg-3">
                            <div class="search-box">
                                <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm tin tức, văn bản...">
                                <button class="search-btn" id="searchBtn" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <li class="nav-item"><a class="nav-link" href="http://tuu-portal.test/"><span class="fw-bold">TRANG CHỦ</span></a></li>                    
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mb-2 mobile-grid" >
                            @foreach($categories->where('parent_id', null) as $parent)
                                @if($parent->children->count() > 0)
                                    <li class="nav-item dropdown dropdown-hover">
                                        <a class="nav-link dropdown-toggle fw-bold text-uppercase" href="#" role="button" data-bs-toggle="dropdown">
                                            {{ $parent->name }}
                                        </a>
                                        <ul class="dropdown-menu shadow-sm">
                                            @foreach($parent->children as $child)
                                                <li>
                                                    @php
                                                        // Logic chọn URL thông minh
                                                        $url = $child->page_id 
                                                                ? url('/page/' . $child->page->slug) 
                                                                : url('/category/' . $child->slug);
                                                    @endphp
                                                    
                                                    <a class="dropdown-item py-2" href="{{ $url }}">
                                                        <i class="bi bi-chevron-right small me-1"></i> {{ $child->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold text-uppercase" href="{{ url('/category/' . $parent->slug) }}">
                                            {{ $parent->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="/admin">Đăng nhập</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    
    <main>
        @yield('content')
    </main>

    <footer class="text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold text-uppercase mb-4 border-start border-primary border-4 ps-2">TUU PORTAL</h5>
                <p class="small text-secondary">Cổng thông tin điện tử hỗ trợ sinh viên và cán bộ giảng viên. Cập nhật những tin tức và văn bản quy định mới nhất từ nhà trường.</p>
                <p class="small text-secondary">Website: http://www.dhcd.edu.vn - Email: dhcongdoan@dhcd.edu.vn</p>
                <p class="small text-secondary">Ghi rõ nguồn "Đại học Công Đoàn" khi phát hành lại thông tin từ website.</p>
                <div class="contact-info small">
                    <p class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> Số 169, Tây Sơn, Kim Liên, Hà Nội</p>
                    <p class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> Hotline: (84-4) 3.857.3204</p>
                    <p class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> Email: contact@tuu.edu.vn</p>
                </div>
            </div>

            <div class="col-lg-2">
                <h5 class="fw-bold text-uppercase mb-4 border-start border-primary border-4 ps-2">Liên kết</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/" class="text-secondary text-decoration-none hover-white">Trang chủ</a></li>
                    <li class="mb-2"><a href="/documents" class="text-secondary text-decoration-none hover-white">Văn bản quy định</a></li>
                    <li class="mb-2"><a href="/search" class="text-secondary text-decoration-none hover-white">Tra cứu tin tức</a></li>
                    <li class="mb-2"><a href="/admin" class="text-secondary text-decoration-none hover-white">Hệ thống quản trị</a></li>
                </ul>
            </div>

            <div class="col-lg-2">
                <h5 class="fw-bold text-uppercase mb-4 border-start border-primary border-4 ps-2">Kết nối</h5>
                <div class="d-flex gap-3 mb-4">
                    <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-tiktok"></i></a>
                </div>
                <div class="stats small text-secondary">
                    <p class="mb-1">Đang trực tuyến: <strong>124</strong></p>
                    <p class="mb-0">Tổng lượt truy cập: <strong>1.542.890</strong></p>
                </div>
            </div>

            <div class="col-lg-4">
                <h5 class="fw-bold text-uppercase mb-4 border-start border-primary border-4 ps-2">Vị trí nhà trường</h5>
                <div class="rounded overflow-hidden shadow-sm border border-secondary border-opacity-25">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.591236528994!2d105.8208757759676!3d21.00901718845625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac8724073547%3A0x659195bd60304ae5!2zMTY5IFTDonkgU8ahbiwgUXVhbmcgVHJ1bmcsIMSQ4buRbmcgRGEsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1709836500000!5m2!1svi!2s" 
                        width="100%" 
                        height="200" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center small text-secondary">
            <div class="col-md-6 text-center text-md-start">
                &copy; {{ date('Y') }} Bản quyền thuộc về TUU Portal. Thiết kế bởi <strong>Khoa CN&KT</strong>.
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span class="me-3">Chính sách bảo mật</span>
                <span>Điều khoản sử dụng</span>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const searchBtn = document.getElementById('searchBtn');
    const searchBox = searchBtn.parentElement;
    const searchInput = document.getElementById('searchInput');

    searchBtn.addEventListener('click', () => {
        // Nếu đang đóng thì mở ra
        if (!searchBox.classList.contains('active')) {
            searchBox.classList.add('active');
            searchInput.focus();
        } else {
            // Nếu đã mở và có chữ thì thực hiện tìm kiếm
            if (searchInput.value.trim() !== "") {
                window.location.href = "/search?q=" + encodeURIComponent(searchInput.value);
            } else {
                // Nếu mở mà không có chữ thì đóng lại
                searchBox.classList.remove('active');
            }
        }
    });

    // Đóng lại khi click ra ngoài
    document.addEventListener('click', (e) => {
        if (!searchBox.contains(e.target)) {
            searchBox.classList.remove('active');
        }
    });

    // Gửi tìm kiếm khi nhấn Enter
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && searchInput.value.trim() !== "") {
            window.location.href = "/search?q=" + encodeURIComponent(searchInput.value);
        }
    });
</script>
<script>
    window.addEventListener('scroll', function() {
        const banner = document.getElementById('top-banner');
        // Khi cuộn xuống quá 50px
        if (window.scrollY > 50) {
            banner.style.height = "0px";
            banner.style.opacity = "0";
        } else {
            // Khi ở vị trí trên cùng
            banner.style.height = "150px";
            banner.style.opacity = "1";
        }
    });
</script>
</body>
</html>