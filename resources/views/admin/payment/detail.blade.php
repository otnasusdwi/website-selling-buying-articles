@extends('../layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title m-0">
                    Invoice:
                    <strong>{{ numberInvoice($invoice->id, $invoice->tanggal_klaim) }}</strong>
                </div>
                <div>
                    @if ($invoice->status == 'pending')
                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                    @elseif ($invoice->status == 'paid')
                        <span class="badge badge-sm bg-gradient-success">Paid</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{ $invoice->penulis->name }}</strong>
                        </div>
                        <div>{{ $invoice->penulis->alamat }}</div>
                        <div>Email: {{ $invoice->penulis->email }}</div>
                        <div>No Telp: {{ $invoice->penulis->no_telp }}</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>Tulizin</strong>
                        </div>
                        <div>{{ profileTulizin()['alamat'] }}</div>
                        <div>Email: {{ profileTulizin()['email'] }}</div>
                        <div>Phone: {{ profileTulizin()['no_telp'] }}</div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Deskripsi</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item_invoices as $key => $item)
                                <tr>
                                    <td class="text-left">{{ $key + 1 }}</td>
                                    <td class="text-left">{{ $item->order->judul }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp {{ format_uang($item->nominal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-8">

                    </div>

                    <div class="col-md-4 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                {{-- <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">Rp {{ format_uang($invoice->nominal) }}</td>
                                </tr> --}}
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        <strong>Rp {{ format_uang($invoice->nominal) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">
                <div class="row">
                    <div class="card-title m-0">
                    </div>
                </div>
                <div>
                    @if ($invoice->status == 'pending')
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="uploadTFInvoice()">
                            Bayar Invoice
                        </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="uploadTF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Upload Bukti TF Invoice</h6>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('admin.invoice.paid') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="cars">File Bukti Transfer (jpg, jpeg, png):</label><br>
                                                <input type="file" name="bukti_tf" required>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-space btn-default"
                                                    onclick="hideUploadTFInvoice()">Batal</button>&nbsp;
                                                <button type="submit" class="btn btn-primary">UPLOAD</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function uploadTFInvoice() {
            $('#uploadTF').modal("show");
        }

        function hideUploadTFInvoice() {
            // console.log('accepted');
            $('#uploadTF').modal("hide");
        }
    </script>
@endsection
