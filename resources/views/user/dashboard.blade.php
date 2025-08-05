@extends('layouts.app')
@section('title', ' Dashboard - Equitify Trades LC')

@section('content')
<!-- Dashboard Cards Section -->
<section style="margin-top: 40px; margin-bottom: 30px; padding: 0 15px;">
    <!-- Page Heading -->
    <div class="row mt-4">
        <div
            class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <!-- Heading -->
            <div class="header-text-full mb-2 mb-md-0">
                <h2 class="text-uppercase" style="font-weight: 700;">Dashboard</h2>
            </div>

            <!-- Button to open modal -->
            <button type="button" class="btn gold-btn mb-3" data-bs-toggle="modal"
                data-bs-target="#transferInterestModal">
                Transfer Interest
            </button>
        </div>
    </div>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">

        <!-- Main Balance -->
        <div
            style="flex: 1 1 calc(25% - 20px); background-color: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #fff; margin-bottom: 15px;">
                <i class="fas fa-wallet"></i>
            </div>
            <h5 style="color: #ccc; margin-bottom: 5px;">Main Balance</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $balance->balance ?? 0.00 }}</h2>
        </div>

        <!-- Interest Balance -->
        <div
            style="flex: 1 1 calc(25% - 20px); background-color: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #fff; margin-bottom: 15px;">
                <i class="fas fa-piggy-bank"></i>
            </div>
            <h5 style="color: #ccc; margin-bottom: 5px;">Interest Balance</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $balance->interest ?? 0.00 }}
            </h2>
        </div>

        <!-- Total Deposit -->
        <div
            style="flex: 1 1 calc(25% - 20px); background-color: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #fff; margin-bottom: 15px;">
                <i class="fas fa-coins"></i>
            </div>
            <h5 style="color: #ccc; margin-bottom: 5px;">Total Deposit</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $deposit ?? 0.00 }}</h2>
        </div>

        <!-- Total Earn -->
        <div
            style="flex: 1 1 calc(25% - 20px); background-color: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #fff; margin-bottom: 15px;">
                <i class="fas fa-chart-line"></i>
            </div>
            <h5 style="color: #ccc; margin-bottom: 5px;">Total ROI Earned</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $TotalEarn ?? 0.00 }}</h2>
        </div>

    </div>
</section>

<!---- charts ----->
<!-- Chart + Circular Stats -->
<section style="margin-top: 60px;">
    <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 0 15px;">

        <!-- Chart Section -->
        <div style="margin-top: 40px; background: #1e1e1e; padding: 20px; border-radius: 10px;">
            <h3 style="color: #f0c75e; margin-bottom: 20px;">Monthly Financial Overview</h3>
            <div id="chart" style="min-height: 300px;"></div>
        </div>

        <!-- Circular Progress Cards -->
        <div style="flex: 1 1 480px; background: #1e1e1e; border-radius: 10px; padding: 15px 10px;">
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 15px;">

                <!-- Invest Completed -->
                <div
                    style="background: #2a2a2a; border-radius: 10px; padding: 20px; width: 200px; min-height: 180px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <svg class="radial-progress" data-percentage="{{ $investPercentage }}" viewBox="0 0 80 80"
                        width="100" height="100">
                        <circle class="incomplete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #333; stroke-width: 6;"></circle>
                        <circle class="complete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #f8b739; stroke-width: 6; stroke-dasharray: 188; stroke-dashoffset: {{ 188 - ($investPercentage * 1.88) }};">
                        </circle>
                        <text x="50%" y="53%" text-anchor="middle" fill="#fff"
                            font-size="12">{{ $investPercentage }}%</text>
                    </svg>
                    <h5 style="color: #f8b739; margin-top: 12px; font-size: 13px;">Invest Completed</h5>
                </div>

                <!-- ROI Earned -->
                <div
                    style="background: #2a2a2a; border-radius: 10px; padding: 20px; width: 200px; min-height: 180px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <svg class="radial-progress" data-percentage="{{ $roiPercentage }}" viewBox="0 0 80 80" width="100"
                        height="100">
                        <circle class="incomplete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #333; stroke-width: 6;"></circle>
                        <circle class="complete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #1abc9c; stroke-width: 6; stroke-dasharray: 188; stroke-dashoffset: {{ 188 - ($roiPercentage * 1.88) }};">
                        </circle>
                        <text x="50%" y="53%" text-anchor="middle" fill="#fff"
                            font-size="12">{{ $roiPercentage }}%</text>
                    </svg>
                    <h5 style="color: #1abc9c; margin-top: 12px; font-size: 13px;">ROI Earned</h5>
                </div>

                <!-- ROI Speed -->
                <div
                    style="background: #2a2a2a; border-radius: 10px; padding: 20px; width: 200px; min-height: 180px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <svg class="radial-progress" data-percentage="{{ $roiSpeed }}" viewBox="0 0 80 80" width="100"
                        height="100">
                        <circle class="incomplete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #333; stroke-width: 6;"></circle>
                        <circle class="complete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #3498db; stroke-width: 6; stroke-dasharray: 188; stroke-dashoffset: {{ 188 - ($roiSpeed * 1.88) }};">
                        </circle>
                        <text x="50%" y="53%" text-anchor="middle" fill="#fff" font-size="12">{{ $roiSpeed }}%</text>
                    </svg>
                    <h5 style="color: #3498db; margin-top: 12px; font-size: 13px;">ROI Speed</h5>
                </div>

                <!-- ROI Earned -->
                <div style="text-align: center;">
                    <svg class="radial-progress" data-percentage="{{ $roiPercentage }}" viewBox="0 0 80 80" width="100"
                        height="100">
                        <circle class="incomplete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #333; stroke-width: 6;"></circle>
                        <circle class="complete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #1abc9c; stroke-width: 6; stroke-dasharray: 188; stroke-dashoffset: {{ 188 - ($roiPercentage * 1.88) }};">
                        </circle>
                        <text x="50%" y="53%" text-anchor="middle" fill="#fff"
                            font-size="12">{{ $roiPercentage }}%</text>
                    </svg>
                    <h5 style="color: #1abc9c; margin-top: 8px; font-size: 13px;">ROI Earned</h5>
                </div>

                <!-- ROI Speed -->
                <div style="text-align: center;">
                    <svg class="radial-progress" data-percentage="{{ $roiSpeed }}" viewBox="0 0 80 80" width="100"
                        height="100">
                        <circle class="incomplete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #333; stroke-width: 6;"></circle>
                        <circle class="complete" cx="40" cy="40" r="30"
                            style="fill: none; stroke: #3498db; stroke-width: 6; stroke-dasharray: 188; stroke-dashoffset: {{ 188 - ($roiSpeed * 1.88) }};">
                        </circle>
                        <text x="50%" y="53%" text-anchor="middle" fill="#fff" font-size="12">{{ $roiSpeed }}%</text>
                    </svg>
                    <h5 style="color: #3498db; margin-top: 8px; font-size: 13px;">ROI Speed</h5>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Account Statistics Cards -->
