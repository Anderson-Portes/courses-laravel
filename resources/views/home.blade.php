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
              Você {{ Auth::user()->student->category }}, {{ Auth::user()->name }} está inscrito no curso
              "{{ Auth::user()->student->course->name }}"
            </p>
            <p class="fw-bold">Descrição do curso:</p>
            <p>
              {{ Auth::user()->student->course->description }}
            </p>
            <p class="fw-bold">Valor: R$ {{ Auth::user()->student->course->price }}</p>
            @if (Auth::user()->student->paid_out)
              <a 
                href="{{ asset(Auth::user()->student->course->file_name) }}"
                class="d-block"
                target="blank"
              >
                Acessar material do curso
              </a>
            @else
              <p class="text-danger fw-bold fs-6">Realize o pagamento para acessar o material do curso</p>
              <a 
                class="btn btn-primary mt-2"
                href="{{ route('boleto') }}"
                target="blank"
              >
                Pagar via boleto
              </a>
            @endif
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
