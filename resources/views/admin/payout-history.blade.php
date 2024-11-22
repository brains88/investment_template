@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.adminnavbar') 

        <!-- Withdrawal History -->
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>Payout Log</h2>
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
                                <th scope="col">Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ $withdrawal->transaction_number }}</td>
                                    <td>{{ $withdrawal->method }}</td>
                                    <td>{{ $withdrawal->amount }} USD</td>
                                    <td>0.00 USD</td>
                                    <td>
                                        <span class="badge 
                                            @if ($withdrawal->status == 'pending') bg-warning
                                            @elseif ($withdrawal->status == 'complete') bg-success
                                            @else bg-danger @endif">
                                            {{ ucfirst($withdrawal->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $withdrawal->created_at->format('d M Y h:i A') }}</td>
                                    <td>
                                        @if ($withdrawal->status === 'pending')
                                            <form method="POST" action="{{ route('withdrawals.approve', $withdrawal->id) }}" style="display: inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                        <button class="btn btn-info btn-sm feedback-btn" 
                                            data-id="{{ $withdrawal->id }}" 
                                            data-feedback="{{ $withdrawal->admin_feedback }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#feedbackModal">
                                            Add Feedback
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-btn" 
                                            data-id="{{ $withdrawal->id }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Payout history for User.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $withdrawals->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('withdrawals.feedback') }}">
                @csrf
                <input type="hidden" name="id" id="feedback-withdrawal-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Add Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="admin-feedback">Feedback</label>
                            <textarea name="feedback" id="admin-feedback" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            Submit Feedback
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('withdrawals.delete', ['id' => 0]) }}" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this withdrawal?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

    </div>

    @include('layout.footer')

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

</body>
