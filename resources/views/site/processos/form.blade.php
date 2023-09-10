@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')

<form action="{{route('processos.post')}}" method="post" class="container">
    @csrf
    @method('POST')

    <input type="hidden" name="collaborator_id" value="{{ $collaborator->id }}">

    <h3>{{ $collaborator->name }}</h3> <br>
    <hr><br>

    <label for="processos">Nome do processo: </label> <br>
    <input type="text" id="processo" name="processo" class="form-box" required>
    @error('processo')
    <div class="erro">{{ $message }}</div>
    @enderror
    <br> <br>

    <label for="descricao">Descrição do processo: </label><br>
    <textarea id="descricao" name="descricao" cols="36" rows="20" class="descricao" value=" " required></textarea>
    @error('descricao')
    <div class="erro">{{ $message }}</div>
    @enderror
    <br><br>

    <label for="sistemas">Sistema </label><br>
    <select name="sistemas[]" id="sistemas" class="form-box" multiple required>
        <!-- @isset($sistemas) -->
        @foreach ($sistemas as $sistema)
            <option value="{{ $sistema->nome }}">{{ $sistema->nome }}</option>
        @endforeach
        <!-- @endisset -->
    </select>
    <br><br>

    <label for="sensiveis">Há dados sensíveis? </label>
    <select name="sensiveis" id="sensiveis">
        <option value="sim">Sim</option>
        <option value="nao">Não</option>
    </select> <br><br>

    <label for="tempo">Tempo de armazenamento:</label>
    <input type="text" name="time_number" id="time_number" style="width: 30px;" value="0">
    <select name="time_unit" id="time_unit" style="width: 60px;">
        <option value="dias">Dias</option>
        <option value="semanas">Semanas</option>
        <option value="meses">Meses</option>
        <option value="anos">Anos</option>
    </select> <br><br>

    <label for="dados">Dados:</label> <br>
    <select name="dados[]" id="dados" class="form-box" multiple>
        <!-- @isset($dados) -->
        @foreach ($dados as $dado)
        <option value="{{ $dado->nome }}">{{ $dado->nome }}</option>
        @endforeach
        <!-- @endisset -->
    </select>
    <br><br>

    <label for="bases">Bases legais de armazenamento</label> <br>
    <select id="bases" name="bases[]" class="form-box" multiple>
        <!-- @isset($bases) -->
        @foreach ($bases as $base)
        <option value="{{ $base->nome }}">{{ $base->nome }}</option>
        @endforeach
        <!-- @endisset -->
    </select>
    <br><br>
    <hr><br>

    <input type="submit" class="enviar"> <br><br>
</form>
@endsection