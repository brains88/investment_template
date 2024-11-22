  <!------ sidebar ------->
  <div id="sidebar">
    <ul class="pb-4" style="margin-top:41% !important">        <!-- list item -->
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/layout.png" alt="Dashboard" /> Dashboard
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="sidebar-link">
                <i class='fas fa-user'></i> Users
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.invest-history') ? 'active' : '' }}">
            <a href="{{ route('admin.invest-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/growth-graph.png" alt="Invest History" /> Invest History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.fund-history') ? 'active' : '' }}">
            <a href="{{ route('admin.fund-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/fund.png" alt="Fund History" /> Fund History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.payout-history') ? 'active' : '' }}">
            <a href="{{ route('admin.payout-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Payout History" /> Payout History
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.transfer-history') ? 'active' : '' }}">
            <a href="{{ route('admin.transfer-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Payout History" /> Transfer History
            </a>
        </li>
        <li class="{{ request()->routeIs('wallets.index') ? 'active' : '' }}">
            <a href="{{ route('wallets.index') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Payout History" /> Wallets
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.plans') ? 'active' : '' }}">
            <a href="{{ route('admin.plans') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Payout History" /> Plans
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.referrals') ? 'active' : '' }}">
            <a href="{{ route('admin.referrals') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/bonus.png" alt="Referral Bonus" />User  Referral
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }} d-flex">
            <a href="{{ route('admin.profile') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/setting.png" alt="Profile Settings" /> Profile Settings
            </a>
        </li>
    </ul>
 </div>

        <!------- Nav + Content ---------->
        <div id="content">
           <div class="overlay">
              <!----- navbar ------>
              <nav class="navbar navbar-expand-lg fixed-top">
                 <div class="container-fluid">
                    <a class="navbar-brand golden-text" href="{{ route('admin.dashboard') }}">
                    <h4 style="font-weight:bold; text-transform:Italics">Equitify Trades Lc</h4>
                    </a>
                    <button
                       type="button"
                       id="sidebarCollapse"
                       class="sidebar-toggler p-0"
                    >
                       <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/hamburger.png" alt="hamburger image"/>
                    </button>

                    <span class="navbar-text" id="pushNotificationArea">
                       <!---- notification panel ---->
                       
                       <!---- admin panel ---->
                       <div class="notification-panel admin-panel">
                       <button class="dropdown-toggle">
                           <h4>Admin</h4>
                        </button>

                            <ul class="notification-dropdown admin-dropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/layout.png" alt="Dashboard"/>
                                        <span class="golden-text">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/profile.png" alt="My Profile"/>
                                        <span class="golden-text">My Profile</span>
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <a class="dropdown-item" href="https://www.equitytradeslc.com/admin/twostep-security">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack//img/icon/padlock.png" alt="2FA Security"/>
                                        <span class="golden-text">2FA Security</span>
                                    </a>
                                </li>
                                -->
                                <li>
                                <a class="dropdown-item" href="{{ url('/') }}">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack//img/icon/log-out.png" alt="Logout"/>
                                        <span class="golden-text">Logout</span>
                                    </a>
                                    <form id="logout-form" action="https://www.equitytradeslc.com/logout" method="POST" class="d-none">
                                        <input type="hidden" name="_token" value="DALvAApQxVDTCi5D8Z1R0zerqJefue8Itw015cIl">                                    </form>
                                </li>
                            </ul>
                       </div>
                    </span>
                 </div>
              </nav>