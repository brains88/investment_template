@include('layout.header') <!-- Header Component -->

<body  >
    <div class="wrapper">
      
    @include('layout.usernavbar')
 <!------------- others main dashboard body content ------------>
              
    <!---- other balances ----->
    <section class="statistic-section mt-5 pt-5 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/fund.png" alt="Main Balance"/>
                        </div>
                        <h4>Main Balance</h4>
                        <h2>
                            ${{ $balance->balance ?? 0.00 }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/money-bag.png" alt="Interest Balance"/>
                        </div>
                        <h4>Interest Balance</h4>
                        <h2>
                            ${{ $balance->interest ?? 0.00 }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/invest.png" alt="Total Deposit"/>
                        </div>
                        <h4>Total Deposit</h4>
                        <h2>
                            ${{ $deposit ?? 0.00 }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/pay-history.png" alt="Total Earn"/>
                        </div>
                        <h4>Total Earn</h4>
                        <h2>
                            ${{ $TotalEarn ?? 0.00 }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---- charts ----->
    <section class="chart-information mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="progress-wrapper">
                        <div
                            id="container"
                            class="apexcharts-canvas"
                        ></div>
                    </div>
                </div>
                <div class="col-lg-6">
            <div class="progress-wrapper progress-wrapper-circle">
                <div class="progress-container d-flex flex-column flex-sm-row justify-content-around">
                    <!-- Investment Completed -->
                    <div class="circular-progress cp_1">
                        <svg class="radial-progress" data-percentage="{{ $investPercentage }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" 
                                style="stroke-dashoffset: {{ 220 - ($investPercentage * 2.2) }};">
                            </circle>
                            <text class="percentage" x="50%" y="53%" transform="matrix(0, 1, -1, 0, 80, 0)">
                                {{ $investPercentage }} %
                            </text>
                        </svg>
                        <h4 class="golden-text mt-4 text-center">Invest Completed</h4>
                    </div>

                    <!-- ROI Earned -->
                    <div class="circular-progress cp_3">
                        <svg class="radial-progress" data-percentage="{{ $roiPercentage }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" 
                                style="stroke-dashoffset: {{ 220 - ($roiPercentage * 2.2) }};">
                            </circle>
                            <text class="percentage" x="50%" y="53%" transform="matrix(0, 1, -1, 0, 80, 0)">
                                {{ $roiPercentage }} %
                            </text>
                        </svg>
                        <h4 class="golden-text mt-4 text-center">ROI Earned</h4>
                    </div>

                    <!-- ROI Speed -->
                    <div class="circular-progress cp_2">
                        <svg class="radial-progress" data-percentage="{{ $roiSpeed }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" 
                                style="stroke-dashoffset: {{ 220 - ($roiSpeed * 2.2) }};">
                            </circle>
                            <text class="percentage" x="50%" y="53%" transform="matrix(0, 1, -1, 0, 80, 0)">
                                {{ $roiSpeed }} %
                            </text>
                        </svg>
                        <h4 class="golden-text mt-4 text-center">ROI Speed</h4>
                    </div>
                </div>
            </div>
        </div>



    <!----- account balances ----->
    <section class="statistic-section mt-5 pt-5 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2 class="text-center">Account Statistics</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/money-bag.png" alt="Total Invest"/>
                        </div>
                        <h4>Total Invest</h4>
                        <h2>
                            ${{ $investment ?? 0.00 }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/payout.png" alt="Total Payout"/>
                        </div>
                        <h4>Total Payout</h4>
                        <h2>
                            ${{ $withdrawal ?? 0.00 }}
                        </h2>
                    </div>
                </div>
                <!--
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/support.png" alt="Total Ticket"/>
                        </div>
                        <h4>Total Ticket</h4>
                        <h2>0</h2>
                    </div>
                </div>
                -->
                <div class="col-md-6 col-lg-3">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/bonus.png" alt="Total Referral Bonus"/>
                        </div>
                        <h4>Total Referral Bonus</h4>
                        <h2>
                            ${{ $referralBonous ?? 0.00 }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!----- refferal-information ----->
    <section class="refferal-link mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="box">
                        <h4 class="golden-text">Referral Link</h4>
                        <div class="input-group">
                        <input
                        type="text"
                        value="{{ auth()->user()->referral_link }}"
                        class="form-control"
                        id="sponsorURL"
                        readonly
                    />

                            <button class="gold-btn copytext" id="copyBoard" onclick="copyFunction()"><i
                                    class="fa fa-copy mx-1"></i>copy link</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4 mb-md-0 refferal-information mt-5">
                        <div class="box">
                            <div class="img-box">
                                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/handshake.png" alt="handshake img"/>
                            </div>
                            <div>
                                <h4 class="golden-text">Latest Registered Partner</h4>
                                <p>
                                    @if($latestReferral && $latestReferral->referredUser)
                                        {{ $latestReferral->referredUser->username}}
                                        <span class="pe-2">Email: {{ $latestReferral->referredUser->email }}</span>
                                    @else
                                        No referrals yet.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 refferal-information mt-5">
                        <div class="box">
                            <div class="img-box">
                                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/deposit.png" alt="Referral Bonus img"/>
                            </div>
                            <div>
                                <h4 class="golden-text">The Last Referral Bonus</h4>
                                <p>
                                    @if($latestReferral)
                                        ${{ number_format($latestReferral->referral_bonus, 2) }}
                                    @else
                                        No bonus yet.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </section>


           </div>
        </div>
    </div>


    @include('layout.footer') 
   

    <script src="https://www.equitytradeslc.com/assets/themes/deepblack/js/apexcharts.js"></script>


    <script>
    "use strict";

    const depositData = @json($depositData);
    const withdrawalData = @json($withdrawalData);
    const investmentData = @json($investmentData);

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    // Map the data to ensure it aligns with each month (fill with 0 for missing months)
    const depositValues = months.map((_, index) => depositData[index + 1] || 0);
    const withdrawalValues = months.map((_, index) => withdrawalData[index + 1] || 0);
    const investmentValues = months.map((_, index) => investmentData[index + 1] || 0);

    var options = {
        theme: {
            mode: 'dark',
        },
        series: [
            {
                name: "Investment",
                color: 'rgba(247, 147, 26, 1)',
                data: investmentValues
            },
            {
                name: "Payout (Withdrawal)",
                color: 'rgba(240, 16, 16, 1)',
                data: withdrawalValues
            },
            {
                name: "Deposit",
                color: 'rgba(255, 72, 0, 1)',
                data: depositValues
            }
        ],
        chart: {
            type: 'bar',
            background: '#000',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: months,
        },
        yaxis: {
            title: {
                text: ""
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            colors: ['#000'],
            y: {
                formatter: function (val) {
                    return "$" + val + ""
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#container"), options);
    chart.render();



        function copyFunction() {
            var copyText = document.getElementById("sponsorURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>

<!-- Popup Code Start 
<div class="popup-overlay">
    <div class="popup-content">
        <h1>CONGRATULATIONS BLUEDRAKE1942</h1>
        <p>You are now elgible to enroll in our Yearly Diamond Plat Promo plan, earn a whopping 55% Increase on your ROI(RETURN ON INVESTMENT) when you upgrade your account to meet the $50 000 Threshold.!</p>
        <button onclick="closePopup()">Close</button>
    </div>
</div>

<style>
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .popup-content {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 80%;
    }

    .popup-content h1 {
        color: red;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .popup-content p {
        font-size: 18px;
        color: #333;
    }

    .popup-content button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup-content button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    function closePopup() {
        document.querySelector('.popup-overlay').style.display = 'none';
    }

    // Automatically show the popup when the page loads
    window.onload = function() {
        document.querySelector('.popup-overlay').style.display = 'flex';
    }
</script>
<!-- Popup Code End -->

</body>
</html>
