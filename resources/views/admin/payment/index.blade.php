@extends('../layouts.app')
@section('content')
    @if (Auth::user()->role == 'admin' && Auth::user()->type == 'production')
        @include('admin.payment._production')
    @else
        @include('admin.payment._finance')
    @endif
    <div id="setSTATUS" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>Perhatian!</h3>
                        <p>Anda yakin akan merubah status?</p>
                    </div>
                </div>
                <div id="formsetSTATUS"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function setSTATUS(url) {
            // console.log('accepted');
            $('#setSTATUS').modal("show");
            $('#setSTATUS').modal();
            $('#formsetSTATUS').html(
                '<form action="' + url + '" method="POST"> @csrf' +
                '<div class="modal-body">' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<div class="form-group">' +
                '<label for="exampleFormControlTextarea1">Keterangan</label>' +
                '<textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="note"></textarea>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '<button type="button" class="btn btn-space btn-default" onclick="hidesetSTATUS()">Batal</button>' +
                '</div>' +
                '<div class="col-md-6">' +
                '<button type="submit" class="btn btn-primary">SUBMIT</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</form>'
            );
        }

        function hidesetSTATUS() {
            // console.log('accepted');
            $('#setSTATUS').modal("hide");
        }
    </script>
@endsection
