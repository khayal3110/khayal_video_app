
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    @if(Auth::user()->role == 'admin')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin-dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Magiscriptor</div>
        </a>
    @else
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user-dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Magiscriptor</div>
        </a>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if(Auth::user()->role == 'admin')
        <li class="nav-item @php echo (Request::segment(2) == 'dashboard' ? 'active' : ''); @endphp ">
            <a class="nav-link" href="{{ route('admin-dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>
        {{-- <li class="nav-item @php echo (Request::segment(2) == 'categories' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('categories') }}">
                <i class="fas fa-list-ul" aria-hidden="true"></i>
                <span>{{ __('Category Managment') }}</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item @php echo (Request::segment(2) == 'campaigns' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('admin-campaign') }}">
                <i class="fas fa-fw fa-wrench"></i>
                <span>{{ __('Campaign Managment') }}</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item @php echo (Request::segment(2) == 'ads' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('admin-ads') }}">
                <i class='fas fa-bullhorn'></i>
                <span>{{ __('Ads Managment') }}</span>
            </a>
        </li> --}}
        <li class="nav-item @php echo (Request::segment(2) == 'users' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('users') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('Users') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(2) == 'users' ? '' : ''); @endphp">
            <a class="nav-link" href="{{ route('payment-list') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('Payment list') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(2) == 'users' ? '' : ''); @endphp">
            <a class="nav-link" href="{{ route('log-history') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('Log History') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(2) == 'users' ? '' : ''); @endphp">
            <a class="nav-link" href="{{ route('coupon-list') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('Coupon') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(2) == 'dislike' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{route('dislike-list')}}">
                <i class="fas fa-user" aria-hidden="true"></i>
                <span>{{ __('Dislike & Description') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(3) == 'add' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('add-affiliate') }}">
                <i class="fas fa-user" aria-hidden="true"></i>
                <span>{{ __('Affiliate Percentage') }}</span>
            </a>
        </li>
        <li class="nav-item @php echo (Request::segment(2) == 'users' ? '' : ''); @endphp">
            <a class="nav-link" href="{{ route('advertisement-section') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('Advertisement') }}</span>
            </a>
        </li>
        <!-- <li class="nav-item @php echo (Request::segment(2) == 'users' ? '' : ''); @endphp">
            <a class="nav-link" href="{{ route('news-section') }}">
                <i class="fas fa-user" aria-hidden="true"></i>

                <span>{{ __('News') }}</span>
            </a>
        </li> -->
        


        {{-- <li class="nav-item @php echo (Request::segment(2) == 'scripts' ? 'active' : ''); @endphp">
            <a class="nav-link" href="{{ route('scripts') }}">
                <i class="fa fa-code" aria-hidden="true"></i>
                <span>{{ __('Script Managment') }}</span>
            </a>
        </li> --}}
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user-dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:;">
                <i class="fas fa-fw fa-wrench"></i>
                <span>{{ __('Campaign Managment') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:;">
                <i class='fas fa-bullhorn'></i>
                <span>{{ __('Ads Managment') }}</span>
            </a>
        </li>
       
    @endif
    

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        {{ __('Settings') }}
    </div> -->

    <!-- Nav Item - Profile -->
    <!-- <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li> -->

    <!-- Nav Item - About -->
    <!-- <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link" href="{{ route('about') }}">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>{{ __('About') }}</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
           
</ul>