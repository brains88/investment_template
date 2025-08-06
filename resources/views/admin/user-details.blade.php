@extends('layouts.app')
@section('title', 'User Detail - Equitify Trades LC')

@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

        <section class="statistic-section mt-5 pt-5 pb-0">
            <div class="container-fluid">
            <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Account Statistics for {{$user->name}}</h2>
                        </div>
                    </div>
                </div>

<!-- Activation button, increament, decreament -->

<!-- Admin Actions -->
        <!-- Admin Actions -->
        <div class="row">
            <!-- Send Activation Email Button -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="col-md-4 mb-2">
            <form id="sendActivationEmailForm-{{ $user->id }}" method="POST" action="{{ route('admin.activation-email', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100">
                    <span id="sendEmailSpinner-{{ $user->id }}" class="spinner-border spinner-border-sm d-none"></span>
                    Send Activation Email
                </button>
            </form>
        </div>


            <!-- Increment Balance Button -->
            <div class="col-md-4 mb-2">
                <button class="btn btn-success w-100" onclick="showModal('increment', {{ $user->id }})">
                    Increment Balance
                </button>
            </div>

            <!-- Decrement Balance Button -->
            <div class="col-md-4 mb-2">
                <button class="btn btn-danger w-100" onclick="showModal('decrement', {{ $user->id }})">
                    Decrement Balance
                </button>
            </div>
        </div>

               <!-- Message Alert -->
<div class="container mt-3">
    <div id="alert-container" class="mt-3"></div>
</div>
<!-- The end of Message Alert -->
<!-- Modal for Increment/Decrement -->
<!-- Adjust Balance Modal -->
<div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form id="adjustBalanceForm" method="POST" action="{{ route('admin.adjust-balance') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adjustModalLabel">Adjust Balance</h5>
                    <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                            <img src="{{asset('assets/themes/deepblack/img/icon/cross.png')}}" alt="modal dismiss" />
                        </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="adjustAction" name="action">
                    <input type="hidden" id="userId" name="user_id">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn gold-btn">
                        <span class="spinner-border spinner-border-sm d-none" id="adjustSpinner"></span>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



            <!-- The end of Activation button, increament, decreament -->
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4 style="color:#fff;">User Total Balance</h4>
                            <h2>${{ number_format($user->balance ? $user->balance->balance : 0.00, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="box">
                            <h4 style="color:#fff;">User Interest Balance</h4>
                            <h2>${{ number_format($user->balance ? $user->balance->interest : 0.00, 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0 mb-3">
                        <div class="box">
                            <h4 style="color:#fff;">User Total Deposit</h4>
                            <h2>${{ number_format($totalDepositAmount, 2) ?? 0.00}}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mt-3">
                        <div class="box">
                            <h4 style="color:#fff;">User Total Withdrawals</h4>
                            <h2>${{ number_format($totalWithdrawalAmount, 2) ?? 0.00 }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-3">
                        <div class="box">
                            <h4 style="color:#fff;">User Total Investment</h4>
                            <h2>${{ number_format($totalInvestmentAmount, 2) ?? 0.00 }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-3">
                        <div class="box">
                            <h4 style="color:#fff;">User Total Referral</h4>
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
                                                <span class="countdown mb-1" id="countdown-{{ $investment->id }}"
                                                    data-remaining-time="{{ $investment->remainingTime ?? 0 }}"
                                                    data-total-time="{{ $investment->totalTime ?? 0 }}">
                                                    {{ gmdate('H\h i\m s\s', max(0, $investment->remainingTime ?? 0)) }}
                                                </span>
                                                <div class="progress w-100">
                                                    <div id="progress-bar-{{ $investment->id }}"
                                                        class="progress-bar {{ ($investment->investPercentage ?? 0) == 100 ? 'bg-success' : 'bg-info' }}"
                                                        role="progressbar"
                                                        style="width: {{ $investment->investPercentage ?? 0 }}%;"
                                                        aria-valuenow="{{ $investment->investPercentage ?? 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100">
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

@endsection
@push('scripts')
<!-- Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

    // Show Alert
    function showAlert(message, type) {
    const alertContainer = document.getElementById('alert-container');
    alertContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
}

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


// Show Alert
function showAlert(message, type) {
    const alertContainer = document.getElementById('alert-container');
    alertContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
}

// For Adjust Balance
function showModal(action, userId) {
    // Set action and user ID in hidden inputs
    document.getElementById('adjustAction').value = action;
    document.getElementById('userId').value = userId;

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('adjustModal'));
    modal.show();
}

// Handle form submission via AJAX
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the form
    const adjustBalanceForm = document.getElementById('adjustBalanceForm');
    adjustBalanceForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        const action = document.getElementById('adjustAction').value;
        const userId = document.getElementById('userId').value;
        const amount = document.getElementById('amount').value;
        const spinner = document.getElementById('adjustSpinner');

        // Show spinner
        spinner.classList.remove('d-none');

        // Prepare the data
        const formData = {
            action: action,
            user_id: userId,
            amount: amount,
        };

        // Send AJAX request
        fetch('{{ route('admin.adjust-balance') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
            .then(response => {
                spinner.classList.add('d-none'); // Hide spinner
                if (!response.ok) throw response;
                return response.json();
            })
            .then(data => {
                // Show success alert
                showAlert(data.message || 'Balance adjusted successfully!', 'success');

                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('adjustModal'));
                modal.hide();

                // Optionally refresh part of the page or update the UI
                console.log(data);
            })
            .catch(async error => {
                spinner.classList.add('d-none'); // Hide spinner
                const errorData = await error.json();
                const errorMessage = errorData.message || 'An error occurred. Please try again.';
                showAlert(errorMessage, 'danger');
            });
    });
});


function showAlert(message, type) {
    const alertContainer = document.getElementById('alert-container');
    const alertDiv = document.createElement('div');

    // Add classes for Bootstrap alert styles
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    // Append the alert to the container
    alertContainer.appendChild(alertDiv);

    // Automatically remove the alert after 5 seconds
    setTimeout(() => {
        alertDiv.classList.remove('show');
        setTimeout(() => alertDiv.remove(), 150); // Extra delay for smooth fade-out
    }, 5000);
}



// For Sending Activation Email
document.querySelectorAll('[id^="sendActivationEmailForm-"]').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const userId = this.getAttribute('id').split('-')[1]; // Extract user ID
        const spinner = document.getElementById(`sendEmailSpinner-${userId}`);
        const formAction = this.action;

        spinner.classList.remove('d-none'); // Show spinner

        // Send the fetch request
        fetch(formAction, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Add CSRF token
                'Content-Type': 'application/json', // Ensure JSON data is sent
            },
            body: JSON.stringify({ user_id: userId }) // Send JSON body
        })
        .then(response => {
            if (!response.ok) throw response; // Handle non-200 responses
            return response.json();
        })
        .then(data => {
            spinner.classList.add('d-none'); // Hide spinner
            showAlert(data.message || 'Activation email sent successfully!', 'success');
        })
        .catch(async error => {
            spinner.classList.add('d-none'); // Hide spinner
            const response = await error.json();
            const message = response.message || 'Failed to send activation email. Please try again.';
            showAlert(message, 'danger');
        });
    });
});


