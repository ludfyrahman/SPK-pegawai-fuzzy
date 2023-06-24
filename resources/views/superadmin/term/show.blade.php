@extends('admin.dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Syarat & Ketentuan</h1>
</div>

<div class="container mt-5">
    
       <h1 class="mb-3"> {{ $data->tittle}} </h1>
       <p class="mt-3"> {!! $data->body !!} </p> 
       <a href="/term" class="btn btn-success"><span data-feather="arrow-left"></span>Kembali</a>
       <a href="/term/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span>Ubah</a>
       <form action="/term/{{ $data->id }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button class="btn btn-danger" onclick="return confirm ('Are you sure ?')"><span data-feather="x-circle"></span>Hapus</button>
      </form>
    </div>

@endsection