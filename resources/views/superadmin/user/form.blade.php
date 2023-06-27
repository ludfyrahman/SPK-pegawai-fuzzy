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
        <input type="password" {{ $data->type == 'detail' ? 'disabled' : ''}} value='' class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Karyawan</label>
        @php
            $typeActive = $data->employee_id ?? old('employee_id');
        @endphp
        <select name="employee_id" id="" class="form-control" {{ $data->type == 'detail' ? 'disabled' : ''}} >
            <option value="">Pilih Karyawan</option>
            @foreach ($employee as $g)
                <option {{$typeActive == $g->id ? 'selected': ''}} value="{{$g->id}}">{{$g->nama}}</option>
            @endforeach
        </select>
        @error('position_type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
    </div>
      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @elseif($data->type == 'edit')
        <a href="{{route('user.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
        <a href="{{route('user.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>

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
