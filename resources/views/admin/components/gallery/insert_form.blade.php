<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Add new gallery picture</p>

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

        <form action="{{ route("gallery.store") }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="title" type="text" class="form-control" placeholder="Title">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <textarea name="description" type="text" class="form-control" placeholder="Description"></textarea>

                </div>

            </div>

            <div class="form-group">
                <label for="picture">Slika:</label>
                    <input name="picture" type="file" id="picture">

            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Add">

                <a href="{{ route("gallery.index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>