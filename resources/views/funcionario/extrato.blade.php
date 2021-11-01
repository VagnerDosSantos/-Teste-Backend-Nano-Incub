@extends('templates.app')

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <i class="material-icons left">receipt_long</i> Extrato
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col s12">
                    <blockquote>
                        Todas as movimentações de entrada e saída do funcionário <b>{{ $dados->nome_completo }}</b> com
                        saldo de <b id="saldo">R${{ number_format($dados->saldo_atual, 2, ',', '.') }}</b> serão
                        exibidas aqui ordenado pelo registro mais recente!
                    </blockquote>
                </div>
            </div>
        </div>

        <table class="card-body responsive-table highlight">
            <thead>
                <tr>
                    <th class="center-align largura-minima">ID</th>
                    <th class="center-align largura-minima">Tipo</th>
                    <th>Observação</th>
                    <th class="center-align largura-minima">Valor</th>
                    <th class="center-align nowrap largura-minima">Data</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dados->extrato ?? [] as $movimentacao)
                    <tr class="{{ $movimentacao->tipo_movimentacao == 'entrada' ? 'green' : 'red' }} lighten-3">
                        <td class="center-align">{{ $movimentacao->id }}</td>
                        <td>{{ $movimentacao->tipo_movimentacao == 'entrada' ? 'Entrada' : 'Saída' }}</td>
                        <td>{{ $movimentacao->observacao }}</td>
                        <td class="nowrap">R$ {{ $movimentacao->valor }}</td>
                        <td class="nowrap">{{ date('d-m-Y H:i:s', strtotime($movimentacao->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="card-body">
            <div class="row">
                <div class="input-field col s12 right-align">
                    <a class="btn btn-small waves-effect waves-light red accent-4"
                        href="{{ route('funcionario.pesquisar') }}"><i class="material-icons left">arrow_back</i>
                        Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
