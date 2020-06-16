<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new menu item</p>
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
            <form action="{{ route('navigation.store') }}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              
              <div class="form-group">
                    <input name="name" type="text" class="form-control" placeholder="Naziv linka">
              </div>
              <div class="form-group">
                    <input name="route" type="text" class="form-control" placeholder="URL">
              </div>           

               <div class="form-group">
                <input type="submit" value="Add" class="btn btn-default" />
                <a href="{{ route('navigation.index') }}" class="btn btn-warning waves-effect">Cancel</a>
              </div> 
            </form>
    </div>
</div>
