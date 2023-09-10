@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')

<div name="processos-lista">
    <h3>Lista de processos:</h3>
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
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processos as $processo)
            <tr>
                <td> {{ $processo->processo }} </td>
                <td> {{ $processo->descricao }} </td>
                <td> {{ $processo->sistemas }} </td>
                <td> {{ $processo->sensiveis }} </td>
                <td> {{ $processo->tempo }} </td>
                <td> {{ $processo->bases }} </td>
                <td> {{ $processo->dados }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="color: green; margin-top: 8px; font-size: 32px;">Os dados foram atualizados com sucesso!</p>
</div>


<br><br>

<input type="submit" class="enviar" value="Atualizar" id="done" name="submit"> <br><br>
</form>
</div>