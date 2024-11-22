  <!------ sidebar ------->
  <div id="sidebar">
            <div class="wallet-wrapper">
            <div class="wallet-box d-none d-lg-block" style="margin-top:80px;">
            <h4>Account Balance</h4>
            <h5>Main Balance <span>${{ $userData->balance->balance ?? 0.00 }}</span></h5>
            <h5 class="mb-0">Interest Balance <span>${{ $userData->balance->interest ?? 0.00}}</span></h5>
            <span class="tag">USD</span>
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
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/layout.png" alt="Dashboard" /> Dashboard
            </a>
        </li>
        <li class="{{ request()->routeIs('user.plans') ? 'active' : '' }}">
            <a href="{{ route('user.plans') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/growth-graph.png" alt="Plan" /> Plan
            </a>
        </li>
        <li class="{{ request()->routeIs('user.invest-history') ? 'active' : '' }}">
            <a href="{{ route('user.invest-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/growth-graph.png" alt="Invest History" /> Invest History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.add-fund') ? 'active' : '' }}">
            <a href="{{ route('user.add-fund') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/money-bag.png" alt="Add Fund" /> Add Fund
            </a>
        </li>
        <li class="{{ request()->routeIs('user.fund-history') ? 'active' : '' }}">
            <a href="{{ route('user.fund-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/fund.png" alt="Fund History" /> Fund History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.money-transfer') ? 'active' : '' }}">
            <a href="{{ route('user.money-transfer') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/money-transfer.png" alt="Transfer" /> Transfer
            </a>
        </li>
        <li class="{{ request()->routeIs('user.transactions') ? 'active' : '' }}">
            <a href="{{ route('user.transactions') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/transaction.png" alt="Transaction" /> Transaction
            </a>
        </li>
        <li class="{{ request()->routeIs('user.payout') ? 'active' : '' }}">
            <a href="{{ route('user.payout') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/payout.png" alt="Payout" /> Payout
            </a>
        </li>
        <li class="{{ request()->routeIs('user.payout-history') ? 'active' : '' }}">
            <a href="{{ route('user.payout-history') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Payout History" /> Payout History
            </a>
        </li>
        <li class="{{ request()->routeIs('user.referral') ? 'active' : '' }}">
            <a href="{{ route('user.referral') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/refferal.png" alt="My Referral" /> My Referral
            </a>
        </li>
        <li class="{{ request()->routeIs('user.referral-bonus') ? 'active' : '' }}">
            <a href="{{ route('user.referral-bonus') }}" class="sidebar-link">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/bonus.png" alt="Referral Bonus" /> Referral Bonus
            </a>
        </li>
        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }} d-flex">
            <a href="{{ route('user.profile') }}" class="sidebar-link">
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
                    <a class="navbar-brand golden-text" href="{{ route('user.dashboard') }}">
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
                       
                       <!---- user panel ---->
                       <div class="notification-panel user-panel">
                       <button class="dropdown-toggle">
                            <img src="{{ asset('storage/profile_images/' . $userData->image) }}" class="user-image" alt="user img" />
                        </button>

                            <ul class="notification-dropdown user-dropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/layout.png" alt="Dashboard"/>
                                        <span class="golden-text">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/profile.png" alt="My Profile"/>
                                        <span class="golden-text">My Profile</span>
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <a class="dropdown-item" href="https://www.equitytradeslc.com/user/twostep-security">
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