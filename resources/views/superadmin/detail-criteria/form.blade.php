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
              <label for="name" class="form-label">Deskripsi</label>
              <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->description ?? old('description')}}' class="form-control @error('description') is-invalid @enderror" id="description" name="description" required autofocus>
              @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Skor</label>
              <input type="number" step="any" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->weight ?? old('weight')}}' class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" required autofocus>
              @error('weight')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            @if($data->type != 'detail')
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            @elseif ($data->type == 'edit')
              <a href="{{route('criteria.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
            @else
                <a href="{{route('detail-criteria.index', ['id' => $data->id])}}"><button type="button" class="btn btn-primary">Detail Kriteria</button></a>
            @endif
            <a href="{{route('criteria.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
        </form>
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
