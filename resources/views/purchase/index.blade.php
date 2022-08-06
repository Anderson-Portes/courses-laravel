@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h5>Cursos do aluno <b>{{ $student->user->name }}</b></h5>
          <a href="{{ url('alunos') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i>Voltar a lista de alunos
          </a>
        </div>
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p class="text-danger fw-bold">{{ $error }}</p>
            @endforeach
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{ session()->get('success') }}
            </div>
          @endif
          <form action="{{ route('student.purchases.store', $student->id) }}" method="POST">
            @csrf
            <select class="form-select w-25 d-inline" required name="course_id">
              @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Adicionar curso</button>
          </form>
          <table class="table table-hover table-borderless mt-4">
            <thead>
              <th>Curso</th>
              <th>Preço</th>
              <th>Pago</th>
              <th>Status</th>
              <th>Data da inscrição</th>
              <th>Data de pagamento</th>
              <th></th>
            </thead>
            <tbody>
              @forelse ($student->purchases as $purchase)
                <tr>
                  <td>{{ $purchase->course->name }}</td>
                  <td>R$ {{ $purchase->course->price }}</td>
                  <td>R$ {{ $purchase->price }}</td>
                  <td>
                    <form action="{{ route('student.purchases.update', $purchase->id) }}" method="post">
                      @csrf
                      @method("PUT")
                      <button type="submit" class="btn btn-sm">
                        @if($purchase->paid_out) Pago @else Não pago @endif
                      </button>
                    </form>
                  </td>
                  <td>
                    {{ $purchase->created_at->format('d/m/Y') }}
                  </td>
                  <td>
                    {{ $purchase->updated_at->format('d/m/Y') }}
                  </td>
                  <td>
                    <form action="{{ route('student.purchases.destroy', $purchase->id) }}" method="post">
                      @csrf
                      @method("DELETE")
                      <button 
                        type="submit" 
                        class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Deseja excluir essa compra?')"
                      >
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-danger fw-bold">Este aluno não possui nenhum curso</td>
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