@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.adminnavbar')

        <!-- Profile Settings Section -->
        <section class="profile-setting mt-5 pt-5">
            <div class="container-fluid">
                <!-- Section Header -->
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Profile Settings</h2>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="row">
                    <!-- Profile Settings Tabs -->
                    <div class="col-lg-12">
                        <div class="edit-area">
                            <!-- Tab Navigation -->
                            <div class="profile-navigator">
                                <button tab-id="tab2" class="golden-text tab tive">Password Setting</button>
                            </div>

                            <!-- Password Setting Form -->
                            <div id="tab2" class="content">
                                <form id="passwordForm" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="current_password" class="golden-text">Current Password</label>
                                            <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter Current Password" />
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="password" class="golden-text">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="password_confirmation" class="golden-text">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
                                        </div>
                                    </div>
                                    <!--Message Alert -->
                                <div class="container mt-3">
                                <!-- Alert for Image Update -->
                              <div id="password-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                                    <button type="submit" class="gold-btn">
                                        <span id="passwordSpinner" class="spinner-border spinner-border-sm d-none"></span> Update Password
                                    </button>
                                </form>
                            </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('layout.footer')
    <script>
    // Show spinner on form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const spinner = this.querySelector('.spinner-border');
            if (spinner) spinner.classList.remove('d-none');
        });
    });

    // Function to display Bootstrap alerts
    function showAlert(message, type = 'success') {
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#alert-container').append(alertHTML);
    }

    // CSRF Token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    function handleFormSubmission(formSelector, route, method, spinnerSelector, alertSelector, reset = false) {
    $(formSelector).submit(function (e) {
        e.preventDefault();
        const spinner = $(spinnerSelector);
        const alertContainer = $(alertSelector);
        const formData = new FormData(this);

        spinner.removeClass('d-none');
        alertContainer.empty(); // Clear previous alerts

        $.ajax({
            url: route,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                spinner.addClass('d-none');
                alertContainer.html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                if (reset) $(formSelector)[0].reset();
            },
            error: function (error) {
                spinner.addClass('d-none');
                const message = error.responseJSON?.message || 'An error occurred. Please try again.';
                alertContainer.html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            },
        });
    });
}

// Initialize form handlers with specific alert containers
handleFormSubmission('#passwordForm', '{{route("admin.profile.update-password")}}', 'POST', '#passwordSpinner', '#password-alert-container');

</script>

</body>
