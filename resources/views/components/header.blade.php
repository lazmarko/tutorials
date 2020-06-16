	<div class="header">
	<div class="container">
		<div class="header-info">
			<div class="logo">
				<a href="index.html"><img src="{{asset('images/logo.png')}}" alt=" " /></a>
			</div>
			<div class="logo-right">
				<span class="menu"><img src="{{asset('images/menu.png')}}" alt=" "/></span>
				<ul class="nav1">
					@isset($menus)
              			@foreach($menus as $menu)
              			<li class="nav-item {{ (Request::url().'/' == asset($menu->link))? 'active' : '' }}">
                			<a class="nav-link" href="{{ asset($menu->link) }}"> 
                  				{{ $menu->naziv }}
                			</a>
              			</li>
             			@endforeach
            		@endisset
            		@if(session()->has('user') && session()->get('user')[0]->naziv == 'korisnik')
            		<li><a href="{{ route('createPost') }}" >Dodaj tutorijal</a></li>
            		@endif
					@if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')
					<li><a href="{{ route('adminpanel') }}">Admin panel</a></li>
					@endif
				@if(session()->has('user'))
              		<li>
                	<a class="nav-link" href="{{ route('logout') }}">Logout</a></li>              	              		
            	@endif
            	<li><a href="{{ asset('dokumentacija.pdf') }}">Dokumentacija</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
				<!-- script for menu -->
					<script> 
						$( "span.menu" ).click(function() {
						$( "ul.nav1" ).slideToggle( 300, function() {
						 // Animation complete.
						});
						});
					</script>
				<!-- //script for menu -->
		</div>
	</div>
	</div>