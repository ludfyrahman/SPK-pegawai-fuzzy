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
    <a href="{{route('criteria.create')}}" class="btn btn-secondary mb-3 shadow">+ Tambah Kriteria</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">No Kriteria</th>
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
              <a href="{{ route('criteria.show', $part->id)}}" class="badge bg-primary">Detail</a>
              <a href="{{route('criteria.edit', $part->id)}}" class="badge bg-warning">Edit</a>
              <form action="{{route('criteria.destroy', $part->id)}}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm ('Are you sure ?')">Delete</button>
              </form>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
@endsection
