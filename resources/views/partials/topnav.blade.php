<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="/dashboard" id="topnav-dashboard" role="button">
                            <i data-feather="home"></i><span class="px-2">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="users"></i><span class="px-2">{{ __('Providers') }}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="#" class="dropdown-item">{{ __('List of Providers') }}</a>
                            <!--        <a href="#" class="dropdown-item">{{ __('New Provider') }}</a>   -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="user"></i><span class="px-2">{{ __('Patients') }}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="{{ route('patients.index') }}" class="dropdown-item">{{ __('List of Patients') }}</a>
                            <a href="{{ route('patients.create')}}" class="dropdown-item">{{ __('New Patient') }}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="file-text"></i><span class="px-2">{{ __('Visits') }}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="{{ route('visits.index') }}" class="dropdown-item">{{ __('List of Visits') }}</a>
                            <a href="{{ route('visits.create')}}" class="dropdown-item">{{ __('New Visit') }}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('settings.company') }}" class="nav-link dropdown-toggle arrow-none" id="topnav-pages" role="button">
                            <i data-feather="settings"></i><span class="px-2">{{ __('Settings') }}</span>
                            <!-- <div class="arrow-down"></div> -->
                        </a>
                        <!-- <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="{{ route('settings.company') }}" class="dropdown-item">{{ __('Company') }}</a>
                            <a href="#" class="dropdown-item">{{ __('Department') }}</a>
                            <a href="#" class="dropdown-item">{{ __('Designation') }}</a>
                            <a href="#" class="dropdown-item">{{ __('Title') }}</a>
                            <a href="#" class="dropdown-item">{{ __('Level') }}</a>
                            <a href="#" class="dropdown-item">{{ __('Payer') }}</a>
                        </div> -->
                    </li>
                    @if(Auth::user()->hasRole('Admin'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="command"></i><span class="px-2">{{ __('Employees') }}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="#" class="dropdown-item">{{ __('List of Employees') }}</a>
                            <a href="#" class="dropdown-item">{{ __('New Employee') }}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="at-sign"></i><span class="px-2">{{ __('Users') }}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="#" class="dropdown-item">{{ __('List of Users') }}</a>
                            <a href="#" class="dropdown-item">{{ __('New User') }}</a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>