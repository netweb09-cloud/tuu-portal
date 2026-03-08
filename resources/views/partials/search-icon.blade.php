<div class="search-box-container d-flex align-items-center">
    <a class="text-white text-decoration-none p-2" href="javascript:void(0)" id="toggleSearch">
        <i class="bi bi-search fs-5"></i>
    </a>

    <div id="searchOverlay" class="search-overlay d-none">
        <form action="{{ url('/search') }}" method="GET" class="d-flex w-100">
            <input type="text" name="query" class="form-control form-control-sm border-0 shadow-none" 
                   placeholder="Tìm kiếm thông tin..." required>
            <button type="submit" class="btn btn-sm btn-link text-navy text-decoration-none fw-bold">
                TÌM
            </button>
            <button type="button" id="closeSearch" class="btn btn-sm btn-link text-danger text-decoration-none">
                <i class="bi bi-x-lg"></i>
            </button>
        </form>
    </div>
</div>