<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Add new post</p>

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

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="title" type="text" class="form-control" placeholder="Naslov">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <textarea name="description" type="text" class="form-control" placeholder="Sadrzaj"></textarea>

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="video" type="text" class="form-control" placeholder="Video link">

                </div>

            </div>            

            <div class="form-group">
                <label for="photo">Slika:</label>
                    <input name="photo" type="file" id="photo">

            </div>

             <div class="form-group">

                <div class="form-line">

                    <input name="alt" type="text" class="form-control" placeholder="alt">

                </div>

            </div>           

            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Add">

                <a href="{{ route("posts.index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>