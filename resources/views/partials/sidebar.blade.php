<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">{{ __('Menu') }}</li>

                <li>
                    <a href="/">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">{{ __('Apps') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="#">
                                <span data-key="t-calendar">{{ __('Calendar') }}</span>
                            </a>
                        </li>
        
                        <li>
                            <a href="#">
                                <span data-key="t-chat">{{ __('Chat') }}</span>
                            </a>
                        </li>
        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">{{ __('Email') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#" data-key="t-inbox">{{ __('Inbox') }}</a></li>
                                <li><a href="#" data-key="t-read-email">{{ __('Email Read') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices">{{ __('Invoices') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#" data-key="t-invoice-list">{{ __('Invoice List') }}</a></li>
                                <li><a href="#" data-key="t-invoice-detail">{{ __('Invoice Detail') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">{{ __('Authentication') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" data-key="t-login">{{ __('Login') }}</a></li>
                        <li><a href="#" data-key="t-register">{{ __('Register') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->