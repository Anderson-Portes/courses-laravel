<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relatório do estudante</title>
  </head>
  <body>
    <h1>Relatório do estudante <b>{{ $student->user->name }}</b></h1>
    <p>Data do relatório: {{ date('d/m/Y') }}</p>
    <table>
      <thead>
        <th>Curso</th>
        <th>Preço</th>
        <th>Pago</th>
        <th>Status</th>
        <th>Data da inscrição</th>
        <th>Data de pagamento</th>
      </thead>
      <tbody>
        @forelse ($student->purchases as $purchase)
          <tr>
            <td>{{ $purchase->course->name }}</td>
            <td>R$ {{ $purchase->course->price }}</td>
            <td>R$ {{ $purchase->purchase_price }}</td>
            <td>@if($purchase->paid_out) Pago @else Não pago @endif</td>
            <td>
              {{ $purchase->created_at->format('d/m/Y') }}
            </td>
            <td>
              @if ($purchase->purchase_date)
                {{ date('d/m/Y', strtotime($purchase->purchase_date)) }}
              @else
                Não pago
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-danger fw-bold">Este aluno não possui nenhum curso</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </body>
</html>
