@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')
<div name="processos-lista" class="processos-lista">
    <h1 style="text-align: center;"> {{ $collab->name }} </h1>
    <!-- <form action="{{ route('site.processos.search') }}" method="GET" class="search-form">
        <input type="text" name="parameter" placeholder="Pesquisar..." class="search-box">
        <button type="submit" class="search-button">Buscar</button>
    </form> -->

    <table class="table-pro">
        <thead>
            <tr>
                <th>Processo</th>
                <th>Descrição</th>
                <th>Sistemas</th>
                <th>Sensíveis</th>
                <th>Tempo</th>
                <th>Bases</th>
                <th>Dados</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processos as $processo)
            <tr>
                <td> {{ $processo->processo }} </td>
                <td> {{ $processo->descricao }} </td>
                <td>
                    @if (is_string($processo->sistemas))
                    {{ $processo->sistemas }}
                    @endif
                </td>
                <td> {{ $processo->sensiveis }} </td>
                <td> {{ $processo->tempo }} </td>
                <td>
                    @if (is_string($processo->bases))
                    {{ $processo->bases }}
                    @endif
                </td>
                <td>
                    @if (is_string($processo->dados))
                    {{ $processo->dados }}
                    @endif
                </td>

                <td>
                    <form action="{{ route('site.processos.edit', ['id' => $collab->id, 'pid' => $processo->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" title="Editar" style="color: blue">
                            Editar
                        </button>
                    </form>
                    <form action="{{ route ('site.processos.destroy', ['id' => $processo->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" title="Excluir" style="color: red">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection