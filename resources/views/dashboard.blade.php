@extends('templates.app')

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/home-card.css') }}">
    <div class="row">
        <div class="col s12 m6 l4 tooltip" data-tooltip="Total de funcionários cadastrados" tooltip-position="top">
            <div class="z-depth-2 home-card blue-gradient">
                <div class="result">
                    <div class="result-info center-align">
                        <span class="result-number">{{ $funcionarios->count() }}</span>
                        <div class="result-title">Funcionários</div>
                    </div>
                    <div class="result-icon">
                        <i class="material-icons result-icon-i right">groups</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l4 tooltip" data-tooltip="Saldo total dos funcionários" tooltip-position="top">
            <div class="z-depth-2 home-card purple-gradient">
                <div class="result">
                    <div class="result-info center-align">
                        <span
                            class="result-number formata">{{ number_format($funcionarios->sum('saldo_atual'), 2, ',', '.') }}</span>
                        <div class="result-title">Saldo</div>
                    </div>
                    <div class="result-icon">
                        <i class="material-icons result-icon-i right"
                            style="font-size: 120px; margin-top: 1px">point_of_sale</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l4 tooltip" data-tooltip="Total de bonificações concedidas no mês atual"
            tooltip-position="top">
            <div class="z-depth-2 home-card green-gradient">
                <div class="result">
                    <div class="result-info center-align">
                        <span
                            class="result-number formata">{{ number_format($funcionarios->sum('extrato_sum_valor'), 2, ',', '.') }}</span>
                        <div class="result-title">Bonificações</div>
                    </div>
                    <div class="result-icon">
                        <i class="material-icons result-icon-i right"
                            style="font-size: 120px; margin-top: 1px">emoji_events</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 white z-depth-2">
            <bar-chart></bar-chart>
        </div>
    </div>
@endsection
