@extends("layouts.app") 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5>Editar aluno</h5>
          <a href="{{ url('alunos') }}" class="btn btn-sm btn-outline-primary">
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
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
              {{ session()->get('success') }}
            </div>
          @endif
          <form
            action="{{ url('alunos/'.$student->id) }}"
            method="post"
            enctype="multipart/form-data"
          >
            @csrf
            @method("PATCH")
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                required
                placeholder="Nome"
                value="{{ $student->user->name }}"
              />
              <label for="name">Nome</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                required
                placeholder="Email"
                value="{{ $student->user->email }}"
              />
              <label for="email">Email</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="cpf"
                name="cpf"
                required
                minlength="11"
                maxlength="11"
                placeholder="phone"
                value="{{ $student->cpf }}"
              />
              <label for="cpf">CPF</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="phone"
                name="phone"
                placeholder="phone"
                value="{{ $student->phone }}"
              />
              <label for="phone">Celular</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="telephone"
                name="telephone"
                placeholder="telephone"
                value="{{ $student->telephone }}"
              />
              <label for="telephone">Telefone</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="company"
                name="company"
                autocomplete="company"
                placeholder="Empresa"
                value="{{ $student->company }}"
              />
              <label for="company">Empresa</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                autocomplete="new-password"
                placeholder="Senha"
              />
              <label for="password">Senha</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="password"
                class="form-control"
                id="password-confirm"
                name="password_confirmation"
                autocomplete="new-password"
                placeholder="Confirme Senha"
              />
              <label for="password-confirm">Confirme Senha</label>
            </div>
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="cep"
                name="cep"
                required
                autocomplete="new-password"
                placeholder="CEP"
                maxlength="8"
                value="{{ $student->address->cep }}"
              />
              <label for="password-confirm">CEP</label>
            </div>
            <div class="input-group mb-2">
              <input type="text" name="city" class="form-control" placeholder="Cidade" required 
                value="{{ $student->address->city }}">
              <input type="text" name="state" maxlength="2" minlength="2" placeholder="Estado" class="form-control" required
                value="{{ $student->address->state }}">
              <input type="text" name="district" class="form-control" placeholder="Bairro" required
                value="{{ $student->address->district }}">
            </div>
            <div class="input-group mb-2">
              <input type="text" name="complement" class="form-control" required placeholder="Logradouro"
                value="{{ $student->address->complement }}">
              <input type="text" name="number" class="form-control" required placeholder="Número"
                value="{{ $student->address->number }}">
            </div>
            <div class="input-group mb-2">
              <label class="input-group-text" for="category">Categoria</label>
              <select class="form-select" id="category" required name="category">
                @foreach (['Estudante', 'Profissional', 'Associado'] as $category)
                  <option 
                    value="{{ $category }}"
                    @if ($category === $student->category)
                      selected
                    @endif
                  >
                    {{ $category }}
                  </option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Editar Aluno</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const cepInput = document.getElementById('cep')

  cepInput.onkeyup = async () => {
    const cepValue = cepInput.value
    if(cepValue.length === 8) {
      const data = await fetch(`https://viacep.com.br/ws/${cepValue}/json/`)
      const json = await data.json()
      console.log(json)
      document.querySelector('input[name=state]').value = json.uf
      document.querySelector('input[name=city]').value = json.localidade
      document.querySelector('input[name=district]').value = json.bairro
      document.querySelector("input[name=complement]").value = json.logradouro
    }
  }
</script>
@endsection
