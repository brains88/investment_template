@extends('layouts.app')
@section('title', 'Wallet - Equitify Trades LC')

@section('content')
        <!-- Wallet Management Section -->
        <section class="transaction-history mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full d-flex justify-content-between align-items-center">
                            <h2>Available Wallets</h2>
                            <button class="btn gold-btn" data-bs-toggle="modal" data-bs-target="#addWalletModal">
                                <i class="fas fa-plus"></i> Add New Wallet
                            </button>
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

    <!-- End Success & Error Messages -->
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Wallet Image</th>
                                        <th>Coin</th>
                                        <th>Wallet Address</th>
                                        <th>Wallet Network</th>
                                        <th>Min. Amount</th>
                                        <th>Max. Amount</th>
                                        <th>Created On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($wallets as $wallet)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/coin/' . $wallet->image_path) }}" alt="Wallet Image" style="width: 50px;"></td>
                                            <td>{{ $wallet->coin }}</td>
                                            <td>{{ $wallet->address }}</td>
                                            <td>{{ $wallet->network }}</td>
                                            <td>${{ $wallet->min_amount }}</td>
                                            <td>${{ $wallet->max_amount }}</td>
                                            <td>{{ $wallet->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editWalletModal{{ $wallet->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <button class="btn btn-danger btn-sm delete-wallet" data-id="{{ $wallet->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Wallet Modal -->
                                        <div class="modal fade" id="editWalletModal{{ $wallet->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('wallets.update', $wallet->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Wallet</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form fields for editing -->
                                                            <div class="mb-3">
                                                                <label for="coin" class="form-label">Coin</label>
                                                                <input type="text" name="coin" class="form-control" value="{{ $wallet->coin }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Wallet Address</label>
                                                                <input type="text" name="address" class="form-control" value="{{ $wallet->address }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="network" class="form-label">Wallet Network</label>
                                                                <input type="text" name="network" class="form-control" value="{{ $wallet->network }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="min_amount" class="form-label">Min. Amount</label>
                                                                <input type="number" name="min_amount" class="form-control" value="{{ $wallet->min_amount }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="max_amount" class="form-label">Max. Amount</label>
                                                                <input type="number" name="max_amount" class="form-control" value="{{ $wallet->max_amount }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Wallet Image</label>
                                                                <input type="file" name="image" class="form-control">
                                                                <small>Leave blank if you don't want to change the image.</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update Wallet</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No wallets found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $wallets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add Wallet Modal -->
        <div class="modal fade" id="addWalletModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('wallets.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Wallet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields for adding -->
                            <div class="mb-3">
                                <label for="coin" class="form-label">Coin</label>
                                <input type="text" name="coin" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Wallet Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="network" class="form-label">Wallet Network</label>
                                <input type="text" name="network" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="min_amount" class="form-label">Min. Amount</label>
                                <input type="number" name="min_amount" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="max_amount" class="form-label">Max. Amount</label>
                                <input type="number" name="max_amount" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Wallet Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add Wallet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endsection
    <!-- JavaScript -->
     @push('scripts')
    <script>
    document.querySelectorAll('.delete-wallet').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id; // Get wallet ID
            if (confirm('Are you sure you want to delete this wallet?')) {
                const deleteButton = this;

                // Create a hidden form dynamically
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('wallets.destroy', '') }}/${id}`;
                form.style.display = 'none';

                // Add CSRF token input
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrfInput);

                // Add method spoofing input
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Append form to body and submit
                document.body.appendChild(form);
                deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                deleteButton.disabled = true;
                form.submit();
            }
        });
    });
</script>
@endpush