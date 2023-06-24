@extends('landingpage.layout.main')

@section('container')

    <div class="container pt-5">
        <h1 class="text-center fw-bold pt-5">Kebijakan Privasi</h1>
        @foreach ($data as $privacy)
           <h1> {{ $privacy->tittle }} </h1>
           <p> {!! $privacy->body !!} </p> 
        @endforeach
    </div>

    
    
    
@endsection