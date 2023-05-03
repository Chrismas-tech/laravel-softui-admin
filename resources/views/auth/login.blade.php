@extends('auth.layouts.base-guest')
@section('title')
    Login
@endsection
@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-7 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Login</h3>
                                    {{--  <p class="mb-0">Enter your email and password to sign in</p> --}}
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}" role="form">
                                        @csrf
                                        @if ($errors->any())
                                            <div class='alert alert-warning text-white text-sm p-2' role="alert">
                                                <div class="font-weight-bold">{{ __('Whoops! Something went wrong.') }}
                                                </div>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                name="email" required value="{{ old('email') ? old('email') : 'admin@gmail.com' }}" placeholder="Email" >
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                placeholder="secret" type="password" name="password" placeholder="Password"
                                                required autocomplete="current-password"
                                                value="secret">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="remember_me"
                                                name="remember">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Forgot your password?
                                        @if (Route::has('password.request'))
                                            <a class="text-info text-gradient font-weight-bold"
                                                href="{{ route('password.request') }}">
                                                {{ __('Click here') }}
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-5">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
