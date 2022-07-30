@extends("layouts.app")
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5>Criar Novo Curso</h5>
          <a href="{{ url('cursos') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i>Voltar
          </a>
        </div>
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $item)
              <p class="text-danger">{{ $item }}</p>
            @endforeach
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{ session()->get('success') }}
            </div>
          @endif
          <form action="{{ url('cursos') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-2">
              <input 
                type="text" 
                class="form-control" 
                id="name"
                name="name"
                required
                placeholder="Nome"
                value="{{ old('name') }}"
              >
              <label for="name">Nome</label>
            </div>
            <div class="form-floating mb-2">
              <textarea 
                class="form-control" 
                placeholder="Leave a comment here" 
                id="description"
                name="description"
                style="height: 150px; resize: none"
              >{{ old('description') }}</textarea>
              <label for="description">Descrição</label>
            </div>
            <div class="form-floating mb-2">
              <input 
                type="number" 
                class="form-control" 
                id="subscribers_quantity"
                name="subscribers_quantity"
                required
                step="1"
                placeholder="subscribers quantity"
                value="{{ old('subscribers_quantity') }}"
              >
              <label for="subscribers_quantity">Quantidade de inscritos</label>
            </div>
            <div class="form-floating mb-2">
              <input 
                type="number" 
                class="form-control" 
                id="price"
                name="price"
                step="0.5"
                required
                placeholder="Preço"
                value="{{ old('price') }}"
              >
              <label for="price">Preço</label>
            </div>
            <div class="input-group mb-2">
              <span class="input-group-text">Data de Início</span>
              <input 
                type="date" 
                class="form-control" 
                name="start_date"
                required
                value="{{ old('start_date') }}"
              >
            </div>
            <div class="input-group mb-2">
              <span class="input-group-text">Data de Fim</span>
              <input 
                type="date" 
                class="form-control" 
                name="end_date"
                required
                value="{{ old('end_date') }}"
              >
            </div>
            <div class="input-group mb-4">
              <input 
                type="file" 
                class="form-control" 
                id="file"
                name="file"
                required
              >
              <button class="btn btn-outline-secondary" type="button" id="file">Adicionar Arquivo</button>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Curso</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection