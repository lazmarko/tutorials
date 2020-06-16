@extends('layouts.front')

@section('title')
	Jedan
@endsection('title')

@section('content')

@isset($post)

<h1 class="my-4">{{$post->naslov}}</h1>
<br>


      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
            <iframe width="750" height="500" src="{{$post->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <div class="col-md-4">
          <h3 class="my-3">TO DO: </h3>
          <p>{{$post->sadrzaj}}</p>

        </div>
        @include('components.komentari')
        @include('components.forma_za_komentar')
          {{--{{ dd($post) }}--}}
      </div>
      <!-- /.row -->


@endisset


@endsection