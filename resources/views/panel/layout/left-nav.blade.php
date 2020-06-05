<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" >
                <div class="dropdown profile-element">
{{--                    <img alt="image" class="panel-left-nav-image" src="{{GlobalConfig::favicon()}}">--}}

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{Auth::user()->name}}</span>
                        <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    FU
                </div>
            </li>
            <li>
               {{Menu::render()}}
            </li>
        </ul>
    </div>
</nav>
