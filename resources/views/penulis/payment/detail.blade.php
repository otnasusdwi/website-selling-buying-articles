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
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">Rp {{ format_uang($invoice->nominal) }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
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
        </div>
    </div>
@endsection
