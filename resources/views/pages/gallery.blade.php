@extends('layouts.front')



@section('title')
	Galerija
@endsection

@section('appendCss')
@parent
<link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class="row text-center text-lg-left">
@isset($galleries)
@foreach($galleries as $gallery)
        <div class="col-lg-3 col-md-4 col-xs-6" >
          <a href="{{ asset($gallery->putanja) }}" data-lightbox="image-1" class="d-block mb-4 h-100">
            <img style="width: 210px;height: 160px" class="img-fluid img-thumbnail" src="{{ asset($gallery->putanja) }}" alt="{{$gallery->alt}}">
          </a>
        </div>
@endforeach
@endisset
        
      </div>

@endsection

@section('appendJs')
@parent
	<script src=" {{ asset('js/lightbox-plus-jquery.js') }}"></script>
@endsection