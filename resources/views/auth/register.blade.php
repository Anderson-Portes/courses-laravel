@extends('layouts.app') @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <p>OBS: Todo o usuário cadastrado nessa página sera um admnistrador, para que seja possível testar as funções desse tipo de usuário</p>
      <div class="card">
        <div class="card-header">Cadastrar</div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-floating mb-2">
              <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                placeholder="Nome"
              >
              <label for="name">Nome</label>
            </div>
            <div class="form-floating mb-2">
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="Email"
              >
              <label for="email">Email</label>
            </div>
            <div class="form-floating mb-2">
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password"
                required
                autocomplete="new-password"
                placeholder="Senha"
              >
              <label for="password">Senha</label>
            </div>
            <div class="form-floating mb-2">
              <input 
                type="password" 
                class="form-control" 
                id="password-confirm" 
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirme Senha"
              >
              <label for="password-confirm">Confirme Senha</label>
            </div>
            <input name="type" hidden value="Admin">
            <div class="form-check mb-4">
              <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember"
                />
              <label class="form-check-label" for="remember">Lembre de mim</label>
            </div>
            @if ($errors->any())
              @foreach ($errors->all() as $item)
                <p class="text-danger">{{ $item }}</p>
              @endforeach
            @endif
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
