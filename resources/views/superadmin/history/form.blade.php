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
    @if($data->page != 'create')
        @method('PUT')
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">Tanggal</label>
            <input type="hidden" name='part_id' value="{{$id}}">
            <input type="date" {{ $data->page == 'detail' ? 'disabled' : ''}} value='{{$data->tanggal ?? old('tanggal')}}' class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required autofocus>
            @error('tanggal')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Jumlah</label>
            <input type="number" min='1' {{ $data->page == 'detail' ? 'disabled' : ''}} value='{{$data->amount ?? old('amount')}}' class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" required autofocus>
            @error('amount')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Type</label>
        @php
            $type = $data->type
        @endphp
        <select name="type" id="" class="form-control" {{ $data->page == 'detail' ? 'disabled' : ''}} required>
            <option value="">Pilih Type</option>
            <option {{$type == '1' ? 'selected' : ''}} value="1">Pemasukan</option>
            <option {{$type == '2' ? 'selected' : ''}} value="2">Pengeluaran</option>
        </select>
        @error('type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        @error('description')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
        <textarea class="form-control"  {{ $data->page == 'detail' ? 'disabled' : ''}} name="description" id="description" cols="30" rows="10">{{$data->description ?? old('description')}}</textarea>
      </div>

      @if($data->page != 'detail')
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('part.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
      <a href="{{route('part.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>

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
