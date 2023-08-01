<li class="nav-item">
    <a @if (Request::segment(2) == 'dashboard') class="nav-link active" @else class="nav-link" @endif
        href="{{ route('pembeli.dashboard') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-pie-35 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a @if (Request::segment(2) == 'artikel') class="nav-link active" @else class="nav-link" @endif
        href="{{ route('pembeli.artikel') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-cart text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Order Artikel</span>
    </a>
</li>
<li class="nav-item">
    <a @if (Request::segment(2) == 'progress') class="nav-link active" @else class="nav-link" @endif
        href="{{ route('pembeli.progress') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-bar-32 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Progress Artikel</span>
    </a>
</li>
