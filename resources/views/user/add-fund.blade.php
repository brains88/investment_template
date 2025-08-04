@extends('layouts.app')
@section('title', 'Add Funds - Equitify Trades LC')

@section('content')

<!-- Add Fund Section -->
<section class="payment-gateway" style="padding-top: 10px; margin-top: 50px; margin-bottom:50px;">
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="text-white fw-bold " style="padding-top: 40px; margin-bottom:40px; text-align:center">Add
                    Fund
                </h2>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
            @foreach ($wallets as $wallet)
            <div
                style="flex: 1 1 calc(25% - 20px); max-width: 300px; background: #222; color: white; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.5); padding: 25px; text-align: center;">

                <img src="{{ asset('storage/coin/' . $wallet->image_path) }}" alt="{{ $wallet->coin }}"
                    style="height: 60px; margin-bottom: 15px;">

                <h5 style="color: white;">{{ $wallet->coin }} ({{ $wallet->network }})</h5>

                <button type="button" data-id="{{ $wallet->id }}" data-name="{{ $wallet->coin }}"
                    data-currency="{{ $wallet->network }}"
                    data-gateway="{{ strtolower(str_replace(' ', '-', $wallet->coin)) }}"
                    data-min_amount="{{ $wallet->min_amount }}" data-max_amount="{{ $wallet->max_amount }}"
                    data-address="{{ $wallet->address }}" class="gold-btn addFund mt-3" data-bs-toggle="modal"
                    data-bs-target="#addFundModal">
                    Pay Now
                </button>
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
                    <img src="{{asset('assets/themes/deepblack/img/icon/cross.png');}}
" alt="modal dismiss" />
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

                <div class="text-center mt-3" id="loading" style="display: none;">
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden"> Loading ... </span>
                    </div>
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
                    <img src="{{asset('assets/themes/deepblack/img/icon/cross.png');}}" alt="modal dismiss" />
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
                    <img src="{{asset('assets/themes/deepblack/img/icon/cross.png');}}
" alt="modal dismiss" />
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

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let walletId, gateway, minAmount, maxAmount, currency, amount;

    $(document).on('click', '.addFund', function() {
        walletId = $(this).data('id');
        gateway = $(this).data('gateway');
        minAmount = parseFloat($(this).data('min_amount'));
        maxAmount = parseFloat($(this).data('max_amount'));
        currency = $(this).data('currency');

        $('.wallet-id').val(walletId);
        $('.gateway').val(gateway);
        $('.depositLimit').text(`Transaction Limit: ${minAmount} - ${maxAmount} ${currency}`);
        $('.method-name').text(`Payment By ${$(this).data('name')} - ${currency}`);
        $('.show-currency').text(currency);
        $('.amount').val('');
        $('#alert-container').hide().removeClass('alert alert-danger');
    });

    $(document).on('click', '.submitAmount', function() {
        amount = parseFloat($('.amount').val());

        if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
            $('#alert-container').text(`Amount must be between ${minAmount} and ${maxAmount}.`)
                .addClass('alert alert-danger').show();
            return;
        }

        $('#confirm-amount').text(amount);
        $('#confirm-wallet').text($('.method-name').text());
        $('#confirm-network').text(currency);
        $('#confirm-address').text($('.wallet-id').val());
        $('#confirmationModal').modal('show');
    });

    $(document).on('click', '#confirmSubmit', function() {
        $('#loading').show();
        $('#confirmationModal').modal('hide');

        $.ajax({
            url: "{{ route('deposit.store') }}",
            type: "POST",
            data: {
                amount: amount,
                wallet_id: walletId,
                _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(response) {
                $('#loading').hide();
                $('#addFundModal').modal('hide');
                $('#alert-container').text('').removeClass('alert alert-danger')
                    .hide();

                if (response.success) {
                    $('#transaction-amount').text(response.data.amount);
                    $('#transaction-wallet').text(response.data.coin);
                    $('#transaction-network').text(response.data.network);
                    $('#transaction-address').text(response.data.wallet_address);
                    $('#transactionDetailsModal').modal('show');
                } else {
                    $('#alert-container').text(response.message ||
                            'Something went wrong.')
                        .addClass('alert alert-danger').show();
                }
            },
            error: function(xhr, status, error) {
                $('#loading').hide();
                let errMsg = "An error occurred. Please try again.";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMsg = xhr.responseJSON.message;
                } else if (xhr.status === 422) {
                    errMsg = "Validation error. Please check your input.";
                } else {
                    console.log(xhr.responseText); // log detailed error
                }

                $('#alert-container').text(errMsg).addClass('alert alert-danger')
                    .show();
            }
        });
    });

    $(document).on('click', '.copy-address', function() {
        var address = $('#transaction-address').text();
        navigator.clipboard.writeText(address).then(function() {
            alert('Address copied to clipboard!');
            $('#transactionDetailsModal').modal('hide');
        }).catch(function() {
            alert('Failed to copy address.');
        });
    });
});
</script>


@endpush
