@extends('layouts.site')

@section('content')
<style>
    .system-label {
        font-weight: bold;
    }

    .system-value {
        margin-left: 10px;
    }
</style>

<div class="container">
    <h1>Dados Atualizados</h1>

    <p><strong>Nome:</strong> {{ $collab->name }}</p>
    <p><strong>E-mail:</strong> {{ $collab->email }}</p>
    <p><strong>Matrícula:</strong> {{ $collab->matricula }}</p>
    <p><strong>Setor:</strong> {{ ucfirst($collab->setor) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($collab->status) }}</p>
    
    <p style="color: green; margin-top: 8px; font-size: 32px;">Os dados foram atualizados com sucesso!</p>
</div>

@endsection


