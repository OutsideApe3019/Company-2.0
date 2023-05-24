<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('panel.index') }}">
            {{ __("Panel") }}
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('panel.index')) active @endif" href="{{ route('panel.index') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Route::is('panel.users.*')) active @endif" href="{{ route('panel.users.index') }}">Users</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Route::is('panel.roles.*')) active @endif" href="{{ route('panel.roles.index') }}">Roles</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Route::is('panel.perms.*')) active @endif" href="{{ route('panel.perms.index') }}">Permissions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Route::is('panel.news.*')) active @endif" href="{{ route('panel.news.index') }}">News</a>
                </li>
            </ul>
        </div>
    </div>
</nav>