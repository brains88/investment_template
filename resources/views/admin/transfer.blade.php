@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.adminnavbar') 

        <!-- transfer History -->
<section class="transaction-history pt-5 mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>Users Transfer Log</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-parent table-responsive">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th scope="col">Sender</th>
                                <th scope="col">Receiver</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transfers as $transfer)
                            <tr>
                                        <td>{{ $transfer->sender->name }}</td>
                                        <td>{{ $transfer->receiver->name }}</td>
                                        <td>{{ $transfer->amount }} USD</td>
                                        <td>{{ ucfirst($transfer->status) }}</td>
                                        <td>{{ $transfer->created_at->format('d M Y h:i A') }}</td>
                                        <td>
                                            <button class="btn btn-danger delete-btn" data-id="{{ $transfer->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Transfer history for User.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $transfers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

  
     <!-- Delete Confirmation Modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this transfer?
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
  
</section>

    </div>

    @include('layout.footer')

    <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const form = document.getElementById('delete-form');
            form.action = `{{ route('transfers.delete', '') }}/${id}`;
        });
    });

    document.querySelectorAll('form button[type="submit"]').forEach(button => {
    button.addEventListener('click', function () {
        const spinner = this.querySelector('.spinner-border');
        if (spinner) {
            spinner.classList.remove('d-none');
        }
    });
});

</script>

</body>
