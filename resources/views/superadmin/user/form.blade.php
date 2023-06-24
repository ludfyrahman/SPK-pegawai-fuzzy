@extends('superadmin.dashboard.layout.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<div class="col-lg-12">

  <form method="post" action="{{ $data->route }}" enctype="multipart/form-data">
    @if (session('failed'))
        <div class="alert alert-danger mg-b-0" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    @csrf
    @if($data->type != 'create')
        @method('PUT')
    @endif
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->name ?? old('name')}}' class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->username ?? old('username')}}' class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Email</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->email ?? old('email')}}' class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autofocus>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">password</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->password ?? old('password')}}' class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Tambahkan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('gudang.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
        <a href="{{route('gudang.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>
  {{-- @if($data->type == 'detail')
    <h3 class="mt-2">Data Detail di{{$data->nama}}</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)

            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name}}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                  <a href="{{ route('user.show', $user->id)}}" class="badge bg-primary"><span data-feather="eye"></span></a>
                  <a href="{{route('user.edit', $user->id)}}" class="badge bg-warning"><span data-feather="edit"></span></a>
              </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center"><i>Data yang anda butuhkan belum tersedia</i></td>
                </tr>
            @endforelse
          </tbody>
    </table>
  @endif --}}

</div>
@endsection
@section ('scripts')

<script>
  ClassicEditor
      .create( document.querySelector( '#body' ) )
      .catch( error => {
          console.error( error );
      } );
</script> -->

@endsection
