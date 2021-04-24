<div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'index') active @endif" href="{{route('index')}}">
                <i class="icofont-ui-home"></i>
                {{__('siwei.menuHome')}}
            </a>
        </li>
    </ul>

    @if(Auth::user()->hasRole(['admin', 'dev']))
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        {{__('siwei.menuAdmin')}}
    </h6>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link @if(strpos(Route::currentRouteName(), 'users')) active @endif"
                href="{{route('admin.users.index')}}">
                <i class="icofont-ui-user"></i>
                {{__('siwei.menuUsers')}}
            </a>
            <a class="nav-link @if(strpos(Route::currentRouteName(), 'roles')) active @endif"
                href="{{route('admin.roles.index')}}">
                <i class="icofont-certificate"></i>
                {{__('siwei.menuRoles')}}
            </a>
        </li>
    </ul>
    @endif

    @if(Auth::user()->hasRole('dev'))
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        {{__('siwei.menuDeveloper')}}
    </h6>
    <ul class="nav flex-column">

    </ul>
    @endif
</div>
