<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Site</title>
  </head>
  <body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <table class="table table-hover table-borderless">
      <thead>
        <th scope="col">Inscrito</th>
        <th scope="col">Data de Inscrição</th>
        <th scope="col">Categoria</th>
        <th scope="col">CPF</th>
        <th scope="col">Email</th>
        <th scope="col">UF</th>
        <th scope="status">Status</th>
        <th scope="col">Total</th>
      </thead>
      <tbody>
        @forelse ($students as $item)
        <tr class="table-row">
          <td class="row-name">{{ $item->user->name }}</td>
          <td class="row-date">{{ $item->created_at->format('d/m/Y') }}</td>
          <td class="row-category">Estudante</td>
          <td>{{ $item->cpf }}</td>
          <td>{{ $item->user->email }}</td>
          <td>{{ $item->address->state }}</td>
          <td class="row-status">Não pago</td>
          <td>
            R$
            @php
              $price = 0;
              foreach ($item->courses as $course) {
                $price += $course->price;
              }
              echo $price;
            @endphp
          </td>
        </tr>
        @empty
        <tr>
          <td>Nenhum aluno disponível</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </body>
</html>
