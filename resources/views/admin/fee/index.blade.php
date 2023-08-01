@extends('../layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Management Fee</h6>
                </div>
                <div class="car-body pb-0 p-4">
                    <form action="{{ route('admin.fee.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $fee->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cars">Prosentase (%):</label><br>
                                <input type="text" class="form-control" placeholder="%" aria-label="%" name="prosentase"
                                    value="{{ $fee->prosentase }}" required>
                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <button type="submit" class="btn bg-gradient-dark w-10 my-4 mb-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
