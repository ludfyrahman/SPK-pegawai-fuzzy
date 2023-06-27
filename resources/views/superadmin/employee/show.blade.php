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
        <label for="name" class="form-label">Nip Baru</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nip_baru ?? old('nip_baru')}}' class="form-control @error('nip_baru') is-invalid @enderror" id="nip_baru" name="nip_baru" required autofocus>
        @error('nip_baru')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Nip Lama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nip_lama ?? old('nip_lama')}}' class="form-control @error('nip_lama') is-invalid @enderror" id="nip_lama" name="nip_lama" required autofocus>
          @error('nip_lama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
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
          <label for="name" class="form-label">Gelar Depan</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->gelar_depan ?? old('gelar_depan')}}' class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan" name="gelar_depan" required autofocus>
          @error('gelar_depan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Gelar Belakang</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->gelar_belakang ?? old('gelar_belakang')}}' class="form-control @error('gelar_belakang') is-invalid @enderror" id="gelar_belakang" name="gelar_belakang" required autofocus>
          @error('gelar_belakang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Tmt CPNS</label>
          <input type="date" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tmt_cpns ?? old('tmt_cpns')}}' class="form-control @error('tmt_cpns') is-invalid @enderror" id="tmt_cpns" name="tmt_cpns" required autofocus>
          @error('tmt_cpns')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Gol Akhir Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->mk_bulan ?? old('gol_akhir_nama')}}' class="form-control @error('gol_akhir_nama') is-invalid @enderror" id="gol_akhir_nama" name="gol_akhir_nama" required autofocus>
          @error('gol_akhir_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Tmt Golongan</label>
          <input type="date" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tmt_cpns ?? old('tmt_cpns')}}' class="form-control @error('tmt_cpns') is-invalid @enderror" id="tmt_cpns" name="tmt_cpns" required autofocus>
          @error('tmt_cpns')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Mk Tahun</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->gol_akhir_nama ?? old('gol_akhir_nama')}}' class="form-control @error('gol_akhir_nama') is-invalid @enderror" id="gol_akhir_nama" name="gol_akhir_nama" required autofocus>
          @error('gol_akhir_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Mk Bulan</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->mk_bulan ?? old('mk_bulan')}}' class="form-control @error('mk_bulan') is-invalid @enderror" id="mk_bulan" name="mk_bulan" required autofocus>
          @error('mk_bulan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Jenis Jabatan Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->jenis_jabatan_nama ?? old('jenis_jabatan_nama')}}' class="form-control @error('jenis_jabatan_nama') is-invalid @enderror" id="jenis_jabatan_nama" name="jenis_jabatan_nama" required autofocus>
          @error('jenis_jabatan_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Jabatan Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->pendidikan_nama ?? old('tingkat_pendidikan_nama')}}' class="form-control @error('jabatan_nama') is-invalid @enderror" id="jabatan_nama" name="jabatan_nama" required autofocus>
          @error('jabatan_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Tmt Jabatan</label>
          <input type="date" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tmt_jabatan ?? old('tmt_jabatan')}}' class="form-control @error('tmt_jabatan') is-invalid @enderror" id="tmt_jabatan" name="tmt_jabatan" required autofocus>
          @error('tmt_jabatan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Tingkat Pendidikan Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tingkat_pendidikan ?? old('tingkat_pendidikan')}}' class="form-control @error('tingkat_pendidikan') is-invalid @enderror" id="tingkat_pendidikan" name="tingkat_pendidikan" required autofocus>
          @error('tingkat_pendidikan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Pendidikan Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->pendidikan_nama ?? old('pendidikan_nama')}}' class="form-control @error('pendidikan_nama') is-invalid @enderror" id="pendidikan_nama" name="pendidikan_nama" required autofocus>
          @error('pendidikan_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Tahun Lulus</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tahun_lulus ?? old('tahun_lulus')}}' class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" required autofocus>
          @error('tahun_lulus')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">KPKN Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->kpkn_nama ?? old('kpkn_nama')}}' class="form-control @error('kpkn_nama') is-invalid @enderror" id="kpkn_nama" name="kpkn_nama" required autofocus>
          @error('kpkn_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Lokasi Kerja Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->lokasi_kerja_nama ?? old('lokasi_kerja_nama')}}' class="form-control @error('lokasi_kerja_nama') is-invalid @enderror" id="lokasi_kerja_nama" name="lokasi_kerja_nama" required autofocus>
          @error('lokasi_kerja_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Unor Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->unor_nama ?? old('unor_nama')}}' class="form-control @error('unor_nama') is-invalid @enderror" id="unor_nama" name="unor_nama" required autofocus>
          @error('unor_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="name" class="form-label">Instansi Induk Nama</label>
          <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->instasi_induk_nama ?? old('instasi_induk_nama')}}' class="form-control @error('instasi_induk_nama') is-invalid @enderror" id="instasi_induk_nama" name="instasi_induk_nama" required autofocus>
          @error('instasi_induk_nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>

      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('employee.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
      <a href="{{route('employee.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>


@endsection
