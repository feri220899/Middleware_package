@extends('..layout.layoutLogin')
@section('title', 'Login')

@section('konten')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Admin</b>LTE</a>
            </div>
            @if($errors->has('email'))
                {{-- Dari ForgetpassController --}}
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Info!</h5> {{$errors->first('email')}}
                </div>
            @else
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            @endif
            <div class="card-body">
                <form action="{{route('password.update')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                        <input type="text" name="token" hidden value="{{request()->token}}">
                        <input type="text" name="email" hidden value="{{request()->email}}">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{url('/login')}}">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
