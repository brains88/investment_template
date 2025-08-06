@extends('layouts.app')
@section('title', ' Deposit History - Equitify Trades LC')

@section('content')
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
    <div class="col-12"> <!-- Changed from 'col' to 'col-12' -->
        <div class="table-parent table-responsive">
            <table class="table table-striped mb-5">
                <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Gateway</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->transaction_number }}</td>
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
                            <td>
                                @if ($deposit->status === 'pending')
                                    <form method="POST" action="{{ route('transactions.approve', $deposit->id) }}" style="display: inline-block;">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">
                                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('transactions.delete', $deposit->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No deposit history available.</td>
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

@push('scripts')
<script>
    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function () {
            const spinner = this.querySelector('.spinner-border');
            if (spinner) {
                spinner.classList.remove('d-none');
            }
        });
    });

    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function () {
            const spinner = this.querySelector('.spinner-border');
            if (spinner) {
                spinner.classList.remove('d-none');
            }
        });
    });


    // Populate Feedback Modal
    document.querySelectorAll('.feedback-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('feedback-withdrawal-id').value = this.dataset.id;
            document.getElementById('admin-feedback').value = this.dataset.feedback || '';
        });
    });

    // Set Delete Form Action
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('delete-form');
            form.action = form.action.replace('/0', `/${this.dataset.id}`);
        });
    });

    // Show Spinner on Submit
    document.querySelectorAll('form button[type="submit"]').forEach(button => {
        button.addEventListener('click', function () {
            const spinner = this.querySelector('.spinner-border');
            if (spinner) {
                spinner.classList.remove('d-none');
            }
        });
    });


    document.addEventListener('DOMContentLoaded', () => {
    // Find all countdown elements
    document.querySelectorAll('.countdown').forEach(countdown => {
        const countdownId = countdown.id;
        const investmentId = countdownId.split('-')[1];
        const progressBar = document.getElementById(`progress-bar-${investmentId}`);

        const totalTime = parseInt(countdown.getAttribute('data-total-time'), 10); // Total time in seconds
        let remainingTime = parseInt(countdown.getAttribute('data-remaining-time'), 10); // Remaining time in seconds

        const interval = setInterval(() => {
            // Decrease the remaining time
            remainingTime = Math.max(0, remainingTime - 1);

            // Calculate the progress percentage
            const progressPercentage = ((totalTime - remainingTime) / totalTime) * 100;

            // Update the countdown timer text
            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = remainingTime % 60;
            countdown.textContent = `${hours.toString().padStart(2, '0')}h ${minutes.toString().padStart(2, '0')}m ${seconds.toString().padStart(2, '0')}s`;

            // Update the progress bar
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.setAttribute('aria-valuenow', progressPercentage.toFixed(2));
            progressBar.textContent = `${progressPercentage.toFixed(2)}%`;

            // Stop when the countdown reaches zero
            if (remainingTime === 0) {
                clearInterval(interval);
                progressBar.classList.remove('bg-info');
                progressBar.classList.add('bg-success');
            }
        }, 1000);
    });
});
</script>
@endpush