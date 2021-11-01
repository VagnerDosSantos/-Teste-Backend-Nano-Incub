@extends('templates.login')

@section('conteudo')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="row white z-depth-2 max-width-50" style="width: 45%; padding: 15px;">
            <div class="col s12 center-align">
                <img src="{{ asset('imagens/nano.jpg') }}" alt="logo">
                <h6>Painel Administrativo</h3>
                    <hr>
            </div>

            <div class="input-field col s12" style="margin-top: 25px;">
                <input type="text" name="login" id="login" placeholder="Digite seu usuário" required>
                <label for="login">Login</label>
            </div>

            <div class="input-field col s12">
                <input type="password" name="password" id="senha" placeholder="Digite sua senha" required>
                <label for="senha">Senha</label>
            </div>

            <div class="input-field col s12 right-align">
                <button type="submit" class="btn btn-small green accent-4">
                    <i class="material-icons right">send</i> Entrar
                </button>
            </div>
        </div>
    </form>
@endsection
