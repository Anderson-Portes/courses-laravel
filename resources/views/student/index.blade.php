@extends("layouts.app")
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5>Gerenciamento dos Alunos</h5>
          <a href="{{ url('alunos/create') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus me-1"></i>Adicionar Aluno
          </a>
        </div>
        <div class="card-body">
          @if (session()->has('success'))
            <div class="alert alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{ session()->get('success') }}
            </div>
          @endif
          <div class="mb-2">
            <input type="text" name="search" class="form-control w-25 d-inline" placeholder="Pesquisar">
            <select class="form-select d-inline" id="category" required name="category" style="width: 130px">
              <option value="" selected class="d-none">Categoria</option>
              <option value="">Todos</option>
              <option value="Estudante">Estudante</option>
              <option value="Profissional">Profissional</option>
              <option value="Associado">Associado</option>
            </select>
          </div>
          <table class="table table-hover table-borderless">
            <thead>
              <th scope="col">Inscrito</th>
              <th scope="col">Data de Inscrição</th>
              <th scope="col">Categoria</th>
              <th scope="col">CPF</th>
              <th scope="col">Email</th>
              <th scope="col">UF</th>
              <th scope="status">Cursos</th>
              <th scope="col">Total</th>
              <th></th>
            </thead>
            <tbody>
              @forelse ($students as $item)
                <tr class="table-row">
                  <td class="row-name">{{ $item->user->name }}</td>
                  <td class="row-date">{{ $item->created_at->format('d/m/Y') }}</td>
                  <td class="row-category">{{ $item->category }}</td>
                  <td>{{ $item->cpf }}</td>
                  <td>{{ $item->user->email }}</td>
                  <td>{{ $item->address->state }}</td>
                  <td class="row-status">
                    <a href="{{ route('student.purchases', $item->id) }}" class="btn btn-sm btn-primary">
                      Ver cursos
                    </a>
                  </td>
                  <td>
                    R$
                  </td>
                  <td>
                    <a href="{{ url('alunos/'.$item->id.'/edit') }}" class="btn btn-sm btn-outline-success">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ url('alunos/'.$item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button 
                        type="submit" 
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Deseja excluir esse aluno?')"
                      >
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td>Nenhum aluno disponível</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <a class="btn btn-success btn-sm" href="{{ url('pdf') }}">Exportar PDF</a>
          <a class="btn btn-success btn-sm" href={{ route('excel') }}>Exportar XLS</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const categorySelect = document.getElementById('category')
  const searchInput = document.querySelector('input[name=search]')

  categorySelect.onchange = () => searchStudent()
  searchInput.onkeyup = () => searchStudent()

  function searchStudent() {
    const category = categorySelect.value
    const search = searchInput.value
    const rows = document.querySelectorAll('.table-row')

    for (let i = 0; i < rows.length; i++) {
      const rowCategory = rows[i].querySelector('.row-category').textContent
      const rowName = rows[i].querySelector('.row-name').textContent
      const rowDate = rows[i].querySelector('.row-date').textContent

      if(rowCategory.includes(category)) {
        if(rowName.includes(search) || rowDate.includes(search))
          rows[i].classList.remove('d-none')
        else
          rows[i].classList.add('d-none')
      } else {
        rows[i].classList.add('d-none')
      }
    }
  }
</script>
@endsection