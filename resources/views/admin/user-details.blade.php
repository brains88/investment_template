@include('layout.header') <!-- Header Component -->

<body>
<div class="wrapper">
    @include('layout.adminnavbar') <!-- User Navbar -->
        <!-- Admin Dashboard -->

        <section class="statistic-section mt-5 pt-5 pb-0">
            <div class="container-fluid">
            <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Account Statistics for {{$user->name}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4>User Total Balance</h4>
                            <h2>${{ number_format($user->balance ? $user->balance->balance : 0.00, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4>User Interest Balance</h4>
                            <h2>${{ number_format($user->balance ? $user->balance->interest : 0.00, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0 mb-3">
                        <div class="box">
                            <h4>User Total Deposit</h4>
                            <h2>${{ number_format($totalDepositAmount, 2) ?? 0.00}}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mt-3">
                        <div class="box">
                            <h4>User Total Withdrawals</h4>
                            <h2>${{ number_format($totalWithdrawalAmount, 2) ?? 0.00 }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-3">
                        <div class="box">
                            <h4>User Total Investment</h4>
                            <h2>${{ number_format($totalInvestmentAmount, 2) ?? 0.00 }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-3">
                        <div class="box">
                            <h4>User Total Referral</h4>
                            <h2>${{ $totalReferredUsers ?? 0}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
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

  <!-- Invest history -->
  <section class="transaction-history">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Invest History</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-parent table-responsive">
                            <table class="table table-striped mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Return Interest</th>
                                        <th scope="col">Received Amount</th>
                                        <th scope="col">Upcoming Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($investments->isEmpty()) <!-- Check if the investments collection is empty -->
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-danger mt-4">No Active Investment</div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($investments as $index => $investment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $investment->plan->name }}<br>
                                                {{ $investment->amount }} USD
                                            </td>
                                            <td>
                                                {{ $investment->return_on_investment }} USD per {{ $investment->plan->duration }} Days
                                            </td>
                                            <td>
                                                {{ $investment->amount * ($investment->return_on_investment / 100) }} USD
                                            </td>
                                            <td>
                                            <div class="d-flex flex-column align-items-start">
                                            <!-- Countdown Timer -->
                                            <span 
                                                class="countdown mb-1" 
                                                id="countdown-{{ $investment->id }}" 
                                                data-remaining-time="{{ $investment->remainingTime }}" 
                                                data-total-time="{{ $investment->totalTime }}">
                                                {{ gmdate('z\d: H\h i\m s\s', $investment->remainingTime) }}
                                            </span>
                                            <div class="progress w-100">
                                                <div
                                                    id="progress-bar-{{ $investment->id }}"
                                                    class="progress-bar {{ $investment->investPercentage == 100 ? 'bg-success' : 'bg-info' }}"
                                                    role="progressbar"
                                                    style="width: {{ $investment->investPercentage }}%;"
                                                    aria-valuenow="{{ $investment->investPercentage }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                >
                                                    {{ number_format($investment->investPercentage, 2) }}%
                                                </div>
                                            </div>
                                        </div>

                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                            </table>
                        </div>
                         <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $investments->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- Withdrawal History -->
<section class="transaction-history">
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

<!-- Referral --->
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>User Referrals</h2>
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col">
             <div class="table-parent table-responsive">
                <table class="table table-striped mb-5">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Bonus From</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
        @forelse ($referrals as $referral)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $referral->referredUser->username }}</td>
                <td>{{ $referral->referral_bonus }} USD</td>
                <td>level 1 Referral bonus From  {{ $referral->referredUser->username }}</td>
                <td>{{ $referral->created_at->format('d M Y')}}</td>
                
            </tr>
        @empty
            <tr>
                <td colspan="5">No referrals found.</td>
            </tr>
        @endforelse
    </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container text-center">
                            {{ $referrals->links('pagination::bootstrap-4') }}
                        </div>
             
             </div>


             </div>
          </div>
       </div>
    </div>
</section>
        <!-- Profile -->
        <section class="profile-setting">
            <div class="container-fluid">
                <!-- Section Header -->
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>User Profile</h2>
                        </div>
                    </div>
                </div>

           <!-- Main Content -->
           <div class="row">
                    <!-- Profile Image Upload -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="upload-img">
                                <div class="img-box">
                                    <img id="frame" src="{{ asset('storage/profile_images/' . $user->image) }}" alt="Preview User Image" style="width:200px;" />
                                </div>
                                <h3 class="golden-text mt-3">{{ $user->username }}</h3>
                                <p class="mb-2">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Profile Settings Tabs -->
                    <div class="col-lg-8">
                        <div class="edit-area">
                            <!-- Profile Information Form -->
                            <div id="tab1" class="content active">
                            <div class="col-md-6 mb-4">
                            <h4  class="golden-text">Name : {{$user->name}}</h4>
                            </div>
                            <div class="col-md-6 mb-4">
                            <h4  class="golden-text">Email : {{$user->email}}</h4>
                             </div>
                             <div class="col-md-6 mb-4">
                            <h4  class="golden-text">Mobile: {{$user->mobile}}</h4>
                             </div>
                             <div class="col-md-6 mb-4">
                             <h4 class="golden-text">Address : {{ isset($user->address) && $user->address ? $user->address : 'N/A' }}</h4>
                             </div>
                             <div class="col-md-6 mb-4">
                            <h4  class="golden-text">Country : {{$user->country}}</h4>
                             </div>
                             <div class="col-md-6 mb-4">
                             <h4 class="golden-text">Identity Type : {{ isset($user->identity_type) && $user->identity_type ? $user->identity_type : 'N/A' }}</h4>
                             </div>
                             <div class="row">
                             @if($user->identity_image)
                             <div class="col-md-6 mb-4">
                             <img id="frame" src="{{ asset('storage/identity_verifications/' . $user->identity_image) }}" alt="Preview User Image" style="width:200px;" />
                             <h3 class="golden-text mt-3">Identity Type</h3>
                             </div> 
                             @endif
                             @if($user->proof_of_address)
                             <div class="col-md-6 mb-4">
                             <img id="frame" src="{{ asset('storage/address_verifications/' . $user->proof_of_address) }}" alt="Preview User Image" style="width:200px;" />
                             <h3 class="golden-text mt-3">Proof Of Address</h3>
                             </div>
                             @endif
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </section>

        @include('layout.footer') <!-- Footer Component -->
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