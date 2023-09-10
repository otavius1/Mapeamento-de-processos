@extends('layouts.site')

@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest


@section('content')
    <div class="contador">
      <h1>Formulários Preenchidos: </h1> <br> <br>
      <div class="contador-digitos" id="digito">{{ $total }}</div>
    </div>
    <!-- <p>CHART-JS</p> -->
    <!-- <br> -->

    <div class="container-dash">
      <div class="quadro">
        
      </div>
    </div>

    <script>

    </script>
@endsection