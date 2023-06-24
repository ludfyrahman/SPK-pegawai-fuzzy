@extends('superadmin.dashboard.layout.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Part</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-12 mb-5">
    <a href="{{route('part.create')}}" class="btn btn-secondary mb-3 shadow">+ Tambah part</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">No part</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Stok</th>
          <th>Barcode</th>
          <th scope="col">Foto</th>
          <th scope="col">Aksi</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($data as $part)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $part->no_part }}</td>
          <td>{{ $part->deskripsi }}</td>
          <td>{{ $part->stok }}</td>
          <td>{!! DNS1D::getBarcodeSVG($part->barcode, 'C39')!!}</td>
          <td><a target="_blank" href="{{ asset('storage/foto/'.$part->foto) }}">Lihat Gambar</a></td>
          <td>
              <a href="{{ route('part.show', $part->id)}}" class="badge bg-primary"><span data-feather="eye"></span></a>
              <a href="{{route('part.edit', $part->id)}}" class="badge bg-warning"><span data-feather="edit"></span></a>
              <form action="{{route('part.destroy', $part->id)}}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm ('Are you sure ?')"><span data-feather="x-circle"></span></button>
              </form>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
@endsection
