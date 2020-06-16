@extends('layouts.front')

@section('title')
	Registracija
@endsection

@section('content')

<div class="col-md-4">
            <h3>Register</h3>
            
            @empty(!session('message'))
              <div class="alert alert-success">{{ session('message') }}</div>
            @endempty

            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset

            <form action="{{ route('registerStore') }}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              
              <div class="form-group">
                <label>Korisnicko ime:</label>
                <input type="text" name="korisnickoIme" id="korisnickoIme" class="form-control" onBlur="provera();" value="{{ old('korisnickoIme') }}"/>
                <span id="greska"></span>
              </div>
                <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" id="email" class="form-control" onBlur="provera();" value="{{ old('email') }}"/>
              </div>
              <div class="form-group">
                <label>Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka" class="form-control" onBlur="provera();" value="{{ (isset($korisnik))? $korisnik->lozinka : old('lozinka') }}"/>
                <span>Sifra mora sadrzati najmanje 8 karaktera od kojih su jedno veliko slovo, jedno malo slovo i jedan broj.</span>
              </div> 
               <div class="form-group">
                <input type="submit" name="registerKorisnik" value="{{ (isset($korisnik))? 'Change korisnik' : 'Add korisnik' }} " class="btn btn-default" />
              </div> 
            </form>
            <script type="text/javascript">
              function provera(){
              var regKorIme = /^[A-Za-z]{3,15}$/;
              var regEmail= /^[\w\d]{2,20}(\.+[\w\d]{2,20})*\@([a-z]{2,6}\.)+[a-z]{2,6}$/;
              var regPassword=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/


              var korIme=document.getElementById("korisnickoIme").value;
              var email=document.getElementById("email").value;
              var lozinka=document.getElementById("lozinka").value;



              if (regKorIme.test(korIme)) {
              document.getElementById("korisnickoIme").style.border = "2px solid green"; }
              else {
              document.getElementById("korisnickoIme").style.border = "2px solid red"; }

              if (regEmail.test(email)) {
              document.getElementById("email").style.border = "2px solid green"; }
              else {
              document.getElementById("email").style.border = "2px solid red"; } 

              if (regPassword.test(lozinka)) {
              document.getElementById("lozinka").style.border = "2px solid green"; }
              else {
              document.getElementById("lozinka").style.border = "2px solid red"; } 

              }                          
            </script> 



        </div>

@endsection


