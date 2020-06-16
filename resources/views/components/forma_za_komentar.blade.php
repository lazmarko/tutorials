@if(session()->has('user'))
<div id="comments" class="col-md-9">
    <div class="comment-bottom heading" id="comments-insert">
        <h3>Ostavite komentar</h3>

            @if(!session()->has('singlecomment'))
            <form action="{{ route("postComment", ['postId' => $post->postId]) }}" method="post">
                {{ csrf_field() }}
            <textarea cols="77" rows="6" name="content" placeholder="Vasa poruka"></textarea>
                <input type="submit" value="Posalji" class="btn btn-primary">
                </form>
            @endif
            @if(session()->has('singlecomment'))
            <form action="{{ route("editComment", ['commentId' => session()->get('commentId')]) }}" method="post">
                {{ csrf_field() }}
                <textarea cols="77" rows="6" name="content" >{{ session()->get('singlecomment') }}</textarea>
                <input type="submit" value="Uredi" class="btn btn-primary">
            </form>
            @endif


        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
    </div>
</div>
@endif