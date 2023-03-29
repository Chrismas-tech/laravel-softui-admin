@extends('auth.layouts.base-guest')
@section('title')
    Register
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-10 col-lg-8 my-4">

                <div class="card shadow-sm px-1 mx-4">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class='alert alert-danger text-sm p-2' role="alert">
                                <div class="font-weight-bold">{{ __('Whoops! Something went wrong.') }}</div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label>Name</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"" type="text"
                                    name="name" required autofocus="autofocus" autocomplete="name"
                                    value={{ old('name') }}>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Email</label>

                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    name="email" required value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    type="password" name="password" required autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                    type="password" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                        <label class="custom-control-label" for="terms">
                                            I agree to the <a target="_blank" href="{{ route('terms-of-service') }}">Terms
                                                of
                                                Service</a> and <a target="_blank"
                                                href="{{ route('privacy-policy') }}">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-0">
                                <div class="d-flex justify-content-end align-items-baseline">
                                    <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                        Already registered?
                                    </a>

                                    <button type="submit" class="btn btn-dark text-uppercase">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
