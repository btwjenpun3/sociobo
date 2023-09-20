@extends('Main Layouts.main')

@section('content')
    @if (!isset($name))
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Connect to your Twitter</h5>
                    <p class="mb-4">You need to login to your Twitter account for retrieve your data. </p>
                    <a class="btn btn-primary" href="{{ route('twitterUserAuthorize') }}"><i class="bi bi-twitter"></i> Login
                        to
                        Twitter</a>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">{{ $name }}</h5>
                </div>
            </div>
        </div>
    @endif
@endsection
