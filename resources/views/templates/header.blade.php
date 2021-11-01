<header>
    <nav class="grey darken-4">
        <a href="#" style="display: block;" data-target="slide-out" class="sidenav-trigger"><i class="material-icons"
                style="font-size: 40px;">menu</i>
        </a>
    </nav>

    <ul id="slide-out" class="sidenav collapsible">
        <li>
            <div class="user-view bg-gradient row">
                <div class="w-100">
                    <img class="circle display-center" src="{{ asset('imagens/nano.jpg') }}">
                </div>

                <div class="col s12 center-align"><span class="white-text name">Olá, {{ Auth()->user()->nome_completo }}!</span></div>
                <div class="col s12 center-align"><span class="white-text email">nano_incub@teste.com</span></div>
            </div>
        </li>
        <li>
            <a href="{{ route('home') }}"><i class="material-icons">home</i>Dashboard</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>

        <li>
            <a href="{{ route('funcionario.pesquisar') }}"><i class="material-icons">person</i>Funcionários</a>
        </li>

        <li>
            <a href="{{ route('movimentacao.pesquisar') }}"><i
                    class="material-icons">attach_money</i>Movimentações</a>
        </li>


        <li>
            <a href="{{ route('logout') }}"><i class="material-icons">logout</i>Sair</a>
        </li>
    </ul>
</header>
