      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">


<li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Uredi</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti" style="">
            <li>
              <a href="{{route('users.create')}}">Dodaj korisnika</a>
            </li>
            <li>
              <a href="{{route('posts.create')}}">Dodaj tutorijal</a>
            </li>
            <li>
              <a href="{{route('gallery.create')}}">Dodaj sliku u galeriju</a>
            </li>
              <li>
              <a href="{{route('roles.create')}}">Dodaj novu ulogu</a>
            </li>
            <li>
              <a href="{{route('navigation.create')}}">Dodaj stavku u meni</a>
            </li>            
            <li>
              <a class="nav-link-collapse" data-toggle="collapse" href="#collapseMulti2" aria-expanded="true">Prikazi</a>
              <ul class="sidenav-third-level collapse show" id="collapseMulti2" style="">
                <li>
                  <a href="{{route('users.index')}}">Prikazi korisnike</a>
                </li>
                <li>
                  <a href="{{route('posts.index')}}">Prikazi tutorijale</a>
                </li>
                <li>
                  <a href="{{route('gallery.index')}}">Prikazi galeriju</a>
                </li>
                 <li>
                  <a href="{{route('roles.index')}}">Prikazi uloge</a>
                </li>
                <li>
                  <a href="{{route('navigation.index')}}">Prikazi stavke iz menija</a>
                </li>
                  <li>
                      <a href="{{ route('logruta') }}">Log fajl</a>
                  </li>
              </ul>
            </li>
          </ul>
        </li>




      </ul>
            <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>