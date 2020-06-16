@extends('layouts.front')

@section('title')
  Registracija
@endsection

@section('content')

<div class="col-md-4">
            <h3>Dodaj tutorijal</h3>
            
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

            <form action="{{ asset('/post/store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
              </div>
              <div class="form-group">
                <label>Embed link:</label>
                <input type="text" name="embedLink" class="form-control" value="{{ old('embedLink') }}"/>
              </div>              
              <div class="form-group">
                <label>Body:</label>
                <textarea name="body" class="form-control" rows="7">{{ old('body') }}</textarea>
              </div> 
              <div class="form-group">
                <label>Photo:</label>
                <input type="file" name="photo" class="form-control"  />
              </div>
              <div class="form-group">
                <label>Alt:</label>
                <input type="text" name="alt" class="form-control" value="{{ old('alt') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addPost" value="Add post" class="btn btn-default" />
              </div> 
            </form>


        </div>

@endsection


