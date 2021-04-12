<div class="sidebar" id="sidebar">
    <ul class="sidebar-links">
        <li class="tab-list"><a href="{{ route('dashboard-theme') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/home.png') }}" alt="icon">
            </span>Dashboard</a>
        </li>
        <li class="tab-list {{ Request::path() == 'container-list' ? 'active' : '' }} "><a href="{{ route('container-list') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/Shipping_Container.png') }}" alt="icon">
            </span>Storage</a>
        </li>
        <li class="tab-list {{ Request::path() == 'weightickets-list' ? 'active' : '' }}"><a href="{{ route('weightickets-list') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/Scales.png') }}" alt="icon">
            </span>Weigh tickets</a>
        </li>
        <li class="tab-list"><a href="{{ route('dashboard-theme') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/Purchase_Order.png') }}" alt="icon">
            </span>Invoices</a>
        </li>
        <li class="tab-list {{ Request::path() == 'handlingstatus' ? 'active' : '' }}"><a href="{{ route('handlingstatus') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/Fork Lift.png') }}" alt="icon">
            </span>Handling</a>
        </li>
        <li class="tab-list {{ Request::path() == 'corporate-information' ? 'active' : '' }}"><a href="{{ route('corporate-information') }}" class="link"><span class="img-icon">
            <img class="img" src="{{ asset('stylecontainer/images/Folder.png') }}" alt="icon">
        </span>Corporate information</a>
        </li>
    </ul>
    
    <div class="setting-section">
        <a href="#" class="setting"><img class="img" src="{{ asset('stylecontainer/images/setting.png') }}"
                alt="setting-img"></a>
        <span class="setting-text">Log out</span>
        <a class="log-out" href="javascript:void(0);" 
                onclick='logout();'>
            <span class="logout-img">
                <img class="img" src="{{ asset('stylecontainer/images/Shutdown.png') }}" alt="setting-img">
            </span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

