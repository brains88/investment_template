@include('layout.header') <!-- Header Component -->

<body>
<div class="wrapper">
    @include('layout.adminnavbar') <!-- User Navbar -->

    <section class="transaction-history mt-5 pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>Users </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-parent table-responsive">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Joined</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y h:i A') }}</td>
                                        <td class="d-flex gap-2">
                                            <!-- View Button -->
                                            <a href="{{ route('user.view', $user->id) }}" class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <!-- Button to Open Modal -->
                                            <a data-bs-toggle="modal" data-bs-target="#emailModal{{ $user->id }}" class="btn btn-info" style="background-color: green; color: #fff; border-color: green;">
                                                <i class="fas fa-envelope"></i>
                                            </a>

                                            <!-- End Of Emailing Codes -->
                                            @if($user->account === 'active')
                                                <!-- Ban Button -->
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#banModal{{ $user->id }}" title="Ban">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            @else
                                                <!-- Unban Button -->
                                                <form action="{{ route('user.unban', $user->id) }}" method="POST" style="display:inline;" id="banForm{{ $user->id }}">
                                                    @csrf
                                                    @method('post')
                                                    <button type="submit" class="btn btn-success" id="banButton{{ $user->id }}">
                                                        Unban
                                                        <i class="fas fa-spinner fa-spin d-none" id="spinner{{ $user->id }}"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Delete Button -->
                                            <form id="deleteForm{{ $user->id }}" action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                                     <!-- Ban Modal -->
                                     <div class="modal fade" id="banModal{{ $user->id }}" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.email', $user->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="ban_reason" class="form-label">Reason for Banning</label>
                                                            <textarea id="ban_reason" name="ban_reason" class="form-control" required></textarea>
                                                        </div>
                                                    </div>
                                                    @if(session('message'))
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            {{ session('message') }}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning" id="banButton{{ $user->id }}">
                                                            Ban User
                                                            <span class="spinner-border spinner-border-sm d-none" id="spinner{{ $user->id }}" role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ban Modal -->
                                    <div class="modal fade" id="banModal{{ $user->id }}" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.ban', $user->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="ban_reason" class="form-label">Reason for Banning</label>
                                                            <textarea id="ban_reason" name="ban_reason" class="form-control" required></textarea>
                                                        </div>
                                                    </div>
                                                    @if(session('message'))
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            {{ session('message') }}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning" id="banButton{{ $user->id }}">
                                                            Ban User
                                                            <span class="spinner-border spinner-border-sm d-none" id="spinner{{ $user->id }}" role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this user? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <!-- Delete Button inside modal -->
                                                    <button type="submit" class="btn btn-danger" form="deleteForm{{ $user->id }}">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Send Mail Modal -->
                                     <!-- Session Success and Error Alerts -->
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
                                 <!-- Email Modal -->
                                <div class="modal fade" id="emailModal{{ $user->id }}" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Email User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.email', $user->id) }}" method="POST" id="emailForm{{ $user->id }}" onsubmit="handleEmailSubmit({{ $user->id }})">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="email_subject{{ $user->id }}">Subject</label>
                                                        <input type="text" class="form-control" id="email_subject{{ $user->id }}" name="email_subject" placeholder="Enter email subject" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email_content{{ $user->id }}">Email Content</label>
                                                        <textarea class="form-control" id="email_content{{ $user->id }}" name="email_content" rows="5" placeholder="Enter email content" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" id="sendButton{{ $user->id }}">Send Email</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- The End of Email -->
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>


@include('layout.footer') 

<script>
    document.querySelectorAll('form[id^="banForm"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            let userId = this.id.replace('banForm', '');
            
            // Disable the button to prevent multiple submissions
            document.getElementById('banButton' + userId).disabled = true;

            // Show the spinner (remove the 'd-none' class)
            let spinner = document.getElementById('spinner' + userId);
            spinner.classList.remove('d-none'); // Make the spinner visible
        });
    });
</script>

<script>
    // Delete confirmation for delete button
    document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.closest('form').id.replace('deleteForm', '');
            let deleteForm = document.getElementById('deleteForm' + userId);
            
            // Set the form action dynamically inside the modal
            const formAction = deleteForm.action;
            const modalSubmitButton = document.querySelector(`#deleteModal${userId} .btn-danger`);
            modalSubmitButton.onclick = function() {
                deleteForm.submit();
            };
        });
    });

    //send email
    function handleEmailSubmit(userId) {
    // Get the send button
    const sendButton = document.getElementById(`sendButton${userId}`);
    
    // Disable the button and change its text to "Sending..."
    sendButton.disabled = true;
    sendButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...`;
}



</script>

</body>
</html>
