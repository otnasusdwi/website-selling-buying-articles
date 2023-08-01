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
                                    Status
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File
                                    Artikel
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi
                                </th>
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
                                                    Penulis : Rp {{ format_uang($order->harga_penulis) }}<br>
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        Fee : Rp {{ format_uang($order->potongan) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="mb-0 text-sm">
                                                    <b>Pembeli:</b> {{ $order->pembeli->name }}
                                                    <br />
                                                    <b>Penulis:</b> {{ $order->penulis->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $order->tanggal_order }}</h6>
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
                                    <td class="text-center">
                                        @if ($order->file_artikel)
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('download', $order->file_artikel) }}">
                                                <i class="fa fa-download fa-lg"></i> Download
                                            </a>
                                            <br>
                                        @endif
                                        @if ($order->note)
                                            <p class="mb-0 text-sm">({{ $order->note }})</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"
                                                @if ($order->status == 'done') disabled @endif>
                                                <i class="fa fa-cogs fa-lg"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    @if (isset($order->file_artikel) && $order->status == 'uploaded')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'done']) }}')">
                                                            <b>Accept</b>
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'rejected']) }}')">
                                                            <b>Reject</b>
                                                        </a>
                                                    @endif
                                                    @if (isset($order->file_artikel) && $order->status == 'rejected')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="setSTATUS('{{ route('admin.order.verifikasi.payment', ['id' => $order->id, 'status' => 'done']) }}')">
                                                            <b>Accept</b>
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
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
