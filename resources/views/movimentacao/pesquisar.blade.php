@extends('templates.app')

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <i class="material-icons left">search</i> Pesquisar Movimentações
        </div>

        <div class="card-body">
            <form>
                <div class="row">
                    @csrf
                    <div class="input-field col s12 m8">
                        <label for="nome">Pesquisa Rápida</label>
                        <input type="text" name="nome" value="{{ Request()->nome }}" id="nome"
                            placeholder="Digite o nome do funcionário que deseja pesquisar a movimentação"
                            class="validate">
                    </div>

                    <div class="input-field col s6 m2">
                        <select name="tipo" id="tipo">
                            <option value="">Escolha o tipo</option>
                            <option value="entrada" {{ Request()->tipo == 'entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="saida" {{ Request()->tipo == 'saida' ? 'selected' : '' }}>Saída</option>
                        </select>
                        <label for="tipo">Tipo</label>
                    </div>

                    <div class="input-field col s6 m2">
                        <input type="date" name="data" value="{{ Request()->data }}" class="validate" id="data">
                        <label for="data">Data</label>
                    </div>

                    <div class="input-field col s12 right-align">
                        <button type="submit" class="btn btn-small waves-effect waves-light green accent-4">Aplicar
                            filtro</button>
                        @can('create', App\Models\Movimentacao::class)
                            <a class="btn btn-small waves-effect waves-light blue accent-4"
                                href="{{ route('movimentacao.funcionarios') }}">Nova Bonificação</a>
                        @endcan
                    </div>
                </div>
            </form>
        </div>

        <table class="card-body responsive-table highlight">
            <thead>
                <tr>
                    <th class="center-align largura-minima">ID</th>
                    <th class="center-align largura-minima">Tipo</th>
                    <th>Nome</th>
                    <th>Observação</th>
                    <th class="center-align largura-minima">Valor</th>
                    <th class="center-align nowrap largura-minima">Data</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dados as $movimentacao)
                    <tr class="{{ $movimentacao->tipo_movimentacao == 'entrada' ? 'green' : 'red' }} lighten-3">
                        <td class="center-align">{{ $movimentacao->id }}</td>
                        <td>{{ $movimentacao->tipo_movimentacao == 'entrada' ? 'Entrada' : 'Saída' }}</td>
                        <td class="nowrap">{{ $movimentacao->funcionario->nome_completo }}</td>
                        <td>{{ $movimentacao->observacao }}</td>
                        <td class="nowrap">R$ {{ number_format($movimentacao->valor, 2, ',', '.')  }}</td>
                        <td class="nowrap">{{ date('d-m-Y H:i:s', strtotime($movimentacao->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dados->withQueryString()->links() }}
    </div>
@endsection
