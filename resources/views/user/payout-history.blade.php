@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.usernavbar') 

        <section class="transaction-history mt-5 pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="header-text-full">
                            <h2>Payout Log</h2>
                        </div>
                    </div>
                </div>

                <form action="https://www.equitytradeslc.com/user/payout-history-search" method="get">
                    <div class="row select-transaction">
                        <!-- Search form as in your original code -->
                    </div>
                </form>

                <div class="row">
                    <div class="col">
                        <div class="table-parent table-responsive">
                            <table class="table table-striped mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Gateway</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Charge</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $withdrawal->transaction_number }}</td>
                                            <td>{{ $withdrawal->method }}</td>
                                            <td>{{ $withdrawal->amount }} USD</td>
                                            <td>0.00 USD</td>
                                            <td>
                                                <span class="badge 
                                                    @if($withdrawal->status == 'pending')
                                                        bg-danger
                                                    @elseif($withdrawal->status == 'complete')
                                                        bg-success
                                                    @endif
                                                ">
                                                    {{ ucfirst($withdrawal->status) }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('d M Y h:i A') }}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-sm infoButton"
                                                    data-information="{{ json_encode($withdrawal->details) }}"
                                                    data-feedback="{{ $withdrawal->admin_feedback }}"
                                                    data-trx_id="{{ $withdrawal->transaction_number }}"
                                                     data-amount="{{ $withdrawal->amount }}"
                                                    data-address="{{ $withdrawal->wallet_address }}"
                                                     data-coin="{{ $withdrawal->coin_type }}"
                                                    data-network="{{ $withdrawal->network }}"
                                                    data-bank="{{ $withdrawal->bank_name }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#infoModal"
                                                >
                                                    <i class="fa fa-info-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                              <!-- Pagination -->
                            <div class="pagination-container">
                                {{ $withdrawals->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title golden-text" id="infoModalLabel">Details</h3>
                        <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close">
                            <img src="https://www.equitytradeslc.com/assets/themes/deepblack/img/icon/cross.png" alt="modal dismiss" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Transaction: <span class="trx"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Amount: <span class="amount"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Bank Name: <span class="bank"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Wallet Address: <span class="address"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Coin: <span class="coin"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Network: <span class="network"></span></li>
                            <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">Admin Feedback: <span class="feedback"></span></li>
                        </ul>
                        <div class="payout-detail text-white"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="gold-btn" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layout.footer')

    <script>
        // JavaScript to handle modal data
        const infoButtons = document.querySelectorAll('.infoButton');
        infoButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get data from the clicked button
                const transactionDetails = this.getAttribute('data-information');
                const feedback = this.getAttribute('data-feedback');
                const trxId = this.getAttribute('data-trx_id');
                const amount = this.getAttribute('data-amount');
                const address = this.getAttribute('data-address');
                const coin = this.getAttribute('data-coin');
                const network = this.getAttribute('data-network');
                const bank = this.getAttribute('data-bank');

                // Parse transaction details if it is JSON
                const details = JSON.parse(transactionDetails);

                // Populate modal with the corresponding information
                document.querySelector('.trx').textContent = trxId;
                document.querySelector('.feedback').textContent = feedback;
                document.querySelector('.amount').textContent = amount ;
                document.querySelector('.address').textContent = address;
                document.querySelector('.coin').textContent = coin;
                document.querySelector('.network').textContent = network;
                document.querySelector('.bank').textContent = bank;
                document.querySelector('.payout-detail').textContent = details;

            });
        });
    </script>

</body>
