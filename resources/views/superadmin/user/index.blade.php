@extends('superadmin.dashboard.layout.main')



@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-12 mb-5">
    <a href="{{route('user.create')}}" class="btn btn-secondary mb-3 shadow">+ Tambah User</a>



    <table class="table table-striped table-sm">
      <thead>
        <tr>

          <th scope="col">No</th>
          <th scope="col">ID</th>
          <th scope="col">Nama</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Aksi</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($data as $user)

        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><span class="badge bg-primary">{{ $user->id}}</span></td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>
              <a href="{{ route('user.show', $user->id)}}" class="badge bg-primary">Detail</span></a>
              <a href="{{route('user.edit', $user->id)}}" class="badge bg-warning">Edit</a>
              <form action="{{route('user.destroy', $user->id)}}" method="post" class="d-inline">
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

