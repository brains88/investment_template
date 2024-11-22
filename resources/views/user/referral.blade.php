@include('layout.header')

<body>
    <div class="wrapper">
        @include('layout.usernavbar') 
 <!------------- others main dashboard body content ------------>
              
<!-- My Referral -->
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>My Referral</h2>
             </div>
          </div>
       </div>

       <section class="refferal-link">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="box text-white">
                            <h4 class="golden-text">Referral Link</h4>
                            <div class="input-group">
                                <input
                                    type="text"
                                    value="{{ auth()->user()->referral_link }}"
                                    class="form-control"
                                    id="sponsorURL"
                                    readonly
                                />
                                <button class="gold-btn copytext" id="copyBoard" onclick="copyFunction()"><i class="fa fa-copy mx-1"></i>copy link</button>
                            </div>
                        </div>
                    </div>
                </div>

                                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start " id="ref-label">
                            <div class="nav flex-column nav-pills mx-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                    <a class=" nav-link    active   " id="v-pills-1-tab" href="javascript:void(0)" data-bs-toggle="pill" data-bs-target="#v-pills-1"  role="tab" aria-controls="v-pills-1" aria-selected="true">Level 1</a>
                                                            </div>
                            <div class="tab-content w-90" id="v-pills-tabContent">
                              <div class="tab-pane fade  show active   " id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Joined At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($referrals as $referral)
                                            <tr>
                                                <td data-label="Username">{{ $referral->referredUser->name }}</td>
                                                <td data-label="Email">{{ $referral->referredUser->email }}</td>
                                                <td data-label="Phone Number">{{ $referral->referredUser->mobile }}</td>
                                                <td data-label="Joined At">{{ $referral->referredUser->created_at->format('d M, Y h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No referrals yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                                                                            
                        </div>
                    </div>
                </div>
                


            </div>
        </section>

    </div>
 </section>
 @include('layout.usernavbar') 
</body>
</html>
