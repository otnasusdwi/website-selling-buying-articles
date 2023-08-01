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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Bukti TF</th>
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
                                                    {{ $order->tipe_artikel->nama }}<br>
                                                    Pembeli : Rp {{ format_uang($order->harga) }}<br>
                                                    Penulis : Rp
                                                    {{ format_uang($order->harga - $order->harga * 0.2) }}<br>
                                                    @if ($order->status == 'done')
                                                        <span class="badge badge-sm bg-gradient-success">
                                                            Fee : Rp {{ format_uang($order->harga * 0.2) }}
                                                        </span>
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
                                                    <br>
                                                    <b>Penulis:</b>
                                                    {{ isset($order->penulis_id) ? $order->penulis->name : '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="mb-0 text-sm">
                                                    <b>Order : </b>{{ tgl_indo($order->tanggal_order) }} <br />
                                                    <b>Paid :
                                                    </b>{{ isset($order->tanggal_bayar) ? tgl_indo($order->tanggal_bayar) : '' }}
                                                </p>
                                                {{-- <h6 class="mb-0 text-sm">{{ $order->tanggal_order }}</h6> --}}
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
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <img src="{{ asset('buktitf/' . $order->bukti_tf) }}" alt=""
                                                    width="50">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-cogs fa-lg"></i>
                                            </button>

                                            @if (isset($order->bukti_tf) && $order->status == 'pending')
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
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
                                                </ul>
                                            @endif
                                        </div>
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
