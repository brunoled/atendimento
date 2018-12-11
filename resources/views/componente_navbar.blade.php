<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
            data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation"></button>

    <div class="collapse navbar-collapse" id="navbar">
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav mr-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                    @endif
                </li>
            @else
            <li @if($current=="home")class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/">Home</a>
            </li>
            <li @if($current=="adm")class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/adm">Painel Administrativo</a>
            </li>

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->usuario }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>