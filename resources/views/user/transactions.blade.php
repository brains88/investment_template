@include('layout.header') <!-- Header Component -->

<body>
<div class="wrapper">
@include('layout.usernavbar') <!-- User Navbar -->

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

            <form action="https://www.equitytradeslc.com/user/transaction-search" method="get">
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
                                        <th>SL No.</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Time</th>
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
                                                <span class="fontBold text-danger">-{{ $transaction->amount }} USD</span> <!-- Withdrawal -->
                                            @else
                                                <span class="fontBold text-success">+{{ $transaction->amount }} USD</span> <!-- Deposit -->
                                            @endif
                                        </td>
                                        <td>{{ $transaction->remark ?? 'No remarks' }}</td> <!-- Display the remark -->
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
</div>

@include('layout.footer')

</body>
</html>
