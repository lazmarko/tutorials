<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Update existing post</p>
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

        <form action="{{ route("posts.update", ['id' => $post->postId]) }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="title" type="text" class="form-control" value="{{ $post->naslov }}" placeholder="Title">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <textarea name="description" type="number" class="form-control"  placeholder="Description">{{ $post->sadrzaj }}
                    </textarea>

                </div>

            </div>
            <div class="form-group">

                <div class="form-line">

                    <input name="video" type="text" class="form-control" value="{{ $post->video }}" placeholder="Title">

                </div>

            </div>            

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input name="picture" type="file" id="picture">
                <br>
                <img class="img thumbnail" height="200px" src="{{ asset($post->putanja) }}" alt="{{ $post->alt }}">
            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Edit">

                <a href="{{ route("posts.index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>