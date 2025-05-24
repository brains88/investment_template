@include('layout.header')
<body>
    <div class="wrapper">
        @include('layout.usernavbar')

        <div class="mt-5">
            <section class="investment-section" id="investment-section" style="background-size: cover; background-position: center center;">
                <div class="overlay">
                    <div class="container text-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8 text-center">
                                <div class="investment-text">
                                    <h5 class="investment-title mt-3" style="font-size: 1.5rem; font-weight: bold; color: #fff;">INVESTMENT OFFER</h5>
                                    <h2 class="investment-subtitle" style="font-size: 2rem; color: #fff;">Our Investment Plans</h2>
                                    <p class="investment-title-describe" style="color: #fff; margin-top: 10px;">
                                        Equitify Trades provides a straightforward and transparent mechanism to attract investments and make more profits.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Cards to display plans -->
                        <div class="row mb-4">
                            @foreach ($plans as $plan)
                                <div class="col-lg-4 mb-3"> <!-- Reduced bottom margin here -->
                                    <div class="card shadow-lg" style="border-radius: 10px !important; overflow: hidden; transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                                            <div class="card-body">
                                            <div class="plan-header text-center">
                                                <h3 class="plan-name" >{{ $plan->name }}</h3>
                                                <p class="plan-amount mb-2" style="font-size: 1.5rem; font-weight: bold; color: #2e7d32;">
                                                ${{ $plan->min_amount }} - ${{ $plan->max_amount }}
                                                </p>
                                            </div>

                                            <div class="plan-details text-center">
                                                <span class="badge bg-success p-3 mb-3" style="font-size: 1.1rem;">
                                                <b>{{ $plan->interest }}% ROI</b>
                                                </span>
                                                <p class="duration" style="margin-bottom: 1rem;">
                                                For {{ $plan->duration}} Week(s)
                                                </p>
                                            </div>

                                            <div id="alert-container"></div>
                                            <!-- Investment Form -->
                                            <form id="investment-form-{{ $plan->id }}" 
                                                action="{{ route('investment.submit', $plan->id) }}" 
                                                method="POST" 
                                                onsubmit="submitInvestmentForm(event, {{ $plan->id }})">
                                                @csrf
                                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                                <input type="number" name="amount" placeholder="Enter amount" class="form-control mb-3" required />
                                                <div id="alert-container-{{ $plan->id }}" class="mt-2"></div> <!-- Unique alert container -->
                                                <button type="submit" class="btn gold-btn w-100" style="margin-top: 10px;">Invest Now</button>
                                                <div id="spinner-{{ $plan->id }}" class="spinner-border text-light d-none" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </form>
                                        <!-- The end of Investment Form -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                         <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $plans->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('layout.footer')
    </div>

    <div id="alert-container"></div>

    <script>
function submitInvestmentForm(event, planId) {
    event.preventDefault();
    var form = document.getElementById('investment-form-' + planId);
    var spinner = document.getElementById('spinner-' + planId);
    var alertContainer = document.getElementById('alert-container-' + planId); // Use unique alert container

    spinner.classList.remove('d-none');
    var button = form.querySelector('button');
    button.disabled = true;

    var formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || 'An error occurred');
                });
            }
            window.location.href = '/user/invest-history';
            return response.json();
        })
        .then(data => {
            spinner.classList.add('d-none');
            button.disabled = false;

            // Clear previous alerts in the unique container
            alertContainer.innerHTML = '';

            var alertMessage = document.createElement('div');
            alertMessage.classList.add('alert', data.success ? 'alert-success' : 'alert-danger');
            alertMessage.innerText = data.message;

            alertContainer.appendChild(alertMessage);

            setTimeout(() => {
                alertMessage.remove();
            }, 3000);

            

             })
        .catch(error => {
            spinner.classList.add('d-none');
            button.disabled = false;

            // Clear previous alerts in the unique container
            alertContainer.innerHTML = '';

            var alertMessage = document.createElement('div');
            alertMessage.classList.add('alert', 'alert-danger');
            alertMessage.innerText = error.message;

            alertContainer.appendChild(alertMessage);

            setTimeout(() => {
                alertMessage.remove();
            }, 5000);
        });
}


    </script>

    <style>
        .alert-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
            max-width: 400px;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            transition: opacity 0.3s ease-in-out;
        }

        .alert-custom-success {
            background-color: #4caf50;
            color: white;
        }

        .alert-custom-error {
            background-color: #f44336;
            color: white;
        }

        .fade-out {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .spinner-border {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</body>
