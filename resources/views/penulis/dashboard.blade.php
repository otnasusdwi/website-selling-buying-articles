@extends('../layouts.app')
@section('content')
    @if (Auth::user()->status == 'registered')
        @include('penulis._registered')
    @else
        @include('penulis._active')
    @endif
@endsection
