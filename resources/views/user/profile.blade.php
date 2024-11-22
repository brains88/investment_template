@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.usernavbar')

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
                    <!-- Profile Image Upload -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="upload-img">
                            <form id="imageForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="img-box">
                                    <input accept="image/*" name="image" type="file" id="image" onchange="previewImage()" />
                                    <span class="select-file">Choose image</span>
                                    <img id="frame" src="{{ asset('storage/profile_images/' . $userData->image) }}" alt="Preview User Image" />
                                </div>
                                <h3 class="golden-text">{{ $userData->username }}</h3>
                                <p class="mb-2">{{ \Carbon\Carbon::parse($userData->created_at)->format('d M Y h:i A') }}</p>
                               <!--Message Alert -->
                                <div class="container mt-3">
                               <!-- Alert for Image Update -->
                              <div id="image-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                                <button type="submit" class="gold-btn">
                                    <span id="imageSpinner" class="spinner-border spinner-border-sm d-none"></span> Image Update
                                </button>

                            </form>
                        </div>
                    </div>

                    <!-- Profile Settings Tabs -->
                    <div class="col-lg-8">
                        <div class="edit-area">
                            <!-- Tab Navigation -->
                            <div class="profile-navigator">
                                <button tab-id="tab1" class="golden-text tab active">Profile Information</button>
                                <button tab-id="tab2" class="golden-text tab">Password Setting</button>
                                <button tab-id="tab3" class="golden-text tab">Identity Verification</button>
                                <button tab-id="tab4" class="golden-text tab">Address Verification</button>
                            </div>

                            <!-- Profile Information Form -->
                            <div id="tab1" class="content active">
                                <form id="profileForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="firstname" class="golden-text">First Name</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $userData->name }}" />
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="username" class="golden-text">Username</label>
                                            <input type="text" id="username" name="username" value="{{ $userData->username }}" class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="email" class="golden-text">Email Address</label>
                                            <input type="email" id="email" value="{{ $userData->email }}" readonly class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="phone" class="golden-text">Phone Number</label>
                                            <input type="text" id="phone" readonly class="form-control" value="{{ $userData->mobile }}" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="address" class="golden-text">Address</label>
                                            <textarea class="form-control" id="address" name="address" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <!--Message Alert -->
                                <div class="container mt-3">
                                <!-- Alert for Profile Update -->
                             <div id="profile-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                                    <button type="submit" class="gold-btn">
                                        <span id="profileSpinner" class="spinner-border spinner-border-sm d-none"></span> Update User
                                    </button>
                                </form>
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

                            <!-- Identity Verification Form -->
                            <div id="tab3" class="content">
                                <form id="identityForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="identity_type" class="golden-text">Identity Type</label>
                                        <select name="identity_type" id="identity_type" class="form-control">
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="driving-license">Driving License</option>
                                            <option value="passport">Passport</option>
                                            <option value="national-id">National ID</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="identity_file" class="golden-text">Upload File</label>
                                        <input type="file" name="identity_file" class="form-control" />
                                    </div>
                                    <!--Message Alert -->
                                <div class="container mt-3">
                                <div id="identity-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                                    <button type="submit" class="gold-btn">
                                        <span id="identitySpinner" class="spinner-border spinner-border-sm d-none"></span> Submit
                                    </button>
                                </form>
                            </div>

                            <!-- Address Verification Form -->
                            <div id="tab4" class="content">
                                <form id="addressForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="addressProof" class="golden-text">Address Proof</label>
                                        <input type="file" name="addressProof" class="form-control" />
                                    </div>
                                    <!--Message Alert -->
                                <div class="container mt-3">
                                <div id="address-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                                    <button type="submit" class="gold-btn">
                                        <span id="addressSpinner" class="spinner-border spinner-border-sm d-none"></span> Submit
                                    </button>
                                </form>
                            </div>
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
handleFormSubmission('#imageForm', '{{route("profile.update-image")}}', 'POST', '#imageSpinner', '#image-alert-container');
handleFormSubmission('#profileForm', '{{route("profile.update-info")}}', 'PUT', '#profileSpinner', '#profile-alert-container');
handleFormSubmission('#passwordForm', '{{route("profile.update-password")}}', 'POST', '#passwordSpinner', '#password-alert-container');
handleFormSubmission('#identityForm', '{{route("profile.submit-identity")}}', 'POST', '#identitySpinner', '#identity-alert-container');
handleFormSubmission('#addressForm', '{{route("profile.submit-address")}}', 'POST', '#addressSpinner', '#address-alert-container');

</script>

</body>
