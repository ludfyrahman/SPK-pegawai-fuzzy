@extends('superadmin.dashboard.layout.main')



@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Project</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-12 mb-5">
    <a href="{{route('employee.create')}}" class="btn btn-secondary mb-3 shadow">+ Tambah Data</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nip Baru</th>
          <th scope="col">Nip Lama</th>
          <th scope="col">Nama</th>
          <th scope="col">Gelar Depan</th>
          <th scope="col">Tmt CPNS</th>
          <th scope="col">Tmt Golongan</th>
          <th scope="col">Tingkat Pendidikan</th>
          <th scope="col">Unit Kerja Tujuan</th>
          <th scope="col">Jabatan Tujuan</th>
        <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $project)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $project->nip_baru }}</td>
          <td>{{ $project->nip_lama }}</td>
          <td>{{ $project->nama }}</td>
          <td>{{ $project->gelar_depan }}</td>
          <td>{{ $project->tmt_cpns }}</td>
          <td>{{ $project->tmt_golongan }}</td>
          <td>{{ $project->tingkat_pendidikan }}</td>
          <td>{{ $project->unit_kerja_target }}</td>
          <td>{{ $project->position_target }}</td>
          <td>
              <a href="{{ route('employee.show', $project->id)}}" class="badge bg-primary">Detail</a>
              <a href="{{route('employee.edit', $project->id)}}" class="badge bg-warning">Edit</a>
              <form action="{{route('employee.destroy', $project->id)}}" method="post" class="d-inline">
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
