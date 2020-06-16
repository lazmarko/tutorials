            <table class="table">
                <tr>
                  <td>ID</td>
                  <td>Korisnicko ime</td>
                  <td>Email</td>
                  <td>Uloga</td>
                  <td>Izmeni</td>
                  <td>Obrisi</td>
                </tr>
                <!-- Prikaz korisnika-->
                @isset($korisnici)
                @foreach($korisnici as $korisnik)
                  <tr>
                    <td> {{ $korisnik->korisnikId }} </td>
                    <td> {{ $korisnik->korisnicko_ime }} </td>
                    <td> {{ $korisnik->email }} </td>
                    <td> {{ $korisnik->naziv }} </td>
                    <td> <a href="{{ route('users.show', ['id' => $korisnik->korisnikId]) }}">Izmeni</a> </td>
                    <td> <a href="{{ route('users.delete', ['id' => $korisnik->korisnikId]) }}">Obrisi</a> </td>
                  </tr>
                @endforeach
                @endisset
            </table>