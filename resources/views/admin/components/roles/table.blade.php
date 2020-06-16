<table id="mainTable" class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{ $role->naziv }}</td>
                    <td> <a href="{{ route('roles.show', ['id' => $role->id]) }}">Izmeni</a> </td>
                    <td> <a href="{{ route('roles.delete', ['id' => $role->id]) }}">Obrisi</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>