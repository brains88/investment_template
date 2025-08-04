@extends('layouts.app')
@section('title', 'Funds History - Equitify Trades LC')

@section('content')

<!-- Fund history -->
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>Fund History</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-parent table-responsive">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Gateway</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($deposits as $deposit)

                            <tr>
                                <td>{{ $deposit->transaction_number}}</td>
                                <td>{{ $deposit->wallet->coin }} - {{ $deposit->wallet->network }}</td>
                                <td>{{ $deposit->amount }} USD</td>
                                <td>
                                    @if ($deposit->status === 'completed')
                                    <span class="badge bg-success">Complete</span>
                                    @elseif ($deposit->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $deposit->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No deposit history available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $deposits->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection