@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')
<!-- Container principal do formulário -->
<div class="container" id="form-container">
    <!-- Estabelece o metodo post e a rota de action do formulário -->
    <form action="{{route('site.formulario.post')}}" method="post">
        @csrf
        @method('POST')
        <!-- Verificador da mensagem de sucesso -->
        @if(session('message'))
        <div class="success">
            {{session('message')}}
        </div>
        @endif
        <!-- Inputs do formulário -->
        <label for="name">Nome: </label> <br>
        <select name="name" id="name" class="form-box">
        <option value="Selecione"> </option>
            @foreach ($colaboradores as $colaborador)
            <option value="{{ $colaborador->nome }}">{{ $colaborador->nome }}</option>
            @endforeach
        </select>
        </select> <br><br>

        <label for="email">E-mail: </label><br>
        <input type="email" placeholder="Ex: nome.sobrenome@cnm.org.br" class="form-box" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="matricula">Matricula: </label><br>
        <input type="text" placeholder="Digite os 3 números da matrícula" class="form-box" id="matricula" name="matricula" value="{{ old('matricula') }}" maxlength="3" required>
        @error('matricula')
        <div class="erro">{{ $message }}</div>
        @enderror<br><br>

        <label for="setor">Setor: </label><br>
        <select name="setor" id="setor" class="form-box" required>
            <option value="Selecione">Selecione o setor</option>
            @foreach ($setores as $setor)
            <option value="{{ $setor->nome }}">{{ $setor->nome }}</option>
            @endforeach
        </select>
        <br><br>

        <label for="status">Status: </label>
        <select name="status" id="status" required>
            <option value="pendente">Pendente</option>
            <option value="concluido">Concluido</option>
        </select><br><br>

        <hr><br>

        <input type="submit" class="enviar">
    </form>
</div>

@endsection