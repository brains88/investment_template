<!------ sidebar ------->
<div id="sidebar">
    <div class="wallet-wrapper mt-5 pt-5">
        <div class="wallet-box d-none d-lg-block" style="margin-top:10px;">
            <h4 style="font-size:1.8rem; color:#fff; font-weight:bold;">Equitify Trades</h4>

        </div>

    </div>

    <ul class="pb-4">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="sidebar-link">
                <i class="fas fa-users"></i> Users
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.invest-history') ? 'active' : '' }}">
            <a href="{{ route('admin.invest-history') }}" class="sidebar-link">
                <i class="fas fa-chart-line"></i> Invest History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.fund-history') ? 'active' : '' }}">
            <a href="{{ route('admin.fund-history') }}" class="sidebar-link">
                <i class="fas fa-wallet"></i> Fund History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.payout-history') ? 'active' : '' }}">
            <a href="{{ route('admin.payout-history') }}" class="sidebar-link">
                <i class="fas fa-money-bill-wave"></i> Payout History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.transfer-history') ? 'active' : '' }}">
            <a href="{{ route('admin.transfer-history') }}" class="sidebar-link">
                <i class="fas fa-exchange-alt"></i> Transfer History
            </a>
        </li>
        <li class="{{ request()->routeIs('wallets.index') ? 'active' : '' }}">
            <a href="{{ route('wallets.index') }}" class="sidebar-link">
                <i class="fas fa-piggy-bank"></i> Wallets
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.plans') ? 'active' : '' }}">
            <a href="{{ route('admin.plans') }}" class="sidebar-link">
                <i class="fas fa-list-alt"></i> Plans
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.referrals') ? 'active' : '' }}">
            <a href="{{ route('admin.referrals') }}" class="sidebar-link">
                <i class="fas fa-users-cog"></i> User Referral
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="sidebar-link">
                <i class="fas fa-user-cog"></i> Profile Settings
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #fff; text-decoration: none;">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

<!------- Nav + Content ---------->
<div id="content">
    <div class="overlay">
        <!----- navbar ------>
        <!-- NAVBAR (no duplicate) -->
        <nav class="navbar fixed-top"
            style="background: #000; color: #fff; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; width: 100%; z-index: 1000;">

            <!-- Sidebar Toggler + Wallet Info -->
            <div style="display: flex; align-items: center;">
                <!-- Sidebar Toggler -->
                <button type="button" id="sidebarCollapse" style="background: none; border: none; margin-right: 20px;">
                    <img src="{{ asset('assets/themes/deepblack/img/icon/hamburger.png') }}" alt="hamburger"
                        style="width: 24px;">
                </button>
            </div>

            <!-- USER PROFILE -->
            <div style="margin-left: auto;">
                <div class="dropdown" style="position: relative;">
                    @php
                    $profileImage = auth()->user()->image
                    ? asset('storage/profile_image/' . auth()->user()->image)
                    : asset('assets/img/profile-default.jpg');
                    @endphp

                    <a href="#" class="dropdown-toggle"
                        style="display: flex; align-items: center; text-decoration: none; color: #fff; font-size: 20px;"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-shield"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: #222; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.3); padding: 10px; min-width: 200px;">

                        <li style="margin-bottom: 10px;">
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                style="color: #fff; text-decoration: none; padding: 8px 10px; display: block;"
                                onmouseover="this.style.backgroundColor='#000';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i> Dashboard
                            </a>
                        </li>

                        <li style="margin-bottom: 10px;">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}"
                                style="color: #fff; text-decoration: none; padding: 8px 10px; display: block;"
                                onmouseover="this.style.backgroundColor='#000';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-user" style="margin-right: 10px;"></i> My Profile
                            </a>
                        </li>

                        <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        style="color: #fff; text-decoration: none;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>