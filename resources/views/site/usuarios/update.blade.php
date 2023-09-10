@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

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

    <p><strong>Nome:</strong> {{ $users->name }}</p>
    <p><strong>E-mail:</strong> {{ $users->email }}</p>
    <p style="color: green; margin-top: 8px; font-size: 32px;">Os dados foram atualizados com sucesso!</p>
</div>

@endsection