<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Order Artikel</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entitas
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    Order
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                @if (Auth::user()->role == 'admin' && Auth::user()->type == 'finance')
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Bukti TF</th>
                                @endif
                                @if (Auth::user()->role == 'admin' && Auth::user()->type == 'production')
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File
                                        Artikel</th>
                                @endif
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="mb-0 text-sm">
                                                    <b>{{ $order->judul }}</b><br>
                                                    {{ $order->articletype->name }}<br>
                                                    Pembeli : Rp {{ format_uang($order->price) }}<br>
                                                    Penulis : Rp
                                                    {{ format_uang($order->price - $order->price * 0.2) }}<br>
                                                    @if ($order->status == 'done')
                                                        Fee : Rp {{ format_uang($order->price * 0.2) }}<br>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="mb-0 text-sm">
                                                    <b>Pembeli:</b> {{ $order->pembeli->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $order->order_date }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @if ($order->status == 'pending')
                                            <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                                        @elseif ($order->status == 'paid')
                                            <span class="badge badge-sm bg-gradient-success">Paid</span>
                                        @elseif ($order->status == 'onprogress')
                                            <span class="badge badge-sm bg-gradient-success">On Progress</span>
                                        @elseif ($order->status == 'uploaded')
                                            <span class="badge badge-sm bg-gradient-warning">Uploaded</span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-info">Done</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'admin' && Auth::user()->type == 'finance')
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('buktitf/' . $order->bukti_tf) }}" alt=""
                                                        width="50">
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                    @if (Auth::user()->role == 'admin' && Auth::user()->type == 'production')
                                        <td class="text-center">
                                            @if ($order->file)
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('download', $order->file) }}">
                                                    <i class="fa fa-download fa-lg"></i> Download
                                                </a>
                                                <br>
                                            @endif
                                            @if ($order->note)
                                                <p class="mb-0 text-sm">({{ $order->note }})</p>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="align-middle text-center text-sm">
                                        @if (Auth::user()->role == 'admin' && Auth::user()->type == 'finance')
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cogs fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    @if (isset($order->bukti_tf))
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'paid']) }}')">
                                                                Paid
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'pending']) }}')">
                                                                Pending
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                        @if (Auth::user()->role == 'admin' && Auth::user()->type == 'production')
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cogs fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li>
                                                        @if (isset($order->file) && $order->status == 'uploaded')
                                                            <a class="dropdown-item" href="#"
                                                                onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'done']) }}')">
                                                                <b>Accept</b>
                                                            </a>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'rejected']) }}')">
                                                                <b>Reject</b>
                                                            </a>
                                                        @endif
                                                        @if (isset($order->file) && $order->status == 'rejected')
                                                            <a class="dropdown-item" href="#"
                                                                onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'done']) }}')">
                                                                <b>Accept</b>
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        {{-- <a href="#" onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', $order->id ) }}')">
										<i class="fa fa-check-circle fa-lg"></i>
									</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
