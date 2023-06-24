@extends('landingpage.layout.main')
@section('container')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-8 offset-2 mt-5">
                <h1 class="text-center pb-2" style="color: #469fc5; font-weight: 900;" >Contact Us</h1>
                        <hr
                            class="mb-4 mt-0  text-center shadow"
                            style="width: 840px; background-color: #000000; height: 2px"
                        />
                <div class="card mt-5 mb-5 pt-3" style="box-shadow: 5px 5px 8px #469fc5, -3px -3px 8px #fff; ">
                    {{-- <div class="card-header bg-dark"> --}}
                        
                    {{-- </div> --}}
                    <div class="card-body">
                        
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ route('contact-us.store') }}">
                  
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="color: dark">
                                        <strong>Nama:</strong>
                                        <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="color: dark">
                                        <strong>Alamat Email:</strong>
                                        <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" class="form-control" placeholder="" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="color: dark">
                                        <strong>No. Handphone:</strong>
                                        <input type="text" name="phone" class="form-control" placeholder="" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="color: dark">
                                        <strong>Subyek:</strong>
                                        <input type="text" name="subject" class="form-control" placeholder="" value="{{ old('subject') }}">
                                        @if ($errors->has('subject'))
                                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="color: dark">
                                        <strong>Pesan:</strong>
                                        <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                   
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-submit mt-5">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <script type="text/javascript"> 
        function validation()
        {
            var email = document.getElementById("email").value;
            var text = document.getElementById("text");
            var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

            if (email.match(pattern))
            {
                text.innerHTML = "Alamat email anda valid.";
                text.style.color = "#00ff00";
            }
            else
            {
                text.innerHTML = "Masukkan alamat email anda yang valid.";
                text.style.color = "#ff0000";
            }
        }
    </script>  --}}
@endsection