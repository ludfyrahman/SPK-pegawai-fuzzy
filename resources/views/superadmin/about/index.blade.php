@extends('admin.dashboard.layout.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tentang</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-10 mb-5">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">isi</th>
          <th scope="col">Aksi</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $about)
        
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $about->tittle }}</td>
          <td>{!! $about->body !!}</td>
          <td>
              <a href="/about/{{ $about->id }}" class="badge bg-primary"><span data-feather="eye"></span></a>
              <a href="/about/{{ $about->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
              
              
          </td>
        </tr>
        
        @endforeach  
      </tbody>
    </table>
  </div>
@endsection