<section style="margin-top: 80px; padding: 0 15px;">
    <h2 style="text-align: center; color: #fff; margin-bottom: 30px; font-size: 28px; padding-top: 15px;">
        Account Statistics</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

        <!-- Total Invest -->
        <div
            style="flex: 1 1 calc(25% - 20px); background: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #f1c40f; margin-bottom: 15px;">
                <i class="fas fa-piggy-bank"></i>
            </div>
            <h5 style="color: #ccc;">Total Invest</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $investment ?? 0.00 }}</h2>
        </div>

        <!-- Total Payout -->
        <div
            style="flex: 1 1 calc(25% - 20px); background: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #e74c3c; margin-bottom: 15px;">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <h5 style="color: #ccc;">Total Payout</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $withdrawal ?? 0.00 }}</h2>
        </div>

        <!-- Total Referral Bonus -->
        <div
            style="flex: 1 1 calc(25% - 20px); background: #222; border-radius: 10px; padding: 20px; text-align: center; min-width: 220px;">
            <div style="font-size: 30px; color: #9b59b6; margin-bottom: 15px;">
                <i class="fas fa-gift"></i>
            </div>
            <h5 style="color: #ccc;">Referral Bonus</h5>
            <h2 style="color: #fff; font-weight: bold; padding-top: 10px;">${{ $referralBonous ?? 0.00 }}</h2>
        </div>
    </div>
</section>

<!-- Referral Section -->
<section style="margin-top: 80px; padding: 0 15px;">
    <div style="background: #1e1e1e; border-radius: 10px; padding: 20px; margin-bottom: 40px;">
        <h4 style="color: #f8b739; margin-bottom: 15px;">Referral Link</h4>
        <div style="display: flex; gap: 10px;">
            <input type="text" value="{{ auth()->user()->referral_link }}" readonly
                style="flex-grow: 1; padding: 10px; border-radius: 5px; border: none;">
            <button onclick="copyFunction()"
                style="background: #f8b739; border: none; padding: 10px 15px; border-radius: 5px; color: #000; font-weight: bold;">
                <i class="fa fa-copy"></i> Copy
            </button>
        </div>
    </div>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <!-- Latest Partner -->
        <div style="flex: 1 1 300px; background: #222; border-radius: 10px; padding: 20px;">
            <div style="font-size: 24px; color: #1abc9c; margin-bottom: 10px;">
                <i class="fas fa-user-plus"></i>
            </div>
            <h4 style="color: #f8b739;">Latest Partner</h4>
            <p style="color: #ccc;">
                @if($latestReferral && $latestReferral->referredUser)
                {{ $latestReferral->referredUser->username }} - {{ $latestReferral->referredUser->email }}
                @else
                No referrals yet.
                @endif
            </p>
        </div>

        <!-- Last Referral Bonus -->
        <div style="flex: 1 1 300px; background: #222; border-radius: 10px; padding: 20px;">
            <div style="font-size: 24px; color: #9b59b6; margin-bottom: 10px;">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <h4 style="color: #f8b739;">Last Referral Bonus</h4>
            <p style="color: #ccc;">
                @if($latestReferral)
                ${{ number_format($latestReferral->referral_bonus, 2) }}
                @else
                No bonus yet.
                @endif
            </p>
        </div>
    </div>
