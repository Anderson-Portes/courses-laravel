@extends('layouts.app') @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-2">
              <input
                type="email"
                class="form-control"
                id="floatingInput"
                name="email"
                placeholder="name@example.com"
                required
                value="{{ old('email') }}"
                autocomplete="email"
                autofocus
              />
              <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="password"
                class="form-control"
                id="floatingPassword"
                name="password"
                placeholder="Password"
                required
                autocomplete="current-password"
              />
              <label for="floatingPassword">Senha</label>
            </div>
            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox"
                name="remember" id="remember" {{ old('remember') ? 'checked' :
                '' }}>
              <label class="form-check-label" for="remember">Lembre de mim</label>
            </div>
            @error('email')
              <p class="text-danger">
                <strong>{{ $message }}</strong>
              </p>
            @enderror
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
