@extends('..layout.layoutLogin')
@section('title', 'Login')

@section('konten')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                @if (session('error'))
                    {{-- Dari LoginController --}}
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Peringatan!</h5>{{ session('error') }}
                    </div>
                @elseif(session('statusSuccsess'))
                    {{-- Dari ForgetpassController --}}
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Info!</h5>{{ session('statusSuccsess') }}
                    </div>
                @else
                    <p class="login-box-msg">Sign in to start your session</p>
                @endif
                <form action="{{ url('/mesinLogin') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="{{route('googleredirect')}}" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Continue With Google
                    </a>
                </div>
                <p class="mb-1">
                    <a href="{{ url('/forgetpassword') }}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>
@endsection
