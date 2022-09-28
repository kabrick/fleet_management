<nav id="sidebar">
    <div class="sidebar-header">
        <h3><a class="navbar-brand" href="{{ url('/') }}" style="font-size: 23px">{{ config('app.name', 'Fleet Management') }}</a></h3>
    </div>

    <ul class="list-unstyled components">
        <p>Hello {{ Auth::user()->name }}</p>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a class="download" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
