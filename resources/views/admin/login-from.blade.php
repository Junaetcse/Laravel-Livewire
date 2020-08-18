@extends('admin.layout')
@section('content')

<section class="registration-section">
    <div class="container" style="width: 400px;">
      <h2 class="text-center" style="font-size: 40px;margin-bottom: 0px;color: black;">Contest Manager</h2>
      <p class="text-center"  style="font-size: 20px; margin-bottom: 30px;color: black;">Admin Login</p>
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login_input_style" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login_input_style" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg ml-auto d-block" style="width: 100%; border-radius: 10px; background: #00B050; margin-top: 30px;">
                    {{ __('Login') }}
                </button>
        </div>
    </form>
    </div>
  </section>
@stop