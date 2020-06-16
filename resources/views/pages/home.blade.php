@extends('layouts.front')

@section('title')
	Pocetna
@endsection

@section('content')
	
<div class="title">
	<!-- POST -->
	              @isset($posts)
                @foreach($posts as $post)
				<div class="some-title">
					<h3><a href="{{ asset('/posts/'.$post->postId) }}">{{ $post->naslov }}</a></h3>
				</div>
				<div class="john">
					<p><a href="#">{{ $post->korisnicko_ime }}</a><span>{{ date("d.m.Y H:i:s", $post->created_at) }}</span></p>
				</div>
				<div class="clearfix"> </div>
				<div class="tilte-grid">
					<a href="{{ asset('/posts/'.$post->postId) }}"><img style="height: 340px" src="{{ asset('/'.$post->putanja) }}" alt=" " /></a>
					<span><p></p></span> 
				</div>
				<div class="">
					<a href="{{ asset('/posts/'.$post->postId) }}">ULOGUJTE SE DA BISTE VIDELI TUTORIJAL</a>
				</div>
				<div class="border">
					<p>a</p>
				</div>
				  @endforeach
    		      @endisset


				

	<!-- POST -->		



				<!-- paginacija -->
				
{{ $posts->links() }}
					<!-- paginacija -->
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="categories">
				<div class="categ">
					<div class="cat">
						 <!-- LOGIN FORM -->
						 @if(!session()->has('user'))						 						 
						 <h3>Login</h3>
						 @endif
		<div class="card my-4">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
					@if(!session()->has('user'))
                  <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Korisnicko ime:</label>
                        <input type="text" name="tbKorisnickoIme" class="form-control">
                    </div>
                    
                    <div class="form-group">
                      <label>Lozinka:</label>
                      <input type="password" name="tbLozinka" class="form-control">
                    </div>                    
                    <input type="submit" name="btnLogin" value="Login" class="btn btn-success">                  
                  </form>
                  <br/>
                    <a href="{{ route('register') }}" class="btn btn-danger">Registracija</a>

                 <br/>
                  <br>
                  	@empty(!session('error'))
            			<div class="alert alert-danger">{{ session('error') }}</div>
          			@endempty
        			 @empty(!session('success'))
            			<div class="alert alert-success">{{ session('success') }} </div>
          			 @endempty
                  @endif 		
               
                </div>
              </div>
            </div>
          </div>
           <!--// LOGIN FORM -->
					</div>
					<!-- ANKETA -->
					<div class="recent-com">
						                  @isset($errors)
                    @if($errors->any())
                      @foreach($errors->all() as $error)
                       <div class="alert alert-danger">{{ $error }}</div> 
                      @endforeach
                    @endif
                  @endisset
                  	</div>

                  	@if(session()->has('user') && session()->get('user')[0]->naziv == 'korisnik')
                  	<a href="{{ asset('/posts/create') }}" class="btn btn-warning">Create post</a>
                  	<div class="recent-com">	
					<h3>Anketa</h3>
					</div>
					<br/>
                  	@endif



					<!-- ANKETA -->

				</div>
			</div>
			<div class="clearfix"> </div>

@endsection