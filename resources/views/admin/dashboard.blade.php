@extends('layouts.app')
@section('title', ' Admin Dashboard - Equitify Trades LC')

@section('content')

<!-- Admin Dashboard Stats -->
<section style="margin-top: 40px; margin-bottom: 30px;">
    <!-- Page Heading -->
    <div class="row mt-4 mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <div class="header-text-full mb-2 mb-md-0">
                <h2 class="text-uppercase" style="font-weight: 700; color: #fff; padding-top:30px;">Admin Dashboard</h2>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: flex-start;">
        @php
            $cards = [
                ['label' => 'Total Users', 'value' => $totalUsers, 'icon' => 'fas fa-users', 'color' => '#f0c75e'],
                ['label' => 'Users Total Balance', 'value' => '$' . number_format($totalBalances, 2), 'icon' => 'fas fa-wallet', 'color' => '#1abc9c'],
                ['label' => 'Interest Balance', 'value' => '$' . number_format($totalInterest, 2), 'icon' => 'fas fa-piggy-bank', 'color' => '#e67e22'],
                ['label' => 'Total Deposits', 'value' => '$' . number_format($totalDeposits, 2), 'icon' => 'fas fa-coins', 'color' => '#3498db'],
                ['label' => 'Total Withdrawals', 'value' => '$' . number_format($totalWithdrawals, 2), 'icon' => 'fas fa-money-bill-wave', 'color' => '#e74c3c'],
                ['label' => 'Total Investments', 'value' => '$' . number_format($totalInvestments, 2), 'icon' => 'fas fa-chart-line', 'color' => '#9b59b6'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div style="
                flex: 1 1 calc(25% - 25px);
                background-color: #1e1e1e;
                border-radius: 12px;
                padding: 20px;
                min-width: 220px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                text-align: center;
            ">
                <div style="font-size: 30px; color: {{ $card['color'] }}; margin-bottom: 12px;">
                    <i class="{{ $card['icon'] }}"></i>
                </div>
                <h5 style="color: #ccc; font-size: 15px;">{{ $card['label'] }}</h5>
                <h2 style="color: #fff; font-weight: bold; margin-top: 5px;">{{ $card['value'] }}</h2>
            </div>
        @endforeach
    </div>
</section>

<!-- Chart Section -->
<section class="chart-information">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-4" style="padding-top:80px !important;">
                <div style="background: #1e1e1e; border-radius: 12px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                    <h4 style="color: #f0c75e; margin-bottom: 20px;">Financial Activity Chart</h4>
                    <div id="container" class="apexcharts-canvas" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
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
            toolbar: {
                show: false
            }
        },
        colors: ['#3498db', '#e74c3c', '#9b59b6'],
        stroke: {
            width: 3,
            curve: 'smooth'
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
            categories: Object.keys(depositData).map(month => `Month ${month}`),
            labels: {
                style: {
                    colors: '#ccc'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#ccc'
                }
            }
        },
        legend: {
            labels: {
                colors: '#fff'
            }
        },
        grid: {
            borderColor: '#444'
        }
    };

    const chart = new ApexCharts(document.querySelector("#container"), chartOptions);
    chart.render();
</script>
@endpush
