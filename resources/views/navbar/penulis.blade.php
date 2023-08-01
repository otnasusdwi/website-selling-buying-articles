<li class="nav-item">
    <a @if (Request::segment(2) == 'dashboard') class="nav-link active" @else class="nav-link" @endif
        href="{{ route('penulis.dashboard') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-pie-35 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
    </a>
</li>
@if (Auth::user()->status == 'active')
    <li class="nav-item">
        <a @if (Request::segment(2) == 'joblist') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('penulis.joblist') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Job Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'progress') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('penulis.progress') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-chart-bar-32 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Progress Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'payment') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('penulis.payment') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-check-bold text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel Selesai</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'invoice') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('penulis.invoice') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Invoice</span>
        </a>
    </li>
@endif
