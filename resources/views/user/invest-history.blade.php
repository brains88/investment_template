@include('layout.header')
<!-- Header Component -->

<body>
    <div class="wrapper">
        @include('layout.usernavbar')
        <!-- User Navbar -->

        <!-- Invest history -->
        <section class="transaction-history mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Invest History</h2>
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
                                    @if($investments->isEmpty())
                                    <!-- Check if the investments collection is empty -->
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
                                            {{ $investment->return_on_investment }} USD per
                                            {{ $investment->plan->duration }} Days
                                        </td>
                                        <td>
                                            {{ $investment->amount * ($investment->return_on_investment / 10000) }} USD
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-start">
                                                <!-- Countdown Timer -->
                                                <span class="countdown mb-1" id="countdown-{{ $investment->id }}"
                                                    data-remaining-time="{{ $investment->remainingTime ?? 0 }}"
                                                    data-total-time="{{ $investment->totalTime ?? 0 }}">
                                                    {{ gmdate('z\d: H\h i\m s\s', $investment->remainingTime ?? 0) }}
                                                </span>
                                                <div class="progress w-100">
                                                    <div id="progress-bar-{{ $investment->id }}"
                                                        class="progress-bar {{ $investment->investPercentage == 100 ? 'bg-success' : 'bg-info' }}"
                                                        role="progressbar"
                                                        style="width: {{ $investment->investPercentage ?? 0 }}%;"
                                                        aria-valuenow="{{ $investment->investPercentage ?? 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100">
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
        document.querySelectorAll('.countdown').forEach(countdown => {
            const countdownId = countdown.id;
            const investmentId = countdownId.split('-')[1];
            const progressBar = document.getElementById(`progress-bar-${investmentId}`);

            // Get total and remaining time from the backend
            const totalTime = parseInt(countdown.getAttribute('data-total-time'),
            10); // Total duration in seconds
            let remainingTime = parseInt(countdown.getAttribute('data-remaining-time'),
            10); // Remaining time in seconds

            const interval = setInterval(() => {
                if (remainingTime > 0) {
                    // Decrease remaining time
                    remainingTime -= 1;

                    // Calculate progress percentage
                    const progressPercentage = ((totalTime - remainingTime) / totalTime) * 100;

                    // Update countdown timer text
                    const days = Math.floor(remainingTime / (24 * 3600));
                    const hours = Math.floor((remainingTime % (24 * 3600)) / 3600);
                    const minutes = Math.floor((remainingTime % 3600) / 60);
                    const seconds = remainingTime % 60;

                    countdown.textContent =
                        `${days.toString().padStart(2, '0')}d ${hours.toString().padStart(2, '0')}h ${minutes.toString().padStart(2, '0')}m ${seconds.toString().padStart(2, '0')}s`;

                    // Update progress bar
                    progressBar.style.width = `${progressPercentage}%`;
                    progressBar.setAttribute('aria-valuenow', progressPercentage.toFixed(2));
                } else {
                    // Clear interval when the countdown finishes
                    clearInterval(interval);
                    countdown.textContent = `00d 00h 00m 00s`;
                }
            }, 1000);
        });
    });
    </script>


</body>