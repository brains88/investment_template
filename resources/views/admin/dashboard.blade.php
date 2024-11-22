@include('layout.header') <!-- Header Component -->

<body>
    <div class="wrapper">
        @include('layout.adminnavbar') <!-- Navbar Component -->

        <!-- Admin Dashboard -->
        <section class="statistic-section mt-5 pt-5 pb-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Admin Dashboard</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <a href="{{ route('admin.users') }}">
                        <div class="box">
                            <h4>Total Users</h4>
                            <h2>{{ $totalUsers }}</h2>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4>Users Total Balance</h4>
                            <h2>${{ number_format($totalBalances, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4>Users Total Interest Balance</h4>
                            <h2>${{ number_format($totalInterest, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0 mb-3">
                        <div class="box">
                            <h4>Users Total Deposit</h4>
                            <h2>${{ number_format($totalDeposits, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mt-3">
                        <div class="box">
                            <h4>Users Total Withdrawals</h4>
                            <h2>${{ number_format($totalWithdrawals, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-3">
                        <div class="box">
                            <h4>Users Total Investment</h4>
                            <h2>${{ number_format($totalInvestments, 2) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Charts -->
        <section class="chart-information mt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <div id="container" class="apexcharts-canvas"></div>
                    </div>
                  </div>
                </div>
            </div>
        </section>

        @include('layout.footer') <!-- Footer Component -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        "use strict";

        const depositData = @json($monthlyDeposits);
        const withdrawalData = @json($monthlyWithdrawals);
        const investmentData = @json($monthlyInvestments);

        const chartOptions = {
            chart: {
                type: 'line',
                height: 350,
            },
            series: [
                {
                    name: 'Deposits',
                    data: Object.values(depositData)
                },
                {
                    name: 'Withdrawals',
                    data: Object.values(withdrawalData)
                },
                {
                    name: 'Investments',
                    data: Object.values(investmentData)
                }
            ],
            xaxis: {
                categories: Object.keys(depositData).map(month => `Month ${month}`)
            }
        };

        const chart = new ApexCharts(document.querySelector("#container"), chartOptions);
        chart.render();
    </script>
</body>
