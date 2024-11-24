@include('layout.header') <!-- Header Component -->

<body>
    <div class="wrapper">
        @include('layout.usernavbar') <!-- User Navbar -->

        <!-- Add Fund Section -->
        <section class="payment-gateway mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Add Fund</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($wallets as $wallet)
                        <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                            <div class="gateway-box">
                                <img
                                    class="img-fluid gateway"
                                    src="{{ asset('storage/coin/' . $wallet->image_path) }}"
                                    alt="{{ $wallet->coin }}"
                                >
                                 <button type="button"
                                data-id="{{ $wallet->id }}"
                                data-name="{{ $wallet->coin }}"
                                data-currency="{{ $wallet->network }}"
                                data-gateway="{{ strtolower(str_replace(' ', '-', $wallet->coin)) }}"
                                data-min_amount="{{ $wallet->min_amount }}" 
                                data-max_amount="{{ $wallet->max_amount }}"
                                data-address="{{ $wallet->address }}"
                                class="gold-btn addFund"
                                data-bs-toggle="modal" data-bs-target="#addFundModal">Pay Now
                            </button>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Add Fund Modal -->
        <div id="addFundModal" class="modal fade addFundModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content form-block">
                    <div class="modal-header">
                        <h4 class="modal-title method-name golden-text"></h4>
                        <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/cross.png" alt="modal dismiss" />
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="payment-form">
                            <p class="golden-text depositLimit lebelFont"></p>
                            <p class="golden-text depositCharge lebelFont"></p>
                            <input type="hidden" class="gateway" name="gateway" value="">
                            <input type="hidden" class="wallet-id" name="wallet_id" value="">

                            <div class="form-group mb-30 mt-3">
                                <div class="box">
                                    <h5 class="text-white">Amount</h5>
                                    <div class="input-group">
                                        <input type="text" class="amount form-control" name="amount" />
                                        <button class="gold-btn show-currency"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <img id="loading" src="https://www.equitytradeslc.com/assets/admin/images/loading.gif" alt="loader" class="w-15" style="display: none;" />
                        </div>
                    </div>
                    <div id="alert-container" class="alert mt-2" style="display: none;"></div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn gold-btn submitAmount">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Details Modal -->
        <div id="transactionDetailsModal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Transaction Details</h4>
                        <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/cross.png" alt="modal dismiss" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item">Funding Amount: <strong id="transaction-amount"></strong></li>
                            <li class="list-group-item">Funding Coin: <strong id="transaction-wallet"></strong></li>
                            <li class="list-group-item">Network: <strong id="transaction-network"></strong></li>
                            <li class="list-group-item">
                               Wallet Address: 
                                <span id="transaction-address" class="me-2"></span>
                                <button class="btn btn-sm btn-outline-secondary copy-address">Copy</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Payment</h4>
               <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/cross.png" alt="modal dismiss" />
            </button>
            </div>
            <div class="modal-body">
                <p>Please confirm the details below:</p>
                <ul>
                    <li>Amount: <strong id="confirm-amount"></strong></li>
                    <li>Wallet: <strong id="confirm-wallet"></strong></li>
                    <li>Network: <strong id="confirm-network"></strong></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>
</div>

        @include('layout.footer')

        <script>
            'use strict';
            var walletId, gateway, minAmount, maxAmount, currency, amount;

// When 'Pay Now' button is clicked, set the walletId and other values
$('.addFund').on('click', function () {
    walletId = $(this).data('id');
    gateway = $(this).data('gateway');
   minAmount = parseFloat($(this).data('min_amount'));
    maxAmount = parseFloat($(this).data('max_amount'));
    currency = $(this).data('currency');

    // Set modal fields with selected wallet details
    $('.wallet-id').val(walletId);
    $('.gateway').val(gateway);
    $('.depositLimit').text(`Transaction Limit: ${minAmount} - ${maxAmount} ${currency}`);
    $('.method-name').text(`Payment By ${$(this).data('name')} - ${currency}`);
    $('.show-currency').text(currency);
});

// When 'Submit' button is clicked in the modal
$(".submitAmount").on('click', function () {
    amount = $('.amount').val(); // Get the entered amount

    // Validate amount
    if (!amount || amount < minAmount || amount > maxAmount) {
        $('#alert-container').text(`Amount must be between ${minAmount} and ${maxAmount}.`).addClass('alert alert-danger').show();
        return;
    }


    // Populate the confirmation modal with the details
    $('#confirm-amount').text(amount);
    $('#confirm-wallet').text($('.method-name').text());
    $('#confirm-network').text(currency);
    $('#confirm-address').text($('.wallet-id').val());

    // Show the confirmation modal
    $('#confirmationModal').modal('show');
});

// When the user confirms the transaction in the confirmation modal
$('#confirmSubmit').on('click', function () {
    $('#confirmationModal').modal('hide'); // Hide confirmation modal
    $('#loading').show(); // Show spinner

    $.ajax({
        url: "{{ route('deposit.store') }}", // Laravel route
        type: "POST",
        data: {
            amount: amount,
            wallet_id: walletId, // Use the global walletId set above
            _token: '{{ csrf_token() }}' // CSRF Token
        },
        dataType: "JSON", // Expect JSON response
        success: function (response) {
            $('#loading').hide(); // Hide spinner
            $('#addFundModal').modal('hide');
            $('#alert-container').text('').removeClass('alert alert-danger').hide();

            if (response.success) {
                // Populate transaction details
                $('#transaction-amount').text(response.data.amount);
                $('#transaction-wallet').text(response.data.coin); // Assuming 'coin' is returned
                $('#transaction-network').text(response.data.network); // Assuming 'wallet_address' is returned
                $('#transaction-address').text(response.data.wallet_address); 
                $('#transactionDetailsModal').modal('show');
            } else {
                $('#alert-container').text(response.message).addClass('alert alert-danger').show();
            }
        },
        error: function (status, error) {
            $('#loading').hide(); // Hide spinner
            $('#alert-container').text("An error occurred. Please try again.")
                .addClass('alert alert-danger').show();
        }
    });
});

// Copy wallet address to clipboard
$('.copy-address').on('click', function () {
    var address = $('#transaction-address').text();
    navigator.clipboard.writeText(address).then(function () {
        alert('Address copied to clipboard!');
        $('#transactionDetailsModal').modal('hide');
    }).catch(function () {
        alert('Failed to copy address.');
    });
});

        </script>
    </div>
</body>
</html>
