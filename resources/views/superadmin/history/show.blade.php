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
        <label for="name" class="form-label">Gudang</label>
        @php
            $gudangActive = $data->gudang_id ?? old('gudang_id');
        @endphp
        <select name="gudang_id" id="" class="form-control" {{ $data->type == 'detail' ? 'disabled' : ''}} required>
            <option value="">Pilih Lokasi Gudang</option>
            @foreach ($gudang as $g)
                <option {{$gudangActive == $g->id ? 'selected': ''}} value="{{$g->id}}">{{$g->nama}}</option>
            @endforeach
        </select>
        @error('gudang_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">No Part</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->no_part ?? old('no_part')}}' class="form-control @error('no_part') is-invalid @enderror" id="no_part" name="no_part" required autofocus>
        @error('no_part')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">stok</label>
        <input type="number"  min='1' {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->stok ?? old('stok')}}' class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" required autofocus>
        @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">sap</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->sap ?? old('sap')}}' class="form-control @error('sap') is-invalid @enderror" id="sap" name="sap" required autofocus>
        @error('sap')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">cat</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->cat ?? old('cat')}}' class="form-control @error('cat') is-invalid @enderror" id="cat" name="cat" required autofocus>
        @error('cat')
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
      <div class="mb-3">
        <label for="name" class="form-label">satuan</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->satuan ?? old('satuan')}}' class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required autofocus>
        @error('satuan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">lokasi</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->lokasi ?? old('lokasi')}}' class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" required autofocus>
        @error('lokasi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">keterangan</label>
        @error('keterangan')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
        <textarea class="form-control"  {{ $data->type == 'detail' ? 'disabled' : ''}} name="keterangan" id="keterangan" cols="30" rows="10">{{$data->keterangan ?? old('keterangan')}}</textarea>

      </div>
      <div class="mb-3">
        <label for="name" class="form-label">barcode</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->barcode ?? old('barcode')}}' class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" required autofocus>
        @error('barcode')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <img src="{{ asset('storage/foto/'.$data->foto) }}" alt="" clas="mt-3" style="width:30%">
        @error('foto')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Barcode</label><br/>
        {!! DNS1D::getBarcodeSVG($data->barcode, 'C39')!!}
      </div>

      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('part.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
      <a href="{{route('part.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>
  <h4 class="mt-4">History</h4>
  <hr>
  <a href="{{ route('history.create', ['id' => $id]) }}" class="btn btn-sm btn-primary float-end"><i class="fas fa-plus"></i> Tambah Data</a>
  <table class="table">
    <thead>
        <tr>
            <th>#</th><th>Tanggal</th><th>Pemasukan</th><th>Pengeluaran</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($history as $his)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$his->tanggal}}</td>
            <td>{{$his->pemasukan}}</td>
            <td>{{$his->pengeluaran}}</td>
            <td>
                <a href=""{{ route('history.edit', $his->id) }} class="btn btn-sm btn-primary">Edit</a>
                <a href="" class="btn btn-sm btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
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
