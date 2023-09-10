@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')
<!--Cria nessa view a caixa de pesquisa e botão de ação-->
<form action="{{ route('site.table.search') }}" method="GET" class="search-form">
    <input type="text" name="parameter" placeholder="Pesquisar..." class="search-box">
    <button type="submit" class="search-button">Buscar</button>
</form>

<!-- cabeçalhos da tabela -->
<table class="collabs-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Matricula</th>
            <th>Setor</th>
            <th>Status</th>
            <th>Processos</th>
            <th>Dados Sensíveis?</th>
            <th>Sistemas</th>
            <th>Ações</th>
        </tr>
    </thead>

    <!-- retorna os resultados das pesquisas realizadas na caixa de pesquisa acima da tabela -->
    <tbody>
        @if ($collabs->count() > 0)
        @foreach ($collabs as $collab)
        <tr>
            <td><a href="{{ route('site.table.show', ['id' => $collab->id]) }}">{{ $collab->name }}</a></td>
            <td>{{ $collab->email }}</td>
            <td>{{ $collab->matricula }}</td>
            <td>{{ ucfirst($collab->setor) }}</td>
            <td>{{ ucfirst($collab->status) }}</td>
            <td>
                @foreach ($collab->processos as $index => $processo)
                {{ ucfirst($processo->processo) }}
                @if ($index < count($collab->processos) - 1)
                    <hr>
                    @endif
                    @endforeach
            </td>
            <td>
                @foreach ($collab->processos as $index => $processo)
                {{ ucfirst($processo->sensiveis) }}
                @if ($index < count($collab->processos) - 1)
                    <hr>
                    @endif
                    @endforeach
            </td>
            <td>
                @foreach ($collab->processos as $index => $processo)
                    @foreach (explode(',', $processo->sistemas) as $sysIndex => $sistema)
                        {{ ucfirst(trim($sistema)) }}
                        @if ($sysIndex < count(explode(',', $processo->sistemas)) - 1)
                            ,
                        @endif
                    @endforeach
                    @if ($index < count($collab->processos) - 1)
                        <hr>
                    @endif
                @endforeach
            </td>

            <td>
                <form action="{{ route('site.table.edit', ['id' => $collab->id]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: rgb(11, 180, 247)" title="Editar"> Editar </i>
                    </button>
                </form>
                <form id="deleteForm_{{ $collab->id }}" action="{{ route('site.table.destroy', ['collab' => $collab->id]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="confirmDelete( event, {{ $collab->id }} )" type="submit">
                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red" title="Excluir"> Excluir </i>
                    </button>
                </form>
                <a href="{{ route('processos.form', ['collaboratorId' => $collab->id]) }}" title="Adicionar Processo">
                    <button>
                        <i class="fa fa-plus" aria-hidden="true"> Adicionar Processo </i>
                    </button>
                </a>
                <form action="{{ route('site.processos.list', ['id' => $collab->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" title="Editar Processos">
                        <i class="fa fa-pencil" aria-hidden="true"> Editar Processos </i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7">Nenhum resultado encontrado.</td>
        </tr>
        @endif

    </tbody>
</table>

<script>
    function confirmDelete(event, id) {
        if (!confirm("Tem certeza de que deseja excluir este colaborador?")) {
            event.preventDefault(); // Impede o envio do formulário se o usuário cancelar
            return false;
        }
        return true;
    }
</script>

@endsection