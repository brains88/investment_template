@include('layout.header') <!-- Header Component -->

<body>
    <div class="wrapper">
        @include('layout.adminnavbar') <!-- User Navbar -->

        <!-- Invest history -->
        <section class="transaction-history mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Investment History</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-parent table-responsive">
                            <table class="table table-striped mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Return Interest</th>
                                        <th scope="col">Received Amount</th>
                                        <th scope="col">Upcoming Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($investments->isEmpty()) <!-- Check if the investments collection is empty -->
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-danger mt-4">No Active Investment</div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($investments as $index => $investment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $investment->plan->name }}<br>
                                                {{ $investment->amount }} USD
                                            </td>
                                            <td>
                                                {{ $investment->return_on_investment }} USD per {{ $investment->plan->duration }} Days
                                            </td>
                                            <td>
                                                {{ $investment->amount * ($investment->return_on_investment / 100) }} USD
                                            </td>
                                            <td>
                                            <div class="d-flex flex-column align-items-start">
                                            <!-- Countdown Timer -->
                                            <span 
                                                class="countdown mb-1" 
                                                id="countdown-{{ $investment->id }}" 
                                                data-remaining-time="{{ $investment->remainingTime }}" 
                                                data-total-time="{{ $investment->totalTime }}">
                                                {{ gmdate('z\d: H\h i\m s\s', $investment->remainingTime) }}
                                            </span>
                                            <div class="progress w-100">
                                                <div
                                                    id="progress-bar-{{ $investment->id }}"
                                                    class="progress-bar {{ $investment->investPercentage == 100 ? 'bg-success' : 'bg-info' }}"
                                                    role="progressbar"
                                                    style="width: {{ $investment->investPercentage }}%;"
                                                    aria-valuenow="{{ $investment->investPercentage }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                >
                                                    {{ number_format($investment->investPercentage, 2) }}%
                                                </div>
                                            </div>
                                        </div>

                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                            </table>
                        </div>
                         <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $investments->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    @include('layout.footer')

    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Find all countdown elements
    document.querySelectorAll('.countdown').forEach(countdown => {
        const countdownId = countdown.id;
        const investmentId = countdownId.split('-')[1];
        const progressBar = document.getElementById(`progress-bar-${investmentId}`);

        const totalTime = parseInt(countdown.getAttribute('data-total-time'), 10); // Total time in seconds
        let remainingTime = parseInt(countdown.getAttribute('data-remaining-time'), 10); // Remaining time in seconds

        const interval = setInterval(() => {
            // Decrease the remaining time
            remainingTime = Math.max(0, remainingTime - 1);

            // Calculate the progress percentage
            const progressPercentage = ((totalTime - remainingTime) / totalTime) * 100;

            // Update the countdown timer text
            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = remainingTime % 60;
            countdown.textContent = `${hours.toString().padStart(2, '0')}h ${minutes.toString().padStart(2, '0')}m ${seconds.toString().padStart(2, '0')}s`;

            // Update the progress bar
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.setAttribute('aria-valuenow', progressPercentage.toFixed(2));
            progressBar.textContent = `${progressPercentage.toFixed(2)}%`;

            // Stop when the countdown reaches zero
            if (remainingTime === 0) {
                clearInterval(interval);
                progressBar.classList.remove('bg-info');
                progressBar.classList.add('bg-success');
            }
        }, 1000);
    });
});
</script>

</body>
