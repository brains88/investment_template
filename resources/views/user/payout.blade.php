<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payout Form</title>
    <!-- Add your Bootstrap CSS and jQuery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
@include('layout.header') <!-- Correct Blade directive -->

<body>
<div class="wrapper">
@include('layout.usernavbar') <!-- Correct Blade directive -->

<!------------- Main Content -------------> 
<section class="payment-gateway mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>Payout Money</h2>
                </div>
            </div>
        </div>

        <!-- Gateway options (Bank Transfer and Cryptocurrency) -->
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="gateway-box">
                    <img
                        class="img-fluid gateway"
                        src="https://www.equitytradeslc.com/assets/uploads/withdraw/6064181b137c91617172507.jpg"
                        alt="Bank Transfer"
                    >
                    <button type="button"
                            data-id="2"
                            data-name="Bank Transfer"
                            data-min_amount="5"
                            data-max_amount="99998998"
                            data-percent_charge="0"
                            data-fix_charge="0"
                            class="gold-btn addFund"
                            data-bs-toggle="modal" data-bs-target="#addFundModal"
                            onclick="showWithdrawalForm('bank')">
                        PAYOUT NOW
                    </button>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                <div class="gateway-box">
                    <img
                        class="img-fluid gateway"
                        src="https://www.equitytradeslc.com/assets/uploads/withdraw/64d9d892167531691998354.jpeg"
                        alt="CRYPTOCURRENCY"
                    >
                    <button type="button"
                            data-id="3"
                            data-name="Cryptocurrency"
                            data-min_amount="7"
                            data-max_amount="100000"
                            data-percent_charge="0"
                            data-fix_charge="0"
                            class="gold-btn addFund"
                            data-bs-toggle="modal" data-bs-target="#addFundModal"
                            onclick="showWithdrawalForm('crypto')">
                        PAYOUT NOW
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Withdrawal Form -->
<div class="modal fade" id="addFundModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payout Form</h5>
                <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                 <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/cross.png" alt="modal dismiss" />
                 </button>
            </div>
            <div class="modal-body">
                        <form id="payoutForm" action="{{ route('payout.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="method" id="method" value="">
                    <div class="form-group">
                        <label for="account">Choose Account</label>
                        <select id="account" name="account" class="form-control">
                            <option value="main">Main Balance - ${{ $balance->balance ?? 0 }}</option>
                            <option value="interest">Interest Balance - ${{ $balance->interest ?? 0 }}</option>
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="5" required>
                    </div>

                    <!-- Bank Transfer Fields -->
                    <div id="bank-fields" class="method-fields">
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name">
                        </div>
                        <div class="form-group">
                            <label for="bank_account_number">Bank Account Number</label>
                            <input type="text" class="form-control" id="bank_account_number" name="bank_account_number">
                        </div>
                        <div class="form-group">
                            <label for="routing_number">Routing Number</label>
                            <input type="text" class="form-control" id="routing_number" name="routing_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Bank Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="address">paypal email</label>
                            <input type="email" class="form-control"  id="paypalEmail" name="paypalEmail" placeholder='paypal email is optional'>
                        </div>
                        <div class="form-group">
                            <label for="address">zelle email</label>
                            <input type="email" class="form-control" id="zelleEmail" name="zelleEmail" placeholder='zelle email is optional'>
                        </div>
                    </div>

                    <!-- Cryptocurrency Fields -->
                    <div id="crypto-fields" class="method-fields">
                        <div class="form-group">
                            <label for="wallet_address">Wallet Address</label>
                            <input type="text" class="form-control" id="wallet_address" name="wallet_address">
                        </div>
                        <div class="form-group">
                            <label for="network">Network</label>
                            <input type="text" class="form-control" id="network" name="network">
                        </div>
                        <div class="form-group">
                            <label for="coin_type">Coin Type (e.g., BTC, ETH)</label>
                            <input type="text" class="form-control" id="coin_type" name="coin_type">
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" id="processButton" class="btn gold-btn w-100">
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            Process Transaction
                        </button>
                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                    </div>

                    <!-- Bootstrap Alert Message -->
                   <!-- Single Alert Message -->
                    <div id="alertMessage" class="alert alert-info" role="alert" style="display: none;">
                        Processing your request...
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@include('layout.footer') <!-- Correct Blade directive -->

</body>

<script>
   function showWithdrawalForm(method) {
    // Set the method value
    document.getElementById('method').value = method;

    // Define field groups
    const fieldGroups = {
        bank: document.getElementById('bank-fields'),
        crypto: document.getElementById('crypto-fields'),
    };

    // Toggle fields visibility
    Object.keys(fieldGroups).forEach((key) => {
        fieldGroups[key].style.display = key === method ? 'block' : 'none';
    });
}

document.getElementById("payoutForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const spinner = document.getElementById("spinner");
    const alertMessage = document.getElementById("alertMessage");
    const processButton = document.getElementById("processButton");

    spinner.style.display = "inline-block";
    alertMessage.style.display = "block";
    alertMessage.className = "alert alert-info";
    alertMessage.textContent = "Processing your request...";
    processButton.disabled = true;

    const formData = new FormData(this);

    fetch("{{ route('payout.submit') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            Accept: "application/json",
        },
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                if (response.status === 422) {
                    return response.json().then((data) => {
                        throw data.errors;
                    });
                }
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            alertMessage.className = "alert alert-success";
            alertMessage.textContent = data.message || "Payout request processed successfully!";
            window.location.href = '/user/payout-history';
        })
        .catch((errors) => {
            console.log("Errors received:", errors); // Debugging
            if (typeof errors === "object") {
                alertMessage.className = "alert alert-danger";
                alertMessage.textContent = Object.values(errors)
                    .flat()
                    .join(", ");
            } else {
                alertMessage.className = "alert alert-danger";
                alertMessage.textContent = "There was an error processing the transaction.";
            }
        })
        .finally(() => {
            spinner.style.display = "none";
            processButton.disabled = false;
        });
});

;

</script>



</html>
