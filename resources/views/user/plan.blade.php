@extends('layouts.app')
@section('title', 'Investment Plan - Equitify Trades LC')

@section('content')
<section class="investment-section py-5" style="background-color: #111; ">
    <div class="container text-center">

        <!-- Section Header -->
        <div class="text-white mb-5" style="margin-top: 20px; padding-top: 60px;">

            <h2 class="fw-bold text-center" style=" padding-top:10px; padding-bottom:25px; text-align:center;">Our
                Investment Plans</h2>
        </div>

        <!-- Investment Cards -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
            @foreach ($plans as $plan)
            <div
                style="flex: 1 1 calc(33.333% - 20px); max-width: 350px; background: #222; color: white; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.5); padding: 25px; text-align: center;">

                <h2 class="text-light mb-3" style="padding-top:10px;">{{ strtoupper($plan->name) }}</h2>

                <p class="fs-5" style="color: #4caf50; margin: 5px 0;">
                    ${{ number_format($plan->min_amount, 2) }} - ${{ number_format($plan->max_amount, 2) }}
                </p>

                <div
                    style="background: #4caf50; color: black; padding: 8px 16px; border-radius: 8px; font-weight: bold; display: inline-block; margin-bottom: 10px;">
                    {{ $plan->interest }}% ROI
                </div>

                <p class="text-light mb-3">For {{ $plan->duration }} Week(s)</p>

                <form id="investment-form-{{ $plan->id }}" action="{{ route('investment.submit', $plan->id) }}"
                    method="POST" onsubmit="submitInvestmentForm(event, {{ $plan->id }})">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <input type="number" name="amount" class="form-control mb-3 bg-dark text-white border-warning"
                        placeholder="Enter amount" required style="border-radius: 8px; padding: 12px; font-size: 16px;">

                    <div id="alert-container-{{ $plan->id }}" class="mt-2"></div>

                    <button id="invest-btn-{{ $plan->id }}" type="submit" class="btn gold-btn w-100"
                        style="color:#000; height: 45px; font-size: 1.1rem; border-radius: 8px; margin-top: 10px; padding: 10px;"">
                        <span class=" btn-text">Invest Now</span>
                        <div id="btn-spinner-{{ $plan->id }}"
                            class="spinner-border spinner-border-sm text-light d-none ms-2" role="status"
                            style="vertical-align: middle;">
                        </div>
                    </button>
                </form>



            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $plans->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
function submitInvestmentForm(event, planId) {
    event.preventDefault();

    const form = document.getElementById('investment-form-' + planId);
    const alertContainer = document.getElementById('alert-container-' + planId);
    const button = document.getElementById('invest-btn-' + planId);
    const spinner = document.getElementById('btn-spinner-' + planId);
    const btnText = button.querySelector('.btn-text');

    // Clear old alerts, show spinner
    alertContainer.innerHTML = '';
    button.disabled = true;
    spinner.classList.remove('d-none');
    btnText.textContent = 'Processing...';

    const formData = new FormData(form);

    fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'An error occurred');
            }

            const alertSuccess = document.createElement('div');
            alertSuccess.classList.add('alert', 'alert-success');
            alertSuccess.innerText = data.message || 'Investment successful!';
            alertContainer.appendChild(alertSuccess);

            setTimeout(() => {
                window.location.href = '/user/invest-history';
            }, 2000);
        })
        .catch(error => {
            const alertError = document.createElement('div');
            alertError.classList.add('alert', 'alert-danger');
            alertError.innerText = error.message || 'Something went wrong';
            alertContainer.appendChild(alertError);
        })
        .finally(() => {
            spinner.classList.add('d-none');
            button.disabled = false;
            btnText.textContent = 'Invest Now';

            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        });
}
</script>
@endpush