<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{-- {{ config('app.name', 'Admin') }} --}}
            {{ __('Kezelőfelület') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="navbar-nav mr-auto">
                    @can('see admins')
                      <li class="nav-item {{ Request::is('admins*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admins') }}">{{ __('Adminisztrátorok') }}</a>
                      </li>
                    @endcan
                     @can('see editors')
                      <li class="nav-item {{ Request::is('editors*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('editors') }}">{{ __('Tartalomszerkesztők') }}</a>
                      </li>
                    @endcan
                    @can('see users')
                      <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users') }}">{{ __('Felhasználók') }}</a>
                      </li>
                    @endcan
                </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Bejelentkezés') }}</a></li>
                    {{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Regisztáció') }}</a></li> --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Kijelentkezés') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>