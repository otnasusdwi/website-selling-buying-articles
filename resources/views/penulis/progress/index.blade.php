@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Progress Artikel</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe
                                        Artikel
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Deadline
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        File</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($joblists as $key => $joblist)
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
                                                    <h6 class="mb-0 text-sm">{{ $joblist->judul }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $joblist->tipe_artikel->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Rp
                                                        {{ format_uang($joblist->harga_penulis) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ tgl_indo(date('Y-m-d H:i:s', strtotime($joblist->tanggal_ambil . ' + 2 days'))) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if (isset($joblist->file_artikel))
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('download', $joblist->file_artikel) }}">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                            @else
                                                <button disabled class="btn btn-sm btn-success text-white">
                                                    <i class="fa fa-download"></i> Download
                                                </button>
                                            @endif
                                            @if (isset($joblist->note))
                                                <p class="mb-0 text-sm">({{ $joblist->note }})</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($joblist->status_order == 'pending')
                                                <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                                            @elseif ($joblist->status_order == 'paid')
                                                <span class="badge badge-sm bg-gradient-success">Paid</span>
                                            @elseif ($joblist->status_order == 'onprogress')
                                                <span class="badge badge-sm bg-gradient-success">On Progress</span>
                                            @elseif ($joblist->status_order == 'uploaded')
                                                <span class="badge badge-sm bg-gradient-warning">Uploaded</span>
                                            @elseif ($joblist->status_order == 'rejected')
                                                <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-info">Done</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($joblist->status_order != 'done')
                                                <a class="btn btn-sm btn-warning" href="#"
                                                    onclick="uploadFile('{{ $joblist->id }}')">
                                                    <i class="fa fa-cloud-upload"></i> Upload
                                                </a>
                                            @endif
                                            @if ($joblist->status_order == 'done')
                                                <buton class="btn btn-sm btn-warning text-white" href="#" disabled>
                                                    <i class="fa fa-cloud-upload"></i> Upload
                                                </buton>
                                            @endif
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
    <div id="uploadFile" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h6>Upload File Artikel</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row xs-mt-50">
                        <div class=" col-md-12">
                            <div class="text-center" id='editloadingmessage' style='display: none; padding-bottom: 50px;'>
                                <img width="70" src="{{ asset('img/loading.gif') }}" class="tengah" />
                            </div>
                            <form action="{{ route('penulis.progress.update') }}" method="post"
                                enctype="multipart/form-data">
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
        function uploadFile(id) {
            $('#uploadFile').modal("show");
            $('#editloadingmessage').show();
            $('#editresult').hide();
            $.ajax({
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                url: "{{ route('penulis.progress.edit') }}",
                success: function(data) {
                    $('#editloadingmessage').hide();
                    $('#editresult').show();
                    $('.editresult').html(data);
                }
            });
        }

        function hideUploadFile() {
            $('#uploadFile').modal("hide");
        }
    </script>
@endsection
