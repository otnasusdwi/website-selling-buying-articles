@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Progress Order Artikel</h6>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File
                                        Artikel</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
						   Aksi</th> --}}
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
                                                        <b>Dikerjakan :</b> {{ tgl_indo($order->tanggal_ambil) }}
                                                        <br />
                                                        @if (isset($order->tanggal_selesai))
                                                            <b>Selesai :</b> {{ tgl_indo($order->tanggal_selesai) }}
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
                                            @if (
                                                $order->status_order == 'onprogress' ||
                                                    $order->status_order == 'uploaded' ||
                                                    $order->status_order == 'overtime' ||
                                                    $order->status_order == 'rejected')
                                                <span class="badge badge-sm bg-gradient-success">On Progress</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-info">Done</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (isset($order->file_artikel) && $order->status_order == 'done')
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('download', $order->file_artikel) }}">
                                                    <i class="fa fa-download fa-lg"></i> Download
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    {!! $orders->links() !!}
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
                        <div class=" col-md-12">
                            <div class="text-center" id='editloadingmessage' style='display: none; padding-bottom: 50px;'>
                                <img width="70" src="{{ asset('img/loading.gif') }}" class="tengah" />
                            </div>
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
