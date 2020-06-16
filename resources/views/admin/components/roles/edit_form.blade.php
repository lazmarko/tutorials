<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Edit navigation link</p>
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

        <form action="{{ route("roles.update", ['id' => $role->id]) }}" method="post">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="name" type="text" value="{{ $role->naziv }}" class="form-control" placeholder="Link name">

                </div>

            </div>




            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Edit">

                <a href="{{ route("roles.index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>