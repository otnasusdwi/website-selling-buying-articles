@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Joblist Artikel</h6>
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
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($joblists as $key => $joblist)
                                    @if (checkAvailable($joblist->deadline) == 1)
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
                                            <td class="align-middle text-center text-sm">
                                                <a class="btn btn-sm btn-primary" href="#"
                                                    onclick="ambilJob('{{ $joblist->id }}', '{{ route('penulis.joblist.ambil') }}')">
                                                    <i class="ni ni-briefcase-24"></i> Ambil Job
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ambilJob" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>Perhatian!</h3>
                        <p>Anda mengambil job artikel ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <div class="row xs-mt-50">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-space btn-default"
                                    onclick="hideAmbilJob()">Batal</button>
                            </div>
                            <div class="col-md-6">
                                <div id="formAccepted"></div>
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
        function ambilJob(id, url) {
            Swal.fire({
                title: "Perhatian!",
                text: "Anda akan mengambil Job ini?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.status == "success") {
                                Swal.fire('Berhasil !!', results.message, 'success').then(() => {
                                    // location.reload();
                                    window.location.href = "{{ route('penulis.progress') }}";
                                });
                            } else {
                                Swal.fire('Upps !!', results.message, 'warning').then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>
    <script type="text/javascript">
        // function ambilJob(id) {
        //     alert(id);
        //     console.log('accepted');
        //     $('#ambilJob').modal("show");
        //     $('#ambilJob').modal();
        //     $('#formAccepted').html('<form action="' + url +
        //         '" method="POST"> @csrf<button type="submit" class="btn btn-primary">Yes</button></form>'
        //     );
        // }

        function hideAmbilJob() {
            // console.log('accepted');
            $('#ambilJob').modal("hide");
        }
    </script>
@endsection
