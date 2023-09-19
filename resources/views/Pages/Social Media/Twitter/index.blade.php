@extends('Main Layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Connect to your Twitter</h5>
                <p class="mb-4">You need to login to your Twitter account for retrieve your data. </p>
                <a class="btn btn-primary" href="{{ route('loginTwitter') }}"><i class="bi bi-twitter"></i> Login to
                    Twitter</a>
            </div>
        </div>
    </div>
@endsection
