@extends('superadmin.dashboard.layout.main')



@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-12 mb-5">
    <a href="{{route('plotting.create')}}" class="btn btn-secondary mb-3 shadow">+ Tambah data</a>
    <a href="{{route('plotting.calculation')}}" class="btn btn-secondary mb-3 shadow">Penghitungan Metode</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Karyawan</th>
          <th scope="col">Jabatan yang dituju</th>
          {{-- <th scope="col">Nilai/Bobot</th> --}}
          <th scope="col">Aksi</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($data as $part)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $part->employee->nama ?? '-' }}</td>
          <td>{{ $part->position->name ?? '-' }}</td>
          {{-- <td>{{ $part->weight }}</td> --}}

          <td>
              {{-- <a href="{{ route('plotting.show', $part->id)}}" class="badge bg-primary">Detail</a> --}}
              {{-- <a href="{{route('plotting.edit', $part->id)}}" class="badge bg-warning">Edit</a> --}}
              <form action="{{route('plotting.destroy', $part->id)}}" method="post" class="d-inline">
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
