@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.adminnavbar') 
 <!------------- others main dashboard body content ------------>
            
<!-- My Referral -->

<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>User Referrals</h2>
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col">
             <div class="table-parent table-responsive">
                <table class="table table-striped mb-5">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>User</th>
                            <th>Referred User</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
        @forelse ($referrals as $referral)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $referral->user->username ?? 'N/A' }}</td> <!-- Referring User -->
            <td>{{ $referral->referredUser->username ?? 'N/A' }}</td> <!-- Referred User -->
            <td>{{ $referral->created_at->format('d M Y') }}</td>
                
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
</body>
</html>
