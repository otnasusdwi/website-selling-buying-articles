@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Order Anda</h6>
                    <br>
                    <a href="{{ route('pembeli.order') }}" class="btn btn-primary"><i class="fa fa-cart-plus"
                            aria-hidden="true"></i> Order Artikel</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul
                                    </th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entitas</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti TF
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
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
                                                        <b>{{ $order->judul }}</b>
                                                        <br>
                                                        ({{ $order->tipe_artikel->nama }} - Rp
                                                        {{ format_uang($order->harga) }})
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">
                                                        <b>Order : </b>{{ tgl_indo($order->tanggal_order) }}
                                                        @if (isset($order->tanggal_bayar))
                                                            <br>
                                                            <b>Paid : </b>{{ tgl_indo($order->tanggal_bayar) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
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
                                            @if ($order->status == 'pending')
                                                <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                                            @elseif ($order->status == 'paid')
                                                <span class="badge badge-sm bg-gradient-success">Paid</span>
                                            @elseif ($order->status == 'onprogress' || $order->status == 'rejected')
                                                <span class="badge badge-sm bg-gradient-success">On Progress</span>
                                            @elseif ($order->status == 'uploaded')
                                                <span class="badge badge-sm bg-gradient-warning">Uploaded</span>
                                            @elseif ($order->status == 'rejected')
                                                <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-info">Done</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a class="btn btn-sm btn-warning" href="#"
                                                onclick="uploadTF('{{ $order->id }}')">
                                                <i class="fa fa-cloud-upload"></i> Upload
                                            </a>
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
    <div id="uploadTF" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h6>Upload Bukti Transfer</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row xs-mt-50">
                        <div class="col-md-12">
                            <form action="{{ route('pembeli.order.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div id="editresult" class="editresult"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function uploadTF(id) {
            $('#uploadTF').modal("show");
            $('#editloadingmessage').show();
            $('#editresult').hide();
            // console.log(id);
            $.ajax({
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                url: "{{ route('pembeli.order.edit') }}",
                success: function(data) {
                    $('#editloadingmessage').hide();
                    $('#editresult').show();
                    $('.editresult').html(data);
                }
            });
        }
        // function uploadTF() {
        //    // console.log('accepted');
        //    $('#uploadTF').modal("hide");
        // }
        function hideUploadTF() {
            // console.log('accepted');
            $('#uploadTF').modal("hide");
        }
    </script>
@endsection
