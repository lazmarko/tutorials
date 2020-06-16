<table id="mainTable" class="table table-striped">
    <thead>
    <tr>
        <th>Naslov</th>
        <th>Opis</th>
        <th>Slika</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($galleries as $g)
        <tr>
            <td>{{ $g->title }}</td>
            <td>{{ $g->description }}</td>
            <td><img height="100" src="{{ asset($g->putanja) }}" alt="{{ asset($g->alt) }}"></td>
            <td><a href="{{ route("gallery.show", ['id' => $g->id]) }}" >Izmeni</a></td>
            <td><a href="{{ route("gallery.delete", ['id' => $g->id]) }}" >Obrisi</a></td>

        </tr>
    @endforeach
    </tbody>
</table>