</section>


<!-- Transfer Interest Modal -->
<div class="modal fade" id="transferInterestModal" tabindex="-1" aria-labelledby="transferInterestModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer from Interest Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                

                <!-- Interest balance display -->
                <p><strong>Interest Balance To Balance:</strong>
                    <span id="interestBalance" style="color: #17c0eb; font-weight: bold; font-size:17px;">
                        ${{ number_format($userData->balance->interest ?? 0.00, 2) }}
                    </span>
                </p>

                <!-- Transfer form -->
                <form id="interestTransferForm">
                    @csrf
                    <div class="mb-3">
                        <label for="transferAmount" class="form-label">Amount to Transfer</label>
                        <input type="number" class="form-control" name="amount" id="transferAmount" required min="1"
                            step="0.01">
                    </div>
                    <!-- Success/Error messages -->
                <div id="transferMessage" class="mb-2"></div>



                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                        <button type="submit" class="btn btn-success w-100 w-sm-auto" id="submitTransferBtn">
                            <span class="spinner-border spinner-border-sm d-none" id="transferSpinner" role="status"
                                aria-hidden="true"></span>
                            Transfer
                        </button>
                        <button type="button" class="btn btn-danger w-100 w-sm-auto"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>





            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
document.addEventListener("DOMContentLoaded", function () {
    const depositData = @json($depositData ?? []);
    const withdrawalData = @json($withdrawalData ?? []);
    const investmentData = @json($investmentData ?? []);

    const months = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const depositValues = months.map((_, i) => depositData[i + 1] || 0);
    const withdrawalValues = months.map((_, i) => withdrawalData[i + 1] || 0);
    const investmentValues = months.map((_, i) => investmentData[i + 1] || 0);

    const options = {
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false },
            background: '#1e1e1e'
        },
        theme: { mode: 'dark' },
        colors: ['#f7931a', '#f01010', '#ff4800'],
        dataLabels: { enabled: false },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        series: [
            { name: 'Investment', data: investmentValues },
            { name: 'Withdrawal', data: withdrawalValues },
            { name: 'Deposit', data: depositValues }
        ],
        xaxis: {
            categories: months,
            labels: { style: { colors: '#ccc' } }
        },
        yaxis: {
            labels: { style: { colors: '#ccc' } }
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: (val) => `$${val}`
            }
        },
        legend: {
            labels: { colors: '#fff' }
        }
    };

    const chartEl = document.querySelector("#chart");
    if (chartEl) {
        const chart = new ApexCharts(chartEl, options);
        chart.render();
    } else {
        console.error("#chart element not found");
    }
});
//for Interest Balance Transfer
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('interestTransferForm');
    const btn = document.getElementById('submitTransferBtn');
    const spinner = document.getElementById('transferSpinner');
    const messageBox = document.getElementById('transferMessage');
    const interestBalanceDisplay = document.getElementById('interestBalance');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        messageBox.innerHTML = '';
        messageBox.className = 'mt-3';

        spinner.classList.remove('d-none');
        btn.disabled = true;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData(form);

            const response = await fetch("{{ route('user.transfer.interest') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.status === 'success') {
                messageBox.classList.add('alert', 'alert-success');
                messageBox.innerHTML = data.message || 'Transfer successful.';

                if (data.updatedInterest !== undefined) {
                    interestBalanceDisplay.textContent = `$${data.updatedInterest}`;
                }

                form.reset();

                // Optional fade out
                setTimeout(() => {
                    messageBox.className = 'mt-3';
                    messageBox.innerHTML = '';
                }, 5000);
            } else {
                messageBox.classList.add('alert', 'alert-danger');
                messageBox.innerHTML = data.message || 'Transfer failed.';
            }

        } catch (error) {
            console.error('Error:', error);
            messageBox.classList.add('alert', 'alert-danger');
            messageBox.innerHTML = 'Something went wrong. Please try again.';
        } finally {
            spinner.classList.add('d-none');
            btn.disabled = false;
        }
    });
});
</script>
@endpush