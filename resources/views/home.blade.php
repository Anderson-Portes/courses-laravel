@extends('layouts.app') 
@section('content')
<div class="container">
  @if (session()->has('success'))
    <div class="alert alert-success">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      {{ session()->get('success') }}
    </div>
  @endif
  <div class="row">
    @foreach ($courses as $course)
      <div class="col col-md-6 col-lg-4 mt-2">
      <div class="card">
        <img src="{{ asset($course->photo_name) }}" class="card-img-top img-responsive" alt="{{ $course->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $course->name }}</h5>
          <p class="card-text">
            {{ $course->description }}
          </p>
          @if (Auth::user()->type === "Usuário" && 
            !Auth::user()->student?->purchases?->firstWhere("course_id",$course->id)
          )
            <form action="{{ route('cart.store', $course->id) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-cart me-1"></i>Adicionar curso ao carrinho
              </button>
            </form>
          @else
            <p class="text-danger fw-bold">Você não pode comprar esse curso</p>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
