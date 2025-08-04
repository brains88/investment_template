<!------ sidebar ------->
<div id="sidebar">
    <div class="wallet-wrapper mt-5 pt-5">
        <div class="wallet-box d-none d-lg-block" style="margin-top:10px;">
            <h4>Account Balance</h4>
            <!--<span class="tag mb-4">USD</span> -->
            <h5>Main Balance <span>${{ $userData->balance->balance ?? 0.00 }} USD </span></h5>
            <h5 class="mb-0">Interest Balance <span>${{ $userData->balance->interest ?? 0.00}} USD</span></h5>

        </div>

        <div class="d-flex justify-content-between mt-1">
            <a class="gold-btn btn" href="{{ route('user.add-fund') }}"><i class="fa fa-wallet"></i> Deposit</a>
            <a class="gold-btn btn" href="{{ route('user.plans') }}"><i class="fa fa-usd"></i> Invest</a>
        </div>
    </div>

    <ul class="pb-4">
        <!-- list item -->
        <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}" class="sidebar-link">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        </li>
        <li class="{{ request()->routeIs('user.plans') ? 'active' : '' }}">
            <a href="{{ route('user.plans') }}" class="sidebar-link">
                <i class="fas fa-chart-line mr-3"></i> Plan
            </a>
        </li>
        <li class="{{ request()->routeIs('user.invest-history') ? 'active' : '' }}">
            <a href="{{ route('user.invest-history') }}" class="sidebar-link">
                <i class="fas fa-file-invoice-dollar mr-3"></i> Invest History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.add-fund') ? 'active' : '' }}">
            <a href="{{ route('user.add-fund') }}" class="sidebar-link">
                <i class="fas fa-money-bill-wave mr-3"></i> Add Fund
            </a>
        </li>
        <li class="{{ request()->routeIs('user.fund-history') ? 'active' : '' }}">
            <a href="{{ route('user.fund-history') }}" class="sidebar-link">
                <i class="fas fa-exchange-alt mr-3"></i> Fund History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.money-transfer') ? 'active' : '' }}">
            <a href="{{ route('user.money-transfer') }}" class="sidebar-link">
                <i class="fas fa-exchange-alt mr-3"></i> Transfer
            </a>
        </li>
        <li class="{{ request()->routeIs('user.transactions') ? 'active' : '' }}">
            <a href="{{ route('user.transactions') }}" class="sidebar-link">
                <i class="fas fa-list-ul mr-3"></i>Transaction
            </a>
        </li>
        <li class="{{ request()->routeIs('user.payout') ? 'active' : '' }}">
            <a href="{{ route('user.payout') }}" class="sidebar-link">
                <i class="fas fa-hand-holding-usd mr-3"></i> Payout </a>
        </li>
        <li class="{{ request()->routeIs('user.payout-history') ? 'active' : '' }}">
            <a href="{{ route('user.payout-history') }}" class="sidebar-link">
                <i class="fas fa-receipt mr-3"></i> Payout History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.referral') ? 'active' : '' }}">
            <a href="{{ route('user.referral') }}" class="sidebar-link">
                <i class="fas fa-user-friends mr-3"></i> My Referral
            </a>
        </li>
        <li class="{{ request()->routeIs('user.referral-bonus') ? 'active' : '' }}">
            <a href="{{ route('user.referral-bonus') }}" class="sidebar-link">
                <i class="fas fa-gift mr-3"></i> Referral Bonus
            </a>
        </li>
        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }} d-flex">
            <a href="{{ route('user.profile') }}" class="sidebar-link">
                <i class="fas fa-user-cog mr-3"></i> Profile Settings
            </a>
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

                <!-- Wallet Info -->
                <div class="wallet-box" style="display: flex; gap: 20px; align-items: center; margin-top: 0;">
                    <!-- Main Balance -->
                    <div
                        style="background: #1a1a1a; padding: 6px 12px; border-radius: 5px; display: flex; align-items: center; gap: 5px;">
                        <span
                            style="color: gold; font-weight: bold;">${{ number_format($userData->balance->balance ?? 0.00, 2) }}</span>
                        <span style="font-size: 0.8rem; color: #bbb;">Main</span>
                    </div>

                    <!-- Interest Balance -->
                    <div
                        style="background: #1a1a1a; padding: 6px 12px; border-radius: 5px; display: flex; align-items: center; gap: 5px;">
                        <span
                            style="color: #17c0eb; font-weight: bold;">${{ number_format($userData->balance->interest ?? 0.00, 2) }}</span>
                        <span style="font-size: 0.8rem; color: #bbb;">Interest</span>
                    </div>
                </div>
            </div>

            <!-- USER PROFILE -->
            <div style="margin-left: auto;">
                <div class="dropdown" style="position: relative;">
                    @php
                    $profileImage = $userData->image
                    ? asset('storage/profile_image/' . $userData->image)
                    : asset('assets/img/profile-default.jpg');
                    @endphp

                    <a href="#" class="dropdown-toggle"
                        style="display: flex; align-items: center; text-decoration: none; color: #fff; font-size: 20px;"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: #222; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.3); padding: 10px; min-width: 200px;">

                        <li style="margin-bottom: 10px;">
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}"
                                style="color: #fff; text-decoration: none; padding: 8px 10px; display: block;"
                                onmouseover="this.style.backgroundColor='#000';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i> Dashboard
                            </a>
                        </li>

                        <li style="margin-bottom: 10px;">
                            <a class="dropdown-item" href="{{ route('user.profile') }}"
                                style="color: #fff; text-decoration: none; padding: 8px 10px; display: block;"
                                onmouseover="this.style.backgroundColor='#000';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-user" style="margin-right: 10px;"></i> My Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ url('/') }}"
                                style="color: #fff; text-decoration: none; padding: 8px 10px; display: block;"
                                onmouseover="this.style.backgroundColor='#000';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ url('/') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>