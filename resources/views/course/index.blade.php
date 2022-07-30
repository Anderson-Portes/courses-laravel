@extends("layouts.app")
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h5>Gerenciamento dos Cursos</h5>
          <a href="{{ url('cursos/create') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus me-1"></i>Adicionar Curso
          </a>
        </div>
        <div class="card-body">
          @if (session()->has('sucess'))
            <div class="alert alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{ session()->get('success') }}
            </div>
          @endif
          <table class="table table-hover table-borderless">
            <thead>
              <th scope="col">Curso</th>
              <th scope="col">Preço</th>
              <th scope="col">Vagas</th>
              <th>Inscritos</th>
              <th></th>
            </thead>
            <tbody>
              @forelse ($courses as $item)
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>R$ {{ $item->price }}</td>
                  <td>{{ $item->subscribers_quantity }}</td>
                  <td>{{ $item->current_subscribers }}</td>
                  <td>
                    <a href="{{ url('cursos/'.$item->id.'/edit') }}" class="btn btn-sm btn-outline-success">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ url('cursos/'.$item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button 
                        type="submit" 
                        class="btn btn-sm btn-outline-danger" 
                        onclick="return confirm('Deseja excluir o curso?')"
                      >
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td>Nenhum Curso Disponível</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection