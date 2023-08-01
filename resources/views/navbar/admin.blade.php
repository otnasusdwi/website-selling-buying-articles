<li class="nav-item">
    <a @if (Request::segment(2) == 'dashboard') class="nav-link active" @else class="nav-link" @endif
        href="{{ route('admin.dashboard') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-pie-35 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
    </a>
</li>
@if (Auth::user()->role == 'admin' && Auth::user()->type == 'production')
    <li class="nav-item">
        <a @if (Request::segment(2) == 'penulis') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.penulis') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-books text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Calon Penulis</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'artikel') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.artikel') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-time-alarm text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Overtime Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'order') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.order.verifikasi') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Verifikasi Artikel</span>
        </a>
    </li>
@endif

@if (Auth::user()->role == 'admin' && Auth::user()->type == 'finance')
    <li class="nav-item">
        <a @if (Request::segment(2) == 'order') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.order.verifikasi') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Verifikasi Pembayaran</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'invoice') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.invoice') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Invoice</span>
        </a>
    </li>
    <li class="nav-item">
        <a @if (Request::segment(2) == 'fee') class="nav-link active" @else class="nav-link" @endif
            href="{{ route('admin.fee') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-scissors text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Management Fee</span>
        </a>
    </li>
@endif
