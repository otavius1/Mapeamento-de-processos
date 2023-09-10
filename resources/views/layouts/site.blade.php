<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGPD - CNM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="css/path/font-awesome/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

@auth
<header>
    <!-- <div class="back-button-container">
        <button onclick="goBack()" class="back-button">
            <i class="fa fa-arrow-left"></i> Voltar
        </button>
    </div> -->
    <nav class="nav-bar">
        <div class="nav-list"></div>
        <ul class="nav-list">
            <li class="nav-item"><a href="/dashboard" class="nav-link">Inicial</a></li>
            <li class="nav-item"><a href="{{ route('site.table') }}" class="nav-link">Tabela</a></li>
            <li class="nav-item"><a href="{{ route('site.formulario') }}" class="nav-link">Cadastrar</a></li>
            <li class="nav-item"><a href="{{ route('site.usuarios') }}" class="nav-link">Usuarios</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();" class="nav-link">
                        Logout
                    </a>
                </form>
            </li>
        </ul>
        </div>
        <div class="mobile-menu-icon">
            <button onclick="menuShow()"><img class="icon" src="{{asset('images/menu_white_36dp.svg')}}" alt="menu-sanduiche"></button>
        </div>
    </nav>

    <div class="mobile-menu">
        <ul class="nav-list">
            <li class="nav-item"><a href="/dashboard" class="nav-link">Inicial</a></li>
            <li class="nav-item"><a href="{{ route('site.table') }}" class="nav-link">Tabela</a></li>
            <li class="nav-item"><a href="{{ route('site.formulario') }}" class="nav-link">Cadastrar</a></li>
            <li class="nav-item"><a href="{{ route('site.usuarios') }}" class="nav-link">Usuarios</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();" class="nav-link">
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>

</header>


<body>
    <div class="back-button-container">
        <button onclick="goBack()" class="back-button">
            <i class="fa fa-arrow-left"></i> Voltar
        </button>
    </div>
    @yield('content')
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    // var selectElements = document.querySelectorAll('select');
    // var checkboxContainers = document.querySelectorAll('.checkbox-list');

    function menuShow() {

        let menuMobile = document.querySelector('.mobile-menu');

        if (menuMobile.classList.contains('open')) {
            menuMobile.classList.remove('open');
            document.querySelector('.icon').src = "images/menu_white_36dp.svg"
        } else {
            menuMobile.classList.add('open');
            document.querySelector('.icon').src = "images/close_white_36dp.svg"
        }
    }

    function mostrarCheckbox() {
        var checkboxes = document.getElementById("checkboxes");
        var mostrar = document.getElementById("dados");

        if (mostrar.checked) {
            checkboxes.style.display = "block";
        } else {
            checkboxes.style.display = "none";
        }
    }

    $(document).ready(function() {
        $('#sistemas, #bases, #dados').select2({
            tags: true,
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    isNew: true
                };
            }
        });

        $('#sistemas, #bases, #dados').on('select2:select', function(e) {
            var data = e.params.data;
            if (data.isNew) {
                console.log('Nova opção selecionada: ' + data.text);
                // Faça a validação da nova opção aqui
            }
        });
    });


    function goBack() {
        window.history.back();
    }
</script>

</html>
@endauth