@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')
<div class="container" id="form-container">
    <!-- Estabelece o método post e a rota de action do formulário -->
    <form action="{{ route('site.table.update', ['id' => $collab->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <h3>{{ $collab->name }}</h3>
        <hr><br>
        <!-- Verificador da mensagem de sucesso -->
        @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif
        <!-- Inputs do formulário -->
        <label for="name">Nome: </label><br>
        <input type="text" placeholder="Nome" class="form-box" id="name" name="name" autofocus value="{{ $collab->name }}" required>
        @error('name')
        <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="email">E-mail Institucional: </label><br>
        <input type="email" placeholder="Ex: nome.sobrenome@cnm.org.br" class="form-box" id="email" name="email" value="{{ $collab->email }}" required>
        @error('email')
        <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="matricula">Matrícula: </label><br>
        <input type="text" placeholder="Digite os 3 números da matrícula" class="form-box" id="matricula" name="matricula" value="{{ $collab->matricula }}" maxlength="3">
        @error('matricula')
        <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="setor">Setor:</label><br>
        <select name="setor" id="setor" class="form-box" required>
            <option value="Selecione">Selecione o setor</option>
            @foreach ($setores as $setor)
            <option value="{{ $setor->nome }}">{{ $setor->nome }}</option>
            @endforeach
        </select> <br><br>

        <label for="status">Status: </label>
        <select name="status" id="status">
            <option value="pendente">Pendente</option>
            <option value="concluído">Concluído</option>
        </select><br><br>

        <hr><br>

        <input type="submit" class="enviar" value="Atualizar" id="done" name="submit"> <br><br>
    </form>
</div>

@endsection