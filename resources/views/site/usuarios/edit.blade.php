@extends('layouts.site')

@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest

@section('content')
<div class="container" id="form-container">
    <!-- Estabelece o método post e a rota de action do formulário -->
    <form action="{{ route('site.usuarios.update', ['id' => $users->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Verificador da mensagem de sucesso -->
        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Inputs do formulário -->
        <label for="name">Nome: </label><br>
        <input type="text" placeholder="Nome" class="form-box" id="name" name="name" autofocus value="{{ $users->name }}">
        @error('name')
            <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="email">E-mail: </label><br>
        <input type="email" placeholder="Ex: nome.sobrenome@cnm.org.br" class="form-box" id="email" name="email" value="{{ $users->email }}">
        @error('email')
            <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="password">Senha: </label><br>
        <input type="password" placeholder="Digite sua nova senha ou a anterior" class="form-box" id="password" name="password" minlength="8" required> <br><br>
        @error('senha')
            <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <input type="submit" class="enviar" value="Atualizar" id="done" name="submit">
    </form>
</div>
@endsection