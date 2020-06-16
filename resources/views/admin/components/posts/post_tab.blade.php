<table id="mainTable" class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Naslov</th>
        <th>Sadrzaj</th>
        <th>Video link</th>
        <th>Slika</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>{{ $post->postId }}</td>
            <td>{{ $post->naslov }}</td>
            <td>{{ $post->sadrzaj }}</td>
            <td>{{ $post->video }}</td>
            <td><img height="100" src="{{ asset($post->putanja) }}" alt="{{ asset($post->alt) }}"></td>
            <td><a href="{{ route("posts.show", ['id' => $post->postId]) }}" >Izmeni</a></td>
            <td><a href="{{ route("posts.delete", ['id' => $post->postId]) }}" >Obrisi</a></td>

        </tr>
    @endforeach
    </tbody>
</table>