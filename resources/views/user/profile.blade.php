@extends('layouts.app')
@section('title', 'Profile - Equitify Trust LC')

@section('content')
<link rel="stylesheet" type="text/css" href="../../assets/themes/deepblack/assets/bootstrap/bootstrap.min.css" />
<style>
    /* Hide all tab content by default */
    .content {
        display: none;
    }

    /* Show active tab content */
    .content.active {
        display: block;
    }

    /* Style for active tab button */
    .profile-navigator .tab.active {
        font-weight: bold;
        border-bottom: 2px solid gold;
    }
</style>
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
                        <input accept="image/*" name="image" type="file" id="image" onchange="previewImage(event)" />
                        <span class="select-file" style="color:#fff;">Choose image</span>
                        <img id="frame" style="color:#fff;" 
                        src="{{ $userData->image 
                                ? asset('storage/profile/' . $userData->image) 
                                : asset('default-user.png') }}" 
                        alt="Preview User Image" />


                    </div>
                    <h3 class="golden-text">{{ $userData->username }}</h3>
                    <p class="mb-2" style="color:#fff;">
                        {{ \Carbon\Carbon::parse($userData->created_at)->format('d M Y h:i A') }}
                    </p>
                    <!-- Alert -->
                    <div class="container mt-3">
                        <div id="image-alert-container" class="mt-3"></div>
                    </div>
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
                        <form id="profileForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="firstname" class="golden-text">First Name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname"
                                        value="{{ $userData->name }}" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="username" class="golden-text">Username</label>
                                    <input type="text" id="username" name="username" value="{{ $userData->username }}"
                                        class="form-control" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="golden-text">Email Address</label>
                                    <input type="email" id="email" value="{{ $userData->email }}" readonly
                                        class="form-control" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="golden-text">Phone Number</label>
                                    <input type="text" id="phone" readonly class="form-control"
                                        value="{{ $userData->mobile }}" />
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="address" class="golden-text">Address</label>
                                    <textarea class="form-control" id="address" name="address" cols="30"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <!--Message Alert -->
                            <div class="container mt-3">
                                <!-- Alert for Profile Update -->
                                <div id="profile-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                            <button type="submit" class="gold-btn">
                                <span id="profileSpinner" class="spinner-border spinner-border-sm d-none"></span> Update
                                User
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
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" placeholder="Enter Current Password" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="golden-text">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Enter New Password" />
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="password_confirmation" class="golden-text">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <!--Message Alert -->
                            <div class="container mt-3">
                                <!-- Alert for Image Update -->
                                <div id="password-alert-container" class="mt-3"></div>
                            </div>
                            <!--The end of message alert -->
                            <button type="submit" class="gold-btn">
                                <span id="passwordSpinner" class="spinner-border spinner-border-sm d-none"></span>
                                Update Password
                            </button>
                        </form>
                    </div>

                    <!-- Identity Verification Form -->
                    <div id="tab3" class="content">
                        <form id="identityForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="identity_type" class="golden-text">Identity Type</label>
                                <select name="identity_type" id="identity_type" class="form-select bg-dark text-light border-secondary">
                                    <option value="" disabled selected style="color:#fff;">Select Type</option>
                                    <option value="driving-license" style="color:#fff;">Driving License</option>
                                    <option value="passport" style="color:#fff;">Passport</option>
                                    <option value="national-id" style="color:#fff;">National ID</option>
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
                                <span id="identitySpinner" class="spinner-border spinner-border-sm d-none"></span>
                                Submit
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
<!-- jQuery (latest) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 5 JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection

@push('scripts')
<script>
    //For image Preview
function previewImage(event) {
const frame = document.getElementById('frame');
frame.src = URL.createObjectURL(event.target.files[0]);
frame.onload = () => {
    URL.revokeObjectURL(frame.src); // Free memory after loading
}
}

$(document).ready(function() {
    // Show spinner on form submission
    $('form').on('submit', function(e) {
        const spinner = $(this).find('.spinner-border');
        if (spinner) spinner.removeClass('d-none');
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
    $(formSelector).submit(function(e) {
        e.preventDefault();

        const spinner = $(spinnerSelector);
        const alertContainer = $(alertSelector);
        const formData = new FormData(this);

        // Always append CSRF token
        formData.append('_token', '{{ csrf_token() }}');

        // If using PUT/PATCH/DELETE, send as _method
        if (method.toUpperCase() !== 'POST') {
            formData.append('_method', method);
        }

        spinner.removeClass('d-none');
        alertContainer.empty(); // Clear previous alerts

        $.ajax({
            url: route,
            method: 'POST', // Always POST for FormData + method spoofing
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                spinner.addClass('d-none');
                alertContainer.html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                if (reset) $(formSelector)[0].reset();
            },
            error: function(error) {
                spinner.addClass('d-none');

                // If Laravel validation failed, show all errors
                let message = error.responseJSON?.message || 'An error occurred. Please try again.';
                if (error.responseJSON?.errors) {
                    message = Object.values(error.responseJSON.errors).flat().join('<br>');
                }

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
    handleFormSubmission('#imageForm', '{{route("profile.update-image")}}', 'POST', '#imageSpinner',
        '#image-alert-container');
    handleFormSubmission('#profileForm', '{{route("profile.update-info")}}', 'PUT', '#profileSpinner',
        '#profile-alert-container');
    handleFormSubmission('#passwordForm', '{{route("profile.update-password")}}', 'POST', '#passwordSpinner',
        '#password-alert-container');
    handleFormSubmission('#identityForm', '{{route("profile.submit-identity")}}', 'POST', '#identitySpinner',
        '#identity-alert-container');
    handleFormSubmission('#addressForm', '{{route("profile.submit-address")}}', 'POST', '#addressSpinner',
        '#address-alert-container');

    // Tab Switching Logic - Fixed version
    $('.profile-navigator .tab').click(function() {
        // Remove active from all tabs
        $('.profile-navigator .tab').removeClass('active');
        
        // Remove active from all content sections
        $('.content').removeClass('active');
        
        // Add active to clicked tab
        $(this).addClass('active');
        
        // Show matching content
        const tabId = $(this).attr('tab-id');
        $(`#${tabId}`).addClass('active');
    });
});
</script>
@endpush
