<div class="col-md-9">
    <h3>Komentari:</h3>
    {{--{{ dd(session()->all()) }}--}}
    {{--{{ dd($post) }}--}}
    {{--{{dd($comments)}}--}}
    @foreach($comments as $comment)
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->korisnicko_ime }}</h4>
                <h6><label>{{ date("F j, Y H:i:s", strtotime($comment->created_at)) }}</label></h6>
                <p>
                    <span id="comment{{$comment->id}}">{{ $comment->tekst }}</span>
                    @if(session('user'))
                        {{--@if(session()->get('user')[0]->id == $comment->korisnik_id || session()->get('user')[0]->naziv == 'admin')--}}
                        {{--<a href="{{ route("deleteComment", ['id' => $comment->id]) }}"> <i class="fa fa-trash"></i></a>--}}
                        {{--@endif--}}
                    {{--{{ dd(session()->all()) }}--}}
                        @if(session()->get('user')[0]->id == $comment->korisnik_id)
                            <a class="btn btn-danger" href="{{ url('/comments/')."/".$comment->id."/delete" }}">OBRISI</a>
                            <a class="btn btn-warning" href="{{ url('/comments/')."/".$comment->id."/show" }}">IZMENI</a>
                        @endif
                    @endif
                </p>
            </div>
        </div>
    @endforeach
</div>