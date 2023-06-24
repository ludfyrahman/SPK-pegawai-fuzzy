@extends('admin.dashboard.layout.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Tentang</h1>
</div>

<div class="col-lg-8">
  
  <form method="post" action="/about/{{ $about->id }}">
    @method('put')
    @csrf
      <div class="mb-3">
        <label for="tittle" class="form-label">Judul</label>
        <input type="text" class="form-control @error('tittle') is-invalid @enderror" id="tittle" name="tittle" required autofocus value="{{ old('tittle', $about->tittle) }}">
        @error('tittle')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror  
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Isi</label>
        @error('body')
        
        <p class="text-danger"> {{ $message }}</p> 
        
        @enderror 
        <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{ old('body', $about->body) }}</textarea>
        {{-- <input id="body" type="hidden" name="body" value="{{ old('body', $about->body) }}">
        
        <trix-editor input="body"></trix-editor> --}}
      </div>
      {{-- <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug">
      </div>
       --}}
    
      <button type="submit" class="btn btn-primary">Pembaruan</button>
  </form>

</div>
{{-- <script>
  const tittle = document.querySelector('#tittle');
  const slug = document.querySelector('#slug');

  tittle.addEventListener('change', function (){
    fetch('/privacy/checkSlug?tittle=' + tittle.value)
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
</script>

@endsection