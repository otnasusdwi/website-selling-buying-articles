@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Order Artikel</h6>
                </div>
                <div class="car-body pb-0 p-4">
                    <form action="{{ route('pembeli.order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="harga" id="harga" value="">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cars">Tipe Artikel:</label><br>
                                <select class="form-select" name="tipe_artikel_id" id="tipe_artikel_id" required>
                                    <option hidden value="">Pilih Tipe Artikel</option>
                                    @foreach ($tipe_artikels as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cars">Panjang Artikel:</label><br>
                                <select class="form-select" name="harga_id" id="harga_id" required>
                                    <option hidden value="">Pilih Jumlah Karakter</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cars">Judul Artikel:</label><br>
                                <input type="text" class="form-control" placeholder="Judul Artikel"
                                    aria-label="Judul Artikel" name="judul" required>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#tipe_artikel_id').on('change', function() {
                var tipe_artikel_id = $(this).val();
                // console.log('hay');
                if (tipe_artikel_id) {
                    $.ajax({
                        url: '{{ Config::get('app.url') }}/pembeli/artikel/order/pricing/' +
                            tipe_artikel_id,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                // console.log(data);
                                $('#harga_id').empty();
                                $('#harga_id').append(
                                    '<option hidden>Pilih Jumlah Karakter</option>');
                                $.each(data, function(key, hargas) {
                                    // console.log(hargas.title);
                                    $('select[name="harga_id"]').append(
                                        '<option harga="' + hargas.harga +
                                        '" value="' + hargas.id +
                                        '">' + hargas.panjang + ' Karakter (Rp ' +
                                        hargas.harga +
                                        ')</option>');
                                });
                            } else {
                                $('#harga_id').empty();
                            }
                        }
                    });
                } else {
                    $('#harga_id').empty();
                }
            });
        });
    </script>
    <script>
        $("#harga_id").change(function() {
            var element = $("option:selected", this);
            var harga = element.attr("harga");
            $('#harga').val(harga);
        });
    </script>
@endsection