//Time Counting
document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.countdown').forEach(countdown => {
            const countdownId = countdown.id;
            const investmentId = countdownId.split('-')[1];
            const progressBar = document.getElementById(`progress-bar-${investmentId}`);

            const totalTime = parseInt(countdown.getAttribute('data-total-time'), 10);
            let remainingTime = parseInt(countdown.getAttribute('data-remaining-time'), 10);

            if (remainingTime <= 0) {
                countdown.textContent = '00h 00m 00s';
                progressBar.style.width = '100%';
                progressBar.classList.remove('bg-info');
                progressBar.classList.add('bg-success');
                return; // Stop execution if investment has ended
            }

            const interval = setInterval(() => {
                if (remainingTime > 0) {
                    remainingTime -= 1;

                    // Convert remaining seconds to days, hours, minutes, seconds
                    let days = Math.floor(remainingTime / (3600 * 24));
                    let hours = Math.floor((remainingTime % (3600 * 24)) / 3600);
                    let minutes = Math.floor((remainingTime % 3600) / 60);
                    let seconds = remainingTime % 60;

                    // Display with days if needed
                    countdown.textContent = 
                        (days > 0 ? `${days}d ` : '') +
                        `${String(hours).padStart(2, '0')}h ` +
                        `${String(minutes).padStart(2, '0')}m ` +
                        `${String(seconds).padStart(2, '0')}s`;

                    const progressPercentage = ((totalTime - remainingTime) / totalTime) * 100;
                    progressBar.style.width = `${progressPercentage}%`;
                    progressBar.setAttribute('aria-valuenow', progressPercentage.toFixed(2));

                } else {
                    clearInterval(interval);
                    countdown.textContent = '00h 00m 00s';
                    progressBar.style.width = '100%';
                    progressBar.classList.remove('bg-info');
                    progressBar.classList.add('bg-success');
                }
            }, 1000);
        });
    });
</script>
@endpush
