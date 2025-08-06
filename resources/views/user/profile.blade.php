@extends('layouts.app')
@section('title', 'Profile - Equitify Trades LC')

@section('content')

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

        <!-- Success & Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Password Setting Form (Always Visible) -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <form id="passwordForm" method="POST" action="{{ route('user.profile.update-password') }}">
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

                    <div id="password-alert-container" class="mt-3"></div>

                    <button type="submit" class="gold-btn">
                        <span id="passwordSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Bootstrap JS and jQuery -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // CSRF Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // Spinner on form submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            const spinner = this.querySelector('.spinner-border');
            if (spinner) spinner.classList.remove('d-none');
        });
    });

    // AJAX Password Update
    $('#passwordForm').submit(function (e) {
        e.preventDefault();

        const spinner = $('#passwordSpinner');
        const alertContainer = $('#password-alert-container');
        const formData = new FormData(this);

        spinner.removeClass('d-none');
        alertContainer.empty();

        $.ajax({
            url: '{{ route("user.profile.update-password") }}',
            method: 'POST',
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
                $('#passwordForm')[0].reset();
            },
            error: function (error) {
                spinner.addClass('d-none');
                const message = error.responseJSON?.message || 'An error occurred.';
                alertContainer.html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }
        });
    });
</script>
@endpush
