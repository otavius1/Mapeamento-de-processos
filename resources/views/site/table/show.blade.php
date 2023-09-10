@extends('layouts.site')

@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest

@section('content')
    <!-- <p> {{ $collab->name }} </p>
    <p> {{ $collab->matricula }} </p>
    <p> {{ ucfirst($collab->setor) }} </p>
    <p> {{ ucfirst($collab->status) }} </p>
    <br> -->
    <div name="processos-lista" class="processos-lista">
    <h2 style="text-align: center;"> {{ $collab->name }} </h2>
    <h3 style="text-align: center;"> {{ $collab->matricula }} </h3>
    <h3 style="text-align: center;"> {{ ucfirst($collab->setor) }} </h3>
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
                    <!-- <th>Ação</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($processos as $processo)
                <tr>
                        <td> {{ $processo->processo }} </td>
                        <td>{{ $processo->descricao }}</td>
                        <td>{{ $processo->sistemas }}</td>
                        <td>{{ $processo->sensiveis }}</td>
                        <td>{{ $processo->tempo }}</td>
                        <td>{{ $processo->bases }}</td>
                        <td>{{ $processo->dados }}</td>
                        <br><br>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection
