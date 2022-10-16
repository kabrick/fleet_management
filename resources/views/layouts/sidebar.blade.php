<nav id="sidebar">
    <div class="sidebar-header">
        <h3><a class="navbar-brand" href="{{ url('/') }}" style="font-size: 23px">{{ config('app.name', 'Fleet Management') }}</a></h3>
    </div>

    <ul class="list-unstyled components">
        <p>Hello {{ Auth::user()->name }}</p>

        <li>
            <a href="{{ route('home') }}">View Vehicles</a>
        </li>

        <li>
            <a href="{{ route('register_vehicle') }}">Register Vehicle</a>
        </li>

        <hr>

        <li>
            <a href="{{ route('register_vehicle') }}">View Vehicle Usage</a>
        </li>
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
