@extends('layouts.app') 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Sistema de Cursos</div>
        <div class="card-body">
          @if (Auth::user()->type === "Usuário")
            <p>
              Você {{ Auth::user()->student->category }}, {{ Auth::user()->name }} está inscrito nos seguintes cursos:
            </p>
            @forelse (Auth::user()->student->purchases->sortDesc() as $purchase)
              <p class="fw-bold h3">{{ $purchase->course->name }}</p>
              <p class="h5">Descrição: </p>
              <p>{{ $purchase->course->description }}</p>
              <p>Valor: R${{ $purchase->course->price }}</p>
              @if ($purchase->paid_out)
                <a 
                  href="{{ asset($purchase->course->file_name) }}" 
                  class="btn btn-primary mb-4"
                  target="blank"
                >
                  Accessar material do curso
                </a>
              @else
                <p class="text-danger">Realize o pagamento para ter acesso ao material do curso</p>
                <a 
                  href="{{ route('boleto', $purchase->id) }}"
                  class="btn btn-primary mb-4"
                >
                  Pagar via boleto
                </a>
              @endif
            @empty
              <p class="text-danger fw-bold fs-5">Você não possui nenhum curso</p>
            @endforelse
          @else
            <a href="{{ url('cursos') }}" class="btn btn-primary">
              Acessar aba de Cursos
            </a>
            <br>
            <a href="{{ url('alunos') }}" class="btn btn-primary mt-2">
              Acessar aba de Alunos
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
