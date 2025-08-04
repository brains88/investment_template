@extends('layouts.app')
@section('title', 'Referral Bonus - Equitify Trades LC')

@section('content')

<!------------- others main dashboard body content ------------>

<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>Referral Bonus</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-parent table-responsive">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Bonus From</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referrals as $referral)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $referral->referredUser->username }}</td>
                                <td>{{ $referral->referral_bonus }} USD</td>
                                <td>level 1 Referral bonus From {{ $referral->referredUser->username }}</td>
                                <td>{{ $referral->created_at->format('d M Y')}}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No referrals found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-container text-center">
                        {{ $referrals->links('pagination::bootstrap-4') }}
                    </div>

                </div>


            </div>
        </div>
    </div>
    </div>
</section>
@endsection
