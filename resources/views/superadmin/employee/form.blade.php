@extends('superadmin.dashboard.layout.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
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
              <label for="name" class="form-label">Nip Lama</label>
              <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nip_lama ?? old('nip_lama')}}' class="form-control @error('nip_lama') is-invalid @enderror" id="nip_lama" name="nip_lama" required autofocus>
              @error('nip_lama')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            </div>
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
                <label for="name" class="form-label">Gol Akhir</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->gol_akhir ?? old('gol_akhir')}}' class="form-control @error('gol_akhir') is-invalid @enderror" id="gol_akhir" name="gol_akhir" required autofocus>
                @error('gol_akhir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tmt Golongan</label>
                <input type="date" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tmt_golongan ?? old('tmt_golongan')}}' class="form-control @error('tmt_golongan') is-invalid @enderror" id="tmt_golongan" name="tmt_golongan" required autofocus>
                @error('tmt_golongan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tingkat Pendidikan</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->tingkat_pendidikan ?? old('tingkat_pendidikan')}}' class="form-control @error('tingkat_pendidikan') is-invalid @enderror" id="tingkat_pendidikan" name="tingkat_pendidikan" required autofocus>
                @error('tingkat_pendidikan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Pendidikan</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nama_pendidikan ?? old('nama_pendidikan')}}' class="form-control @error('nama_pendidikan') is-invalid @enderror" id="nama_pendidikan" name="nama_pendidikan" required autofocus>
                @error('nama_pendidikan')
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
                <label for="name" class="form-label">Lokasi Kerja</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->lokasi_kerja_nama ?? old('lokasi_kerja_nama')}}' class="form-control @error('lokasi_kerja_nama') is-invalid @enderror" id="lokasi_kerja_nama" name="lokasi_kerja_nama" required autofocus>
                @error('lokasi_kerja_nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Unit Kerja</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->unit_kerja ?? old('unit_kerja')}}' class="form-control @error('unit_kerja') is-invalid @enderror" id="unit_kerja" name="unit_kerja" required autofocus>
                @error('unit_kerja')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Instansi</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->instansi ?? old('instansi')}}' class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" required autofocus>
                @error('instansi')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Unit Kerja Tujuan</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->unit_kerja_target ?? old('unit_kerja_target')}}' class="form-control @error('unit_kerja_target') is-invalid @enderror" id="unit_kerja_target" name="unit_kerja_target" required autofocus>
                @error('unit_kerja_target')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Jabatan yang dituju</label>
                <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->position_target ?? old('position_target')}}' class="form-control @error('position_target') is-invalid @enderror" id="position_target" name="position_target" required autofocus>
                @error('position_target')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>

            @if($data->type != 'detail')
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            @elseif($data->type == 'edit')
              <a href="{{route('employee.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
            @endif
            <a href="{{route('employee.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>

        </form>
      </div>
    </div>
    <div class="card mt-3">
       <div class="card-body">
            @if($data->type == 'detail')
            <button class="btn btn-primary" type='button' data-toggle="modal" data-target="#modal">Tambah Jabatan</button>
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('position.storeEmployee', $data->id)}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <select name="position_id" id="" class="form-control" required>
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($position as $item)
                                    <option value="{{$item->id}}">{{$item->name}}[{{$item->position_type}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <table class="table table-stiped">
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Skor</th>
                    <th>Rank</th>
                </tr>
                @foreach ($data->position as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->position?->name ?? '-'}}</td>
                    <td>{{$item->weight ?? 0}}</td>
                    <td>{{ $item->rank ?? 0 }}</td>
                </tr>
                @endforeach
            </table>
            @endif
       </div>
    </div>

  </div>

  <div class="col-lg-6 d-none">
      <div class="card">
        <div class="card-body">
          <h4>Import Data</h4>

          <form method="post" action="{{ route('importData') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

              <label>Pilih file excel <a href="{{asset('template/Template Import.xlsx')}}" target="_blank">Download Template</a></label>
              <div class="form-group">
                  <input type="file" name="file" required="required">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Import</button>
              </div>
          </form>
        </div>
      </div>
  </div>
</div>
<!-- {{-- <script>
  const tittle = document.querySelector('#tittle');
  const slug = document.querySelector('#slug');

  tittle.addEventListener('change', function (){
    fetch('/part1/checkSlug?tittle=' + tittle.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });
</script> --}}
{{-- <script>
  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  })
</script> --}}
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
