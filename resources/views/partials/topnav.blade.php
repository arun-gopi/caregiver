<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="/dashboard" id="topnav-dashboard" role="button">
                            <i data-feather="home"></i><span class="px-2">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('patients.index') }}" id="topnav-pages" role="button">
                            <i data-feather="user"></i><span class="px-2">{{ __('Patients') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="clock"></i><span class="px-2">{{ __('Schedule') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('visits.index') }}" id="topnav-pages" role="button">
                            <i data-feather="file-text"></i><span class="px-2">{{ __('Care Notes') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.company') }}" class="nav-link dropdown-toggle arrow-none" id="topnav-pages" role="button">
                            <i data-feather="settings"></i><span class="px-2">{{ __('Settings') }}</span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('business-admin'))
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="users"></i><span class="px-2">{{ __('Employees') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="users"></i><span class="px-2">{{ __('Users') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>