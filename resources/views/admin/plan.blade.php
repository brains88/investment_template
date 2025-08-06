@extends('layouts.app')
@section('title', 'Plan- Equitify Trades LC')

@section('content')

        <!-- Plan Management Section -->
        <section class="transaction-history plan-management mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full d-flex justify-content-between align-items-center">
                            <h2>Available Plans</h2>
                            <button class="btn gold-btn" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                                <i class="fas fa-plus"></i> Add New Plan
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
                                        <th>Name</th>
                                        <th>Interest</th>
                                        <th>Duration</th>
                                        <th>Min. Amount</th>
                                        <th>Max. Amount</th>
                                        <th>Created On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($plans as $plan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ $plan->interest }}%</td>
                                            <td>{{ $plan->duration }} week(s)</td>
                                            <td>${{ $plan->min_amount }}</td>
                                            <td>${{ $plan->max_amount }}</td>
                                            <td>{{ $plan->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPlanModal{{ $plan->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <button class="btn btn-danger btn-sm delete-plan" data-id="{{ $plan->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Plan Modal -->
                                        <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('plans.update', $plan->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Plan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form fields for editing -->
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Plan Name</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="interest" class="form-label">Interest (%)</label>
                                                                <input type="number" name="interest" class="form-control" value="{{ $plan->interest }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="duration" class="form-label">Duration (weeks)</label>
                                                                <input type="number" name="duration" class="form-control" value="{{ $plan->duration }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="min_amount" class="form-label">Min. Amount</label>
                                                                <input type="number" name="min_amount" class="form-control" value="{{ $plan->min_amount }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="max_amount" class="form-label">Max. Amount</label>
                                                                <input type="number" name="max_amount" class="form-control" value="{{ $plan->max_amount }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update Plan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No plans found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $plans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add Plan Modal -->
        <div class="modal fade" id="addPlanModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('plans.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields for adding -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Plan Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="interest" class="form-label">Interest (%)</label>
                                <input type="number" name="interest" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (weeks)</label>
                                <input type="number" name="duration" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="min_amount" class="form-label">Min. Amount</label>
                                <input type="number" name="min_amount" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="max_amount" class="form-label">Max. Amount</label>
                                <input type="number" name="max_amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add Plan</button>
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
    document.querySelectorAll('.delete-plan').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id; // Get plan ID
            if (confirm('Are you sure you want to delete this plan?')) {
                const deleteButton = this;

                // Create a hidden form dynamically
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('plans.destroy', '') }}/${id}`;
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
