@extends('layouts.site')

@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest

@section('content')
<form action="{{ route('site.usuarios.search') }}" method="GET" class="search-form">
    <input type="text" name="parameter" placeholder="Pesquisar..." class="search-box">
    <button type="submit" class="search-button">Buscar</button>
</form>

<!-- cabeçalhos da tabela-->
<table class="collabs-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>

    <!-- retorna os resultados das pesquisas realizadas na caixa de pesquisa acima da tabela -->
    <tbody>
        @if ($users->count() > 0)
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('site.usuarios.edit', ['id' => $user->id]) }}" method="POST" style="display: inline-block;">
                            @csrf 
                            @method('PUT')
                            <button type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: rgb(11, 180, 247)" title="Editar"></i></button>
                        </form>
                        <form id="deleteForm_{{ $user->id }}" action="{{ route('site.usuarios.destroy', ['users' => $user->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirmDelete(event, {{ $user->id }})" type="submit"><i class="fa fa-trash-o" aria-hidden="true" style="color: red" title="Excluir"></i></button>
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
        if (!confirm("Tem certeza de que deseja excluir este usuário?")) {
            event.preventDefault(); // Impede o envio do formulário se o usuário cancelar
            return false;
        }
        return true;
    }
</script>

@endsection