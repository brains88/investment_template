@include('layout.header') <!-- Header Component -->

<body>
<div class="wrapper">
@include('layout.usernavbar') <!-- User Navbar -->

<!------------- others main dashboard body content ------------>       
<!-- Fund history -->
<section class="transaction-history profile-setting mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>Balance Transfer</h2>
             </div>
          </div>
       </div>

        <div class="edit-area">
            <form id="transfer-form" class="form-row" action="{{ route('money-transfer.submit') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-12 mb-4">
                <label for="email" class="golden-text">Receiver Email Address</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="receiver_email" value=""
                    placeholder="Receiver Email Address"
                />
            </div>

            <div class="col-md-12 mb-4">
                <label for="amount" class="golden-text">Amount</label>
                <input
                    type="text"
                    id="amount"
                    class="form-control"
                    name="amount" value=""
                    placeholder="Enter Amount" 
                    onkeyup="this.value = this.value.replace(/^\.|[^\d\.]/g, '')"
                />
            </div>

            <div class="col-md-12 mb-4">
                <label for="password" class="golden-text">Enter Password</label>
                <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password" value=""
                    placeholder="Your Password"
                />
            </div>
        </div>
          <!-- Alert Container for Messages -->
        <div id="alert-container" class="mt-3"></div>

        <!-- Submit Button -->
        <button type="submit" id="submit-btn" class="gold-btn">
            Submit
        </button>

        <!-- Loading Spinner -->
        <div id="spinner" class="d-none mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        </form>

        </div>

    </div>
 </section>

           </div>
        </div>
    </div>

    @include('layout.footer')

    <script>
        $(document).ready(function () {
            $('#transfer-form').on('submit', function (event) {
                event.preventDefault();  // Prevent the default form submission

                var form = $(this);
                var spinner = $('#spinner');
                var submitButton = $('#submit-btn');
                var alertContainer = $('#alert-container'); // Alert container for messages

                // Disable the submit button and show the spinner
                submitButton.prop('disabled', true);
                spinner.removeClass('d-none'); // Show the spinner

                // Clear previous alert messages
                alertContainer.empty();

                // Get form data
                var formData = form.serialize();

                // Send the AJAX request
                $.ajax({
                    url: form.attr('action'),  // Form action URL
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        spinner.addClass('d-none'); // Hide the spinner
                        submitButton.prop('disabled', false); // Enable the submit button

                        // Show success message
                        var alertMessage = $('<div class="alert alert-success">').text(data.message);
                        alertContainer.append(alertMessage);

                        // Redirect if successful
                        if (data.message === 'Transfer successful') {
                            setTimeout(function () {
                                window.location.href = '/user/transactions';
                            }, 2000);  // Redirect after 2 seconds
                        }
                    },
                    error: function (xhr, status, error) {
                        spinner.addClass('d-none'); // Hide the spinner
                        submitButton.prop('disabled', false); // Enable the submit button

                        // Handle errors
                        var response = xhr.responseJSON;
                        var alertMessage = $('<div class="alert alert-danger">').text(response.error || 'An error occurred');
                        alertContainer.append(alertMessage);
                    }
                });
            });
        });
    </script>
</body>
</html>
