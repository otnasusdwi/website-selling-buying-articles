<div class="row">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-2">Selamat datang di Tulisin</h5>
                </div>
            </div>
            <div class="car-body pb-0 p-3">
                <p>
                    Terima kasih telah mendaftar sebagai penulis
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Artikel Anda</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Judul</th>
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
                                                <h6 class="mb-0 text-sm">{{ $artikel->judul }}</h6>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    ({{ $artikel->tipe_artikel->nama }})
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ tgl_indo($artikel->created_at) }}
                                        </span>
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
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('download', $artikel->file) }}">
                                            <i class="fa fa-download fa-lg"></i> Download
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
@if ($artikels[0]->status == 'rejected' && Auth::user()->artikel == 1)
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-2">Ups, artikel pertama ditolak karena belum memenuhi syarat & kebijakan
                            kami. Silahkan
                            upload artikel kedua anda</h5>
                    </div>
                </div>
                <div class="car-body pb-0 p-3">
                    <form action="{{ route('penulis.dashboard.resubmit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cars">Jenis Artikel:</label><br>
                                <select class="form-select" aria-label="Default select example" name="tipe_artikel_id"
                                    required>
                                    <option hidden value="">Pilih Jenis Artikel</option>
                                    @foreach ($tipe_artikels as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cars">Judul Artikel:</label><br>
                                <input type="text" class="form-control" placeholder="Name" aria-label="Judul Artikel"
                                    name="judul" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cars">File Artikel:</label><br>
                                <input type="file" name="article" required>
                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <button type="submit" class="btn bg-gradient-dark w-10 my-4 mb-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($artikels[0]->status == 'rejected' && Auth::user()->artikel == 2)
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-2">Mohon maaf Anda belum diterima di Tulizin</h5>
                    </div>
                </div>
                <div class="car-body pb-0 p-3">
                    <p>
                        Silahkan submit lagi 30 hari kedepan
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Auth::user()->artikel == 0)
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-2">Anda sudah bisa submit ulang artikel, silahkan upload</h5>
                    </div>
                </div>
                <div class="car-body pb-0 p-3">
                    <form action="{{ route('penulis.dashboard.resubmit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cars">Jenis Artikel:</label><br>
                                <select class="form-select" aria-label="Default select example" name="tipe_artikel_id"
                                    required>
                                    <option hidden value="">Pilih Jenis Artikel</option>
                                    @foreach ($tipe_artikels as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cars">Judul Artikel:</label><br>
                                <input type="text" class="form-control" placeholder="Name" aria-label="Judul Artikel"
                                    name="judul" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cars">File Artikel:</label><br>
                                <input type="file" name="article" required>
                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <button type="submit" class="btn bg-gradient-dark w-10 my-4 mb-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
