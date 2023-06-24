@extends('admin.dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Kotak Masuk</h1>
</div>

<div class="container mt-5">
    
  
    
    <h2 class="mb-3">Nama: {{ $data->name}} </h2>
    <h4 class="mb-3">Email : {{ $data->email}}</h4>
    <p class="mt-3 fw-bold">No.Handphone : {{ $data->phone }} </p> 
    <p class="mt-3 fw-bold">Subyek : {{ $data->subject }} </p> 
    <p class="mt-3 fw-bold">Pesan : {{ $data->message }} </p> 
    <a href="/mail" class="btn btn-success"><span data-feather="arrow-left"></span>Kembali</a>
    {{-- <form action="/mail/{{ $data->id }}" method="post" class="d-inline">
     @method('delete')
     @csrf
     <button class="btn btn-danger" onclick="return confirm ('Are you sure ?')"><span data-feather="x-circle"></span>delete</button> 
   </form> --}}

    </div>

@endsection