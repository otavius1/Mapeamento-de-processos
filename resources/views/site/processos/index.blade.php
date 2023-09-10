@extends('layouts.site')

@guest
<script>
    window.location = "{{ route('login') }}";
</script>
@endguest

@section('content')

<script>
    window.location = "{{ route('dashboard') }}";
</script>

@endsection