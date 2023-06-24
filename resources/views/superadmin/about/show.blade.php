@extends('admin.dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Tentang</h1>
</div>

<div class="container mt-5">
    
       <h1 class="mb-3"> {{ $data->tittle}} </h1>
       <p class="mt-3"> {!! $data->body !!} </p> 
       <a href="/about" class="btn btn-success"><span data-feather="arrow-left"></span>Kembali</a>
       <a href="/about/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span>Ubah</a>
        
    </div>

@endsection