@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.navigation.table")
                    @empty(!session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endempty
                     @empty(!session('success'))
                        <div class="alert alert-success">{{ session('success') }} </div>
                     @endempty
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
                @include('admin.components.navigation.edit_form')
            @break
            @case('insert')
                @include('admin.components.navigation.insert_form')
            @break
        @endswitch
    @endisset
@endsection