@extends('../layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Artikel Calon Penulis</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    {{-- <div class="table-responsive p-0"> --}}
                    <div class="p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Penulis</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikels as $key => $artikel)
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
                                                    <h6 class="mb-0 text-sm">{{ $artikel->penulis->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $artikel->penulis->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $artikel->judul }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ tgl_indo($artikel->created_at) }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($artikel->status == 'submitted')
                                                <span class="badge badge-sm bg-gradient-warning">Submitted</span>
                                            @elseif ($artikel->status == 'rejected')
                                                <span class="badge badge-sm bg-gradient-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-success">Approved</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{-- <a href="{{ route('download', $artikel->file) }}">
                                                <i class="fa fa-download fa-lg"></i>
                                            </a>
                                            &nbsp;
                                            <a href="#"
                                                onclick="accepted('{{ route('admin.penulis.update', ['id' => $artikel->id, 'status' => 'approved', 'penulis_id' => $artikel->penulis_id]) }}')">
                                                <i class="fa fa-check-circle fa-lg"></i>
                                            </a>
                                            &nbsp;
                                            <a href="#"
                                                onclick="rejected('{{ route('admin.penulis.update', ['id' => $artikel->id, 'status' => 'rejected', 'penulis_id' => $artikel->penulis_id]) }}')">
                                                <i class="fa fa-window-close fa-lg warning"></i>
                                            </a> --}}
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cogs fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('download', $artikel->file) }}">
                                                            <b>Download</b>
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="accepted('{{ route('admin.penulis.update', ['id' => $artikel->id, 'status' => 'approved', 'penulis_id' => $artikel->penulis_id]) }}')">
                                                            <b>Accept</b>
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="rejected('{{ route('admin.penulis.update', ['id' => $artikel->id, 'status' => 'rejected', 'penulis_id' => $artikel->penulis_id]) }}')">
                                                            <b>Reject</b>
                                                        </a>
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

    <div id="accepted" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>Perhatian!</h3>
                        <p>Anda yakin akan meng-<i>accept</i> data?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <div class="row xs-mt-50">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-space btn-default" onclick="hide()"">Batal</button>
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


    <div id="rejected" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>Perhatian!</h3>
                        <p>Anda yakin akan me-<i>reject</i> artikel?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <div class="row xs-mt-50">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-space btn-default" onclick="hide()"">Batal</button>
                            </div>
                            <div class="col-md-6">
                                <div id="formRejected"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
