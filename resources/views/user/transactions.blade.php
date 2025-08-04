@extends('layouts.app')
@section('title', 'Transactions - Equitify Trades LC')

@section('content')

<!------------- others main dashboard body content ------------>
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>Transaction</h2>
                </div>
            </div>
        </div>

        <form action="../user/transaction-search" method="get">
            <div class="row select-transaction">
                <!-- Search form (same as your code) -->
            </div>
        </form>

        <div class="row">
            <div class="col">
                <div class="table-parent table-responsive">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Receiver</th>
                                <th>Remark</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display alert if there are no transactions -->
                            @if($transactions->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center mt-3" class="alert alert-warning" role="alert">
                                    No transactions found.
                                </td>
                            </tr>
                            @else
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>
                                    @if($transaction->sender_id == auth()->id())
                                    <span class="fontBold text-danger">-{{ number_format($transaction->amount, 2) }}
                                        USD</span>
                                    @else
                                    <span class="fontBold text-success">+{{ number_format($transaction->amount, 2) }}
                                        USD</span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->sender_id == auth()->id())
                                    <span class="text-danger">Sent</span>
                                    @else
                                    <span class="text-success">Received</span>
                                    @endif
                                </td>
                                <td>{{ $transaction->receivedTransfers->email }}</td>
                                <td class="text-success"> {{ $transaction->status }}</td>
                                <td>{{ $transaction->created_at->format('d M Y h:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <!-- Pagination -->
                <div class="pagination-container">
                    {{ $transactions->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
