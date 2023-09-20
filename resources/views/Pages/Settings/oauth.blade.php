@extends('Main Layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Twitter oAuth</h5>
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="oauth_token" class="form-label">oAuth Token</label>
                                    <input type="oauth_token" class="form-control" id="oauth_token" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="oauth_token_secret" class="form-label">oAuth Token Secret</label>
                                    <input type="oauth_token_secret" class="form-control" id="oauth_token_secret" disabled>
                                </div>
                                <a href="{{ route('authorizeTwitter') }}" class="btn btn-warning">Authorize</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
