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
        <label for="name" class="form-label">Nama</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nama ?? old('nama')}}' class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus>
        @error('nama')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        @error('deskripsi')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
        <textarea class="form-control"  {{ $data->type == 'detail' ? 'disabled' : ''}} name="deskripsi" id="deskripsi" cols="30" rows="10">{{$data->deskripsi ?? old('deskripsi')}}</textarea>

      </div>
      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Tambahkan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('gudang.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
      <a href="{{route('gudang.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>
  @if($data->type == 'detail')
    <h3 class="mt-2">Data Part di {{$data->nama}}</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th><th>No Part</th><th>Deskripsi</th><th>Stok</th><th>Foto</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($parts as $part)

            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $part->no_part }}</td>
              <td>{{ $part->deskripsi }}</td>
              <td>{{ $part->stok }}</td>
              <td><a target="_blank" href="{{ asset('storage/foto/'.$part->foto) }}">Lihat Gambar</a></td>
              <td>
                  <a href="{{ route('part.show', $part->id)}}" class="badge bg-primary"><span data-feather="eye"></span></a>
                  <a href="{{route('part.edit', $part->id)}}" class="badge bg-warning"><span data-feather="edit"></span></a>
              </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center"><i>Data yang anda butuhkan belum tersedia</i></td>
                </tr>
            @endforelse
          </tbody>
    </table>
  @endif

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
