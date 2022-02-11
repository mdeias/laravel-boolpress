@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        
        <h1>Errore 404</h1>
        <h3>pagina non trovata</h3>
        <p>{{ $exception->getMessage() }}</p>
          
    </div>
</div>
@endsection