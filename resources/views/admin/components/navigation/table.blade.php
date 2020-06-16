            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Naziv</td>
                  <td>Ruta</td>
                  <td>Izmeni</td>
                  <td>Obrisi</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($navigations)
                @foreach($navigations as $nav)
                  <tr>
                    <td> {{ $nav->id }} </td>
                    <td> {{ $nav->naziv }} </td>
                    <td> {{ $nav->link }} </td>
                    <td> <a href="{{ route('navigation.show', ['id' => $nav->id]) }}">Izmeni</a> </td>
                    <td> <a href="{{ route('navigation.delete', ['id' => $nav->id]) }}">Obrisi</a> </td>
                  </tr>
                @endforeach
                @endisset
            </table>