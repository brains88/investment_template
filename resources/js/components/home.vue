<template>
    <!-- Navbar top begin -->
    <Navbar></Navbar>
    <!--The End of Navbar-->
    <!-- banner top begin -->
    <section class="banner-section">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="background-video">
            <source :src="'assets/videos/motion-video.mp4'" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <!-- Overlay Content -->
        <div class="overlay">
            <div class="container">
                <div class="total-slide">
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <div class="banner-text">
                                <h1 class="cd-headline clip is-full-width">
                                    You Can Use EQuitify Trades <br />For
                                    <span class="cd-words-wrapper">
                                        <b
                                            class="is-hidden"
                                            :style="{ color: '#ffce28' }"
                                            >Investment</b
                                        >
                                        <b
                                            class="is-hidden"
                                            :style="{
                                                color: 'rgb(85, 43, 170)',
                                                backgroundColor: '#ffffff',
                                            }"
                                            >Trades</b
                                        >
                                        <b
                                            class="is-visible"
                                            :style="{ color: '#ffce28' }"
                                            >Deposit</b
                                        >
                                        <b
                                            class="is-hidden"
                                            :style="{
                                                color: 'rgb(85, 43, 170)',
                                                backgroundColor: '#ffffff',
                                            }"
                                            >Earn Money</b
                                        >
                                        <b
                                            class="is-hidden"
                                            :style="{ color: '#ffce28' }"
                                            >Profit</b
                                        >
                                        <b
                                            class="is-hidden"
                                            :style="{ color: '#ffce28' }"
                                            >Much more...</b
                                        >
                                    </span>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-12 text-center">
                            <div class="get-start">
                                <router-link to="/register"
                                    >GET STARTED NOW!</router-link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="statics-section">
                <div class="container">
                    <div class="row" :style="{ marginTop: '10% !important' }">
                        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                            <div class="single-statics">
                                <div class="icon-box">
                                    <i
                                        class="fa fa-users"
                                        :style="{
                                            fontSize: '25px',
                                            color: '#ffce28',
                                        }"
                                    ></i>
                                </div>
                                <div class="text-box">
                                    <span
                                        class="text-white"
                                        :style="{
                                            fontWeight: '600 !important',
                                            fontSize: '40px',
                                        }"
                                        >27430</span
                                    >
                                    <h4>Registered Users</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                            <div class="single-statics">
                                <div class="icon-box">
                                    <i
                                        class="fa fa-globe"
                                        :style="{
                                            fontSize: '25px',
                                            color: '#ffce28',
                                        }"
                                    ></i>
                                </div>
                                <div class="text-box">
                                    <span
                                        class="text-white"
                                        :style="{
                                            fontWeight: '600 !important',
                                            fontSize: '40px',
                                        }"
                                        >250</span
                                    >
                                    <h4>Supported Countries</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                            <div class="single-statics">
                                <div class="icon-box">
                                    <i
                                        class="fa fa-money-bill-wave"
                                        :style="{
                                            fontSize: '25px',
                                            color: '#ffce28',
                                        }"
                                    ></i>
                                </div>
                                <div class="text-box">
                                    <span
                                        class="text-white"
                                        :style="{
                                            fontWeight: '600 !important',
                                            fontSize: '40px',
                                        }"
                                        >4150</span
                                    >
                                    <h4>Withdrawn Each Month</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                            <div class="single-statics">
                                <div class="icon-box">
                                    <i
                                        class="fa fa-chart-line"
                                        :style="{
                                            fontSize: '25px',
                                            color: '#ffce28',
                                        }"
                                    ></i>
                                </div>
                                <div class="text-box">
                                    <span
                                        class="text-white"
                                        :style="{
                                            fontWeight: '600 !important',
                                            fontSize: '40px',
                                        }"
                                        >500</span
                                    >
                                    <h4>Active Investors Daily</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- banner top end -->

    <!-- about section begin -->
    <section class="about-section navigation" id="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="about-left">
                        <div class="about-text">
                            <h5 class="about-title">
                                WELCOME TO EQUITIFY TRADES
                            </h5>
                            <h2 class="about-subtitle">A few words About Us</h2>
                            <h5 class="about-details">
                                Empowering <span>today's investors</span> with
                                innovative fund management solutions
                            </h5>
                            <p class="about-description">
                                Equitify Trades - a private financial firm
                                specializing in advanced investment strategies.
                                Our approach minimizes risk through a refined,
                                semi-automated trading system. We've enhanced
                                our automated processes, ensuring each final
                                trade decision is carefully reviewed by our
                                expert team.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-right">
                        <div class="video-box">
                            <img :src="'assets/img/investors.jpg'" alt="#" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-left">
                <div class="about-box mt-4">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-sm-6 col-md-3 col-lg-3 mt-3">
                                <div class="single-about-box">
                                    <div class="icon-box-outer bg-eff">
                                        <div class="icon-box">
                                            <i class="ren-efficiency"></i>
                                        </div>
                                    </div>
                                    <h3>Efficiency</h3>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="single-about-box">
                                    <div class="icon-box-outer bg-ex">
                                        <div class="icon-box">
                                            <img
                                                :src="'./assets/img/expierence.svg'"
                                                alt="#"
                                            />
                                        </div>
                                    </div>
                                    <h3>Experience</h3>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="single-about-box">
                                    <div class="icon-box-outer bg-trans">
                                        <div class="icon-box">
                                            <i class="ren-transparent"></i>
                                        </div>
                                    </div>
                                    <h3>Transparent</h3>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="single-about-box">
                                    <div class="icon-box-outer bg-security">
                                        <div class="icon-box">
                                            <i class="ren-security"></i>
                                        </div>
                                    </div>
                                    <h3>Security</h3>
                                </div>
                            </div>
                        </div>
                        <!--
            <div class="row  mt-4">
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-about-box">
                        <div class="icon-box-outer bg-trans">
                            <div class="icon-box">
                                <i class="ren-transparent"></i>
                            </div>
                        </div>
                        <h3>Transparent</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-about-box">
                        <div class="icon-box-outer bg-simple">
                            <div class="icon-box">
                                <i class="ren-simple"></i>
                            </div>
                        </div>
                        <h3>Simple</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-about-box">
                        <div class="icon-box-outer bg-com">
                            <div class="icon-box">
                                <i class="ren-compliant"></i>
                            </div>
                        </div>
                        <h3>Compliant</h3>
                    </div>
                </div>
            </div>
            -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

    <!-- choose section begin -->
    <section class="choose-section">
        <div class="overlay">
            <div class="container-fruit text-center">
                <div class="row mr-0 ml-0 d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-12">
                        <div class="choose-text">
                            <h5 class="choose-title">Boost Your Money</h5>
                            <h2 class="choose-subtitle">Why Choose Us?</h2>
                            <p class="choose-title-describe">
                                Our service offers superior returns and flexible
                                management, allowing you to oversee your
                                investments anytime, anywhere.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="choose-section-carousel">
                    <div class="col">
                        <div class="single-item">
                            <div class="icon-box">
                                <img
                                    :src="'assets/img/daily-income.svg'"
                                    alt="#"
                                />
                            </div>
                            <div class="text-box">
                                <h2 class="single-item-title">Daily Income</h2>
                                <h3 class="single-item-description">
                                    Earn returns daily, helping your wealth
                                    steadily grow.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="single-item">
                            <div class="icon-box">
                                <img
                                    :src="'assets/img/withdraw1.svg'"
                                    alt="#"
                                />
                            </div>
                            <div class="text-box">
                                <h2 class="single-item-title">
                                    Fastest Payments
                                </h2>
                                <h3 class="single-item-description">
                                    Quick and secure withdrawals anytime you
                                    need it.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="single-item">
                            <div class="icon-box">
                                <img
                                    :src="'assets/img/invest-fild.svg'"
                                    alt="#"
                                />
                            </div>
                            <div class="text-box">
                                <h2 class="single-item-title">Easy to Use</h2>
                                <h3 class="single-item-description">
                                    Easily manage your investments from
                                    anywhere, anytime.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="single-item">
                            <div class="icon-box">
                                <img :src="'assets/img/security.svg'" alt="#" />
                            </div>
                            <div class="text-box">
                                <h2 class="single-item-title">High Security</h2>
                                <h3 class="single-item-description">
                                    Top security standards to protect your
                                    assets always.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="single-item">
                            <div class="icon-box">
                                <img
                                    :src="'assets/img/customer-service.svg'"
                                    alt="#"
                                />
                            </div>
                            <div class="text-box">
                                <h2 class="single-item-title">24/7 Support</h2>
                                <h3 class="single-item-description">
                                    Our support team is here to assist you
                                    anytime.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- choose section end -->

    <!-- invest section begin -->
    <section
        class="invest-section"
        :style="{ backgroundImage: 'url(assets/img/invest-bg.jpg.jfif)' }"
    >
        <div class="overlay">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="invest-text">
                            <h5 class="invest-title">
                                How You Can Invest Your
                            </h5>
                            <h2 class="invest-subtitle">Money More Smartly</h2>
                            <p class="invest-title-describe">
                                It’s a simple way to start invest.You don’t need
                                a deep wallet to start behoof. Pick an amount
                                you can afford, and build your behoof over time.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div
                        class="col-lg-4 col-md-4 col-sm-4 text-center reunir-content-center"
                    >
                        <div class="single-box location-left">
                            <div class="img-box">
                                <div class="font-side">
                                    <img
                                        :src="'assets/img/sign-up.svg'"
                                        alt="#"
                                    />
                                </div>
                                <div class="back-side">
                                    <img
                                        :src="'assets/img/sign-up.svg'"
                                        alt="#"
                                    />
                                </div>
                            </div>
                            <div class="text-box">
                                <a href="#"
                                    >FIRST STEP<i class="ren-arrowright"></i
                                ></a>
                                <h3 :style="{ color: '#ffce28' }">SING UP</h3>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-4 col-md-4 col-sm-4 text-center reunir-content-center"
                    >
                        <div class="single-box">
                            <div class="img-box">
                                <div class="font-side">
                                    <img
                                        :src="'assets/img/deposit.svg'"
                                        alt="#"
                                    />
                                </div>
                                <div class="back-side">
                                    <img
                                        :src="'assets/img/deposit.svg'"
                                        alt="#"
                                    />
                                </div>
                            </div>
                            <div class="text-box">
                                <a href="#"
                                    >SECOND STEP<i class="ren-arrowright"></i
                                ></a>
                                <h3 :style="{ color: '#ffce28' }">
                                    Make a Deposit
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-4 col-md-4 col-sm-4 text-center reunir-content-center"
                    >
                        <div class="single-box location-right">
                            <div class="img-box">
                                <div class="font-side">
                                    <img
                                        :src="'assets/img/withdraw-1.svg'"
                                        alt="#"
                                    />
                                </div>
                                <div class="back-side">
                                    <img
                                        :src="'assets/img/withdraw-1.svg'"
                                        alt="#"
                                    />
                                </div>
                            </div>
                            <div class="text-box">
                                <a href="#"
                                    >THIRD STEP<i class="ren-arrowright"></i
                                ></a>
                                <h3 :style="{ color: '#ffce28' }">Withdraw</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- invest section end -->

    <!-- investment section begin -->
    <section
        class="investment-section"
        id="investment-section"
        :style="{
            backgroundImage: 'url(assets/img/investment-bg.jpg.jfif)',
            marginBottom: '8%',
        }"
    >
        <div class="overlay" :style="{ backgroundColor: '#ffffff' }">
            <div class="container text-center">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="investment-text">
                            <h5 class="investment-title">INVESTMENT OFFER</h5>
                            <h2 class="investment-subtitle">
                                Our Investment Plans
                            </h2>
                            <p class="investment-title-describe">
                                Equitify Trades provides a straightforward and
                                transparent mechanism to attract investments and
                                make more profits.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cards to display plans -->
                <div class="row mb-4">
                    <div
                        class="col-lg-4 mb-4"
                        v-for="plan in plans"
                        :key="plan.id"
                    >
                        <div class="card shadow-lg">
                            <!--
                            <img
                                :src="'assets/img/coin.jpg'"
                                class="card-img-top"
                                alt="Investment Plan"
                            />
                            -->
                            <div class="card-body">
                                <div class="plan-header text-center">
                                <h3 class="plan-name" >{{ plan.name }}</h3>
                                <p class="plan-amount mb-2" style="font-size: 1.5rem; font-weight: bold; color: #2e7d32;">
                                ${{ plan.min_amount }} - ${{ plan.max_amount }}
                                </p>
                            </div>

                            <div class="plan-details text-center">
                                <span class="badge bg-success p-3 mb-3" style="font-size: 1.1rem;">
                                <b>{{ plan.interest }}% ROI</b>
                                </span>
                                <p class="duration" style="margin-bottom: 1rem;">
                                For 1 Week
                                </p>
                            </div>
                                <!-- Success and error messages -->
                                <div class="message-container">
                                    <div
                                        v-if="successMessage"
                                        class="alert alert-success"
                                    >
                                        {{ successMessage }}
                                    </div>
                                    <div
                                        v-if="errorMessage"
                                        class="alert alert-danger"
                                    >
                                        {{ errorMessage }}
                                    </div>
                                </div>
                                <!--The end of success message-->
                                <div v-if="authenticated">
                                    <input
                                        type="number"
                                        v-model="investmentAmount[plan.id]"
                                        placeholder="Enter amount"
                                        class="form-control mb-3"
                                        :style="{ margin: 'auto' }"
                                    />
                                    <button
                                        @click="submitInvestment(plan.id)"
                                        class="btn card-button w-100"
                                    >
                                        Invest Now
                                    </button>
                                </div>
                                <div v-else>
                                    <button
                                        @click="$router.push('/login')"
                                        class="btn card-button w-100"
                                    >
                                        Invest Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cards -->
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-container bg-dark">
            <Bootstrap4Pagination
                :data="paginationOptions"
                @pagination-change-page="getPlans"
            />
        </div>
    </section>
    <!-- investment section end -->

    <!-- calculator bottom begin -->
    <section class="calculate-aria-second">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="calculate-left">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="icon-box">
                                    <i class="ren-calculator"></i>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <div class="form-group">
                                    <h2 class="amount">
                                        Enter Investment Amount
                                    </h2>
                                    <div class="input-dropdown">
                                        <input
                                            type="text"
                                            name="text"
                                            placeholder="$200"
                                            class="main-form calculator-area-invest"
                                        />
                                        <div class="form-dropdown">
                                            <select
                                                class="form-btn-dropdown calculator-area-profit"
                                            >
                                                <option value="1">
                                                    1% Daily For Ever
                                                </option>
                                                <option value="2">
                                                    2% Daily For Ever
                                                </option>
                                                <option value="3">
                                                    3% Daily For Ever
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-10 text-center">
                    <div class="calculate-right">
                        <div class="row justify-content-end">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="text-box">
                                    <span
                                        class="counter calculator-result-area-daily"
                                        :style="{ color: '#ffce28 !important' }"
                                        >212</span
                                    >
                                    <h4>Daily Profit</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="text-box">
                                    <span
                                        class="counter calculator-result-area-weekly"
                                        :style="{ color: '#ffce28 !important' }"
                                        >1484</span
                                    >
                                    <h4>Weekly Profit</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="text-box">
                                    <span
                                        class="counter calculator-result-area-monthly"
                                        :style="{ color: '#ffce28 !important' }"
                                        >6360</span
                                    >
                                    <h4>Monthly Profit</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- calculator bottom end -->

    <!-- affiliate section begin -->
    <section
        class="affiliate-section"
        id="affiliate-section"
        :style="{ backgroundImage: 'url(assets/img/affiliate-bg.jpg.jfif)' }"
    >
        <div class="overlay" :style="{ backgroundColor: '#ffffff' }">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="affiliate-text">
                            <h5 class="affiliate-title">What You’ll Get As</h5>
                            <h2 class="affiliate-subtitle">
                                An Affiliate Partner
                            </h2>
                            <p class="affiliate-title-describe">
                                We give you the opportunity to earn money by
                                recommending our website to others. You can
                                start earning money even if you do not invest.
                                Promote our website wherever you are. Create
                                posts on online forums and social networks.
                                Remember to use the referral link. Build your
                                structure and receive a commission from three
                                levels whenever someone makes a deposit.
                                Earnings from the affiliate program are
                                immediately available in the account balance.
                                You can invest or withdraw funds at any time.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="part-cart">
                            <a href="#">I want to Join</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- affiliate section end -->

    <!-- referral section begin -->
    <section class="referral-section">
        <div class="container">
            <div class="row referral-section-item">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="referral-img">
                        <img :src="'assets/img/referral-img.png '" alt="#" />
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="referral-section-right">
                        <div class="referral-text">
                            <h5
                                class="referral-title"
                                :style="{ color: 'rgb(85, 43, 170)' }"
                            >
                                Referral commission and
                            </h5>
                            <h2 class="referral-subtitle">Membership Level</h2>
                            <p class="referral-title-describe">
                                Refferal Commmission and Membership Levels are
                                of 3 levels as below
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="referral-single-item">
                                            <div class="icon-box">
                                                <i class="ren-people1"></i>
                                            </div>
                                            <div class="text-box">
                                                <span
                                                    class="percentage"
                                                    :style="{
                                                        color: 'rgb(85, 43, 170)',
                                                    }"
                                                    >8%</span
                                                >
                                                <h4 class="item-text">
                                                    Direct Referral
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="referral-single-item">
                                            <div class="icon-box">
                                                <i
                                                    class="ren-people2 bg-second"
                                                ></i>
                                            </div>
                                            <div class="text-box">
                                                <span
                                                    class="percentage"
                                                    :style="{
                                                        color: 'rgb(85, 43, 170)',
                                                    }"
                                                    >4%</span
                                                >
                                                <h4 class="item-text">
                                                    Second Line
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="referral-single-item">
                                            <div class="icon-box">
                                                <i
                                                    class="ren-people3 bg-third"
                                                ></i>
                                            </div>
                                            <div class="text-box">
                                                <span
                                                    class="percentage"
                                                    :style="{
                                                        color: 'rgb(85, 43, 170)',
                                                    }"
                                                    >2%</span
                                                >
                                                <h4 class="item-text">
                                                    Third Line
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- referral section end -->

    <!-- deposit section begin -->
    <section class="deposit-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="deposit-text">
                        <h5 class="deposit-title">Convenient Money</h5>
                        <h2 class="deposit-subtitle">Deposit & Withdrawal</h2>
                        <p class="deposit-title-describe">
                            Depositing or withdrawing money is simple.We support
                            several payment methods, which depend on what
                            country your payment account is located in.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-12 reunir-content-center">
                    <div class="row d-flex justify-content-start">
                        <div class="col-lg-8">
                            <div class="payment-methods-outer">
                                <div class="payment-methods">
                                    <div class="icon-gallery">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/card-icon.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">
                                                Credit Card
                                            </h5>
                                        </div>
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/paypal.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">Paypal</h5>
                                        </div>
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/bitcoin.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">Bitcoin</h5>
                                        </div>
                                    </div>
                                    <div class="icon-gallery">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/litecoin.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">Litecoin</h5>
                                        </div>
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/ethereum.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">Ethereum</h5>
                                        </div>
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <img
                                                    :src="'assets/img/ripple.png '"
                                                    alt="#"
                                                />
                                            </div>
                                            <h5 class="icon-title">Ripple</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-12 mt-4">
                    <div class="deposit-section-right">
                        <div class="icon-box-outer">
                            <div class="icon-box">
                                <i class="ren-withdraw2"></i>
                            </div>
                        </div>
                        <div class="icon-text">
                            <h2 class="icon-title">No Limit</h2>
                            <p class="icon-title-describe">
                                Unlimited maximum withdrawal amount
                            </p>
                        </div>
                    </div>
                    <div class="deposit-section-right">
                        <div class="icon-box-outer">
                            <div class="icon-box icon-box-orange">
                                <i class="ren-deposit5"></i>
                            </div>
                        </div>
                        <div class="icon-text">
                            <h2 class="icon-title">Withdrawal in 24 /7</h2>
                            <p class="icon-title-describe">
                                Deposit – instantaneous
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- deposit section end -->

    <!-- transaction section begin -->
    <section class="transaction-section">
        <div class="right-img">
            <img
                class="right-ellipse1"
                :src="'assets/img/transaction-bg-ellipse-01.png'"
                alt="#"
            />
            <img
                class="right-shape1"
                :src="'assets/img/transaction-bg-shape-01.png'"
                alt="#"
            />
            <img
                class="right-shape2"
                :src="'assets/img/transaction-bg-shape-01.png'"
                alt="#"
            />
            <img
                class="right-ellipse2"
                :src="'assets/img/transaction-bg-ellipse-02.png'"
                alt="#"
            />
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="transaction-text text-center">
                        <h5 class="transaction-title">User Statistics</h5>
                        <h2 class="transaction-subtitle">Latest Transaction</h2>
                        <p class="transaction-title-describe">
                            Our goal is to simplify investing so that anyone can
                            be an investor.Withthis in mind, we hand-pick the
                            investments we offer on our platform.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 col-md-11">
                    <ul
                        class="nav nav-pills mb-3 justify-content-center transaction-bnt-outline"
                        id="transaction-pills-tab"
                        role="tablist"
                    >
                        <li class="nav-item transaction-nav-item">
                            <a
                                class="nav-link transaction-nav-link active"
                                id="transaction-pills-deposits-tab"
                                data-toggle="pill"
                                href="#pills-deposits"
                                role="tab"
                                aria-controls="pills-deposits"
                                aria-selected="true"
                            >
                                <span class="d-flex align-items-center"
                                    ><i
                                        class="ren-deposits d-flex align-items-center"
                                    ></i
                                    >LATEST<br />DEPOSITS</span
                                >
                            </a>
                        </li>
                        <li class="nav-item transaction-nav-item">
                            <a
                                class="nav-link transaction-nav-link"
                                id="transaction-pills-withdrawal-tab"
                                data-toggle="pill"
                                href="#pills-withdrawals"
                                role="tab"
                                aria-controls="pills-withdrawal"
                                aria-selected="false"
                            >
                                <span class="d-flex align-items-center"
                                    ><i
                                        class="ren-investo d-flex align-items-center"
                                    ></i
                                    >TOP<br />WITHDRAWALS</span
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="tab-content transaction-tab-content"
                        id="transaction-pills-tabContent"
                    >
                        <div
                            class="tab-pane fade show active transaction-tab-pane"
                            id="pills-deposits"
                            role="tabpanel"
                            aria-labelledby="transaction-pills-deposits-tab"
                        >
                            <table
                                class="table table-responsive transaction-table"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Deposit Method</th>
                                        <th scope="col">Amount Deposited</th>
                                        <th scope="col">Currency</th>

                                        <!--<th scope="col">Time</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="deposits.length === 0">
                                        <td colspan="5" class="text-center">
                                            <div
                                                class="alert alert-danger mt-4"
                                            >
                                                No Active Deposit yet
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        v-else
                                        v-for="(deposit, index) in deposits"
                                        :key="deposit.id"
                                    >
                                        <td>
                                            {{ deposit.transaction_number }}
                                        </td>
                                        <td>
                                            {{ deposit.wallet.coin }} -
                                            {{ deposit.wallet.network }}
                                        </td>
                                        <td>{{ deposit.amount }}</td>
                                        <td>USD</td>
                                        <!--
                                        <td>
                                            {{
                                                formatTimeAgo(
                                                    deposit.created_at
                                                )
                                            }}
                                        </td>
                                        -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="tab-pane fade transaction-tab-pane"
                            id="pills-withdrawals"
                            role="tabpanel"
                            aria-labelledby="transaction-pills-withdrawal-tab"
                        >
                            <table
                                class="table table-responsive transaction-table"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Withdrawal Method</th>
                                        <th scope="col">Amount Withdrawn</th>
                                        <th scope="col">Currency</th>

                                       <!-- <th scope="col">Time</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="withdrawals.length === 0">
                                        <td colspan="5" class="text-center">
                                            <div
                                                class="alert alert-danger mt-4"
                                            >
                                                No Active Withdrawals. Check
                                                Again
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        v-else
                                        v-for="(
                                            withdrawal, index
                                        ) in withdrawals"
                                        :key="withdrawal.id"
                                    >
                                        <td>
                                            {{ withdrawal.transaction_number }}
                                        </td>
                                        <td>{{ withdrawal.method }}</td>
                                        <td>{{ withdrawal.amount }}</td>
                                        <td>USD</td>
                                        <!--
                                        <td>
                                            {{
                                                formatTimeAgo(
                                                    withdrawal.created_at
                                                )
                                            }}
                                        </td>
                                        -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- transaction section end -->

    <!-- Testimonial Section Begin -->
    <section
        class="testimonial-section"
        style="background-color: rgb(85, 43, 170); padding: 50px 0"
    >
        <div class="container">
            <!-- Header Section -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="testimonial-text">
                        <h5 class="testimonial-title text-white mb-3">
                            Happy Clients
                        </h5>
                        <h2 class="testimonial-subtitle text-white mb-4">
                            Testimonial of Clients
                        </h2>
                        <p class="testimonial-title-describe text-white">
                            We have many happy investors invest with us. Some
                            impressions from our Customers! Please read some of
                            the lovely things our Customers say about us.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Carousel Section -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div
                        id="testimonialCarousel"
                        class="carousel slide"
                        data-bs-ride="carousel"
                    >
                        <div class="carousel-inner">
                            <!-- Testimonial 1 -->
                            <div class="carousel-item active">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business3.jpg'"
                                                alt="Michael Turner"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “This service has completely
                                            transformed my approach to
                                            investing. I finally feel confident
                                            and secure with my financial
                                            future.”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            Michael Turner
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            New York, USA, 12th March, 2020
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="carousel-item">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business2.jpg'"
                                                alt="Sophia Lee"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “The advice I received was
                                            professional, and I felt genuinely
                                            cared for. It's amazing to work with
                                            a team who values my goals.”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            Sophia Lee
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            Toronto, Canada, 5th July, 2021
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="carousel-item">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business4.jpg'"
                                                alt="John Davis"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “Their expertise took the stress out
                                            of financial planning. I couldn't be
                                            happier with the results!”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            John Davis
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            Sydney, Australia, 15th August, 2019
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 4 -->
                            <div class="carousel-item">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business1.jpg'"
                                                alt="Emily Zhang"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “I’ve never felt more informed and
                                            secure with my finances. They really
                                            go above and beyond for their
                                            clients!”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            Emily Zhang
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            London, UK, 9th November, 2018
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 5 -->
                            <div class="carousel-item">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business5.jfif'"
                                                alt="David O'Connor"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “I was hesitant at first, but their
                                            expertise and support won me over.
                                            Highly recommend to anyone seeking
                                            financial stability.”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            David O'Connor
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            Dublin, Ireland, 30th January, 2022
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 6 -->
                            <div class="carousel-item">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <div class="carousel-img mb-3">
                                            <img
                                                :src="'assets/img/business1.jpg'"
                                                alt="Isabella Martinez"
                                                class="rounded-circle"
                                                style="
                                                    width: 100px;
                                                    height: 100px;
                                                "
                                            />
                                        </div>
                                        <p class="client-describe mb-4">
                                            “Working with this team has made all
                                            the difference. I feel empowered and
                                            equipped to achieve my financial
                                            goals.”
                                        </p>
                                        <h2 class="client-name mb-1">
                                            Isabella Martinez
                                        </h2>
                                        <h4 class="client-date text-muted">
                                            Madrid, Spain, 20th June, 2023
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <button
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev"
                        >
                            <span
                                class="carousel-control-prev-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#testimonialCarousel"
                            data-bs-slide="next"
                        >
                            <span
                                class="carousel-control-next-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- questions section begin -->
    <div class="questions-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="questions-text">
                        <h5 class="questions-title">Got Any Questions</h5>
                        <h2 class="questions-subtitle">We've Got Answers</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <ul
                        class="nav nav-pills mb-3 justify-content-center questions-nav-pills"
                        id="questions-pills-tab"
                        role="tablist"
                    >
                        <li class="nav-item questions-nav-item">
                            <a
                                class="nav-link questions-nav-link active"
                                id="questions-pills-basic-tab"
                                data-toggle="pill"
                                href="#pills-basic"
                                role="tab"
                                aria-controls="questions-pills-basic-tab"
                                aria-selected="true"
                                >Basic Question</a
                            >
                        </li>
                        <li class="nav-item questions-nav-item">
                            <a
                                class="nav-link questions-nav-link"
                                id="questions-pills-investing-tab"
                                data-toggle="pill"
                                href="#pills-investing"
                                role="tab"
                                aria-controls="questions-pills-investing-tab"
                                aria-selected="false"
                                >Investing Question</a
                            >
                        </li>
                        <li class="nav-item questions-nav-item">
                            <a
                                class="nav-link questions-nav-link"
                                id="questions-pills-withdrawal-tab"
                                data-toggle="pill"
                                href="#pills-withdrawal"
                                role="tab"
                                aria-controls="questions-pills-withdrawal-tab"
                                aria-selected="false"
                                >Withdrawal Question</a
                            >
                        </li>
                        <li class="nav-item questions-nav-item">
                            <a
                                class="nav-link questions-nav-link"
                                id="questions-pills-referral-tab"
                                data-toggle="pill"
                                href="#pills-referral"
                                role="tab"
                                aria-controls="questions-pills-referral-tab"
                                aria-selected="false"
                                >Referral Program</a
                            >
                        </li>
                    </ul>
                    <div
                        class="tab-content questions-tab-content"
                        id="pills-tabContent"
                    >
                        <div
                            class="tab-pane fade show active questions-tab-pane"
                            id="pills-basic"
                            role="tabpanel"
                            aria-labelledby="questions-pills-basic-tab"
                        >
                            <div
                                class="questions-accordion"
                                id="withdrawal-accordion"
                            >
                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="withdrawal-headingOne"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#withdrawal-collapseOne"
                                                aria-expanded="true"
                                                aria-controls="questions-pills-basic-tab"
                                            >
                                                What Are The Main Advantages Of
                                                Equitify Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="withdrawal-collapseOne"
                                        class="collapse show questions-show"
                                        aria-labelledby="withdrawal-headingOne"
                                        data-parent="#withdrawal-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades offers secure
                                            investment solutions, including
                                            encrypted data protection and fully
                                            secure online transactions. Our
                                            clients enjoy reliable and safe
                                            investment management backed by
                                            advanced security measures.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="withdrawal-headingTwo"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#withdrawal-collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="questions-pills-investing-tab"
                                            >
                                                Is It Free Of Charge To Open An
                                                Account?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="withdrawal-collapseTwo"
                                        class="collapse questions-show"
                                        aria-labelledby="withdrawal-headingTwo"
                                        data-parent="#withdrawal-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Yes, opening an account with
                                            Equitify Trades is completely free.
                                            There are no account setup fees,
                                            allowing you to focus on growing
                                            your investments without initial
                                            charges.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="withdrawal-headingThree"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#withdrawal-collapseThree"
                                                aria-expanded="false"
                                                aria-controls="questions-pills-withdrawal-tab"
                                            >
                                                How Secure Are User Accounts And
                                                Personal Data?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="withdrawal-collapseThree"
                                        class="collapse questions-show"
                                        aria-labelledby="withdrawal-headingThree"
                                        data-parent="#withdrawal-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades uses advanced
                                            encryption to secure personal data
                                            and account information.
                                            Transactions and data are managed on
                                            protected servers to ensure a safe
                                            and secure investment experience.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="withdrawal-headingFour"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#withdrawal-collapseFour"
                                                aria-expanded="false"
                                                aria-controls="questions-pills-referral-tab"
                                            >
                                                How Many Accounts Can I Open On
                                                The Site?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="withdrawal-collapseFour"
                                        class="collapse questions-show"
                                        aria-labelledby="withdrawal-headingFour"
                                        data-parent="#withdrawal-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades allows each user to
                                            open one account to help maintain
                                            secure records and protect account
                                            integrity.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade questions-tab-pane"
                            id="pills-investing"
                            role="tabpanel"
                            aria-labelledby="questions-pills-investing-tab"
                        >
                            <div
                                class="questions-accordion"
                                id="investing-accordion"
                            >
                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="investing-headingOne"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#investing-collapseOne"
                                                aria-expanded="true"
                                                aria-controls="investing-collapseOne"
                                            >
                                                What is the minimum investment
                                                amount required to start with
                                                Equitify Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="investing-collapseOne"
                                        class="collapse show questions-show"
                                        aria-labelledby="investing-headingOne"
                                        data-parent="#investing-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades allows investors to
                                            get started with a minimum
                                            investment amount that is affordable
                                            for all types of investors. This
                                            threshold ensures accessibility
                                            while maintaining security and
                                            quality in investment handling. For
                                            specific investment options and
                                            their minimum requirements, it’s
                                            best to consult the Equitify Trades
                                            website or speak directly with a
                                            representative.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="investing-headingTwo"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#investing-collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="investing-collapseTwo"
                                            >
                                                How secure is my investment with
                                                Equitify Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="investing-collapseTwo"
                                        class="collapse questions-show"
                                        aria-labelledby="investing-headingTwo"
                                        data-parent="#investing-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades employs
                                            industry-standard encryption and
                                            security protocols to protect user
                                            accounts and investments. All
                                            transactions and data are secured
                                            over encrypted internet connections,
                                            ensuring client peace of mind and
                                            data privacy.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="investing-headingThree"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#investing-collapseThree"
                                                aria-expanded="false"
                                                aria-controls="investing-collapseThree"
                                            >
                                                Are there any fees to open or
                                                maintain an account with
                                                Equitify Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="investing-collapseThree"
                                        class="collapse questions-show"
                                        aria-labelledby="investing-headingThree"
                                        data-parent="#investing-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Opening an account with Equitify
                                            Trades is free of charge. However,
                                            certain account types or advanced
                                            trading options may incur minimal
                                            fees, which will be disclosed
                                            transparently before any charges are
                                            applied.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="investing-headingFour"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#investing-collapseFour"
                                                aria-expanded="false"
                                                aria-controls="investing-collapseFour"
                                            >
                                                Can I withdraw my investment at
                                                any time?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="investing-collapseFour"
                                        class="collapse questions-show"
                                        aria-labelledby="investing-headingFour"
                                        data-parent="#investing-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Yes, Equitify Trades allows clients
                                            to withdraw their investments at any
                                            time, though some investments may
                                            have specific terms or conditions
                                            for withdrawal. We advise clients to
                                            review their investment agreements
                                            or consult with our support team for
                                            further clarification.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade questions-tab-pane"
                            id="pills-withdrawal"
                            role="tabpanel"
                            aria-labelledby="questions-pills-withdrawal-tab"
                        >
                            <div
                                class="questions-accordion"
                                id="basic-accordion"
                            >
                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="basic-headingOne"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#basic-collapseOne"
                                                aria-expanded="true"
                                                aria-controls="basic-collapseOne"
                                            >
                                                How long does it take to process
                                                a withdrawal with Equitify
                                                Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="basic-collapseOne"
                                        class="collapse show questions-show"
                                        aria-labelledby="basic-headingOne"
                                        data-parent="#basic-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Withdrawal processing times vary
                                            depending on the selected withdrawal
                                            method. Typically, it takes 1–3
                                            business days for bank transfers,
                                            while digital wallets may reflect
                                            funds sooner.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="basic-headingTwo"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#basic-collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="basic-collapseTwo"
                                            >
                                                Are there any fees for making a
                                                withdrawal?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="basic-collapseTwo"
                                        class="collapse questions-show"
                                        aria-labelledby="basic-headingTwo"
                                        data-parent="#basic-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades does not charge any
                                            internal fees for withdrawals.
                                            However, third-party fees may apply
                                            depending on the payment provider or
                                            bank involved in the transaction.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="basic-headingThree"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#basic-collapseThree"
                                                aria-expanded="false"
                                                aria-controls="basic-collapseThree"
                                            >
                                                Can I cancel a withdrawal
                                                request after submission?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="basic-collapseThree"
                                        class="collapse questions-show"
                                        aria-labelledby="basic-headingThree"
                                        data-parent="#basic-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Yes, you can cancel a withdrawal
                                            request if it has not yet been
                                            processed. Simply contact Equitify
                                            Trades' support team to assist with
                                            the cancellation.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="basic-headingFour"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#basic-collapseFour"
                                                aria-expanded="false"
                                                aria-controls="basic-collapseFour"
                                            >
                                                What are the available
                                                withdrawal methods?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="basic-collapseFour"
                                        class="collapse questions-show"
                                        aria-labelledby="basic-headingFour"
                                        data-parent="#basic-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Equitify Trades supports multiple
                                            withdrawal methods, including bank
                                            transfers, digital wallets, and
                                            cryptocurrency transfers. Check the
                                            platform for a full list of
                                            available options and any associated
                                            processing times.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade questions-tab-pane"
                            id="pills-referral"
                            role="tabpanel"
                            aria-labelledby="questions-pills-referral-tab"
                        >
                            <div
                                class="questions-accordion"
                                id="referral-accordion"
                            >
                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="referral-headingOne"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#referral-collapseOne"
                                                aria-expanded="true"
                                                aria-controls="referral-collapseOne"
                                            >
                                                What benefits do I receive for
                                                referring friends to Equitify
                                                Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="referral-collapseOne"
                                        class="collapse show questions-show"
                                        aria-labelledby="referral-headingOne"
                                        data-parent="#referral-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            By referring friends, you can earn a
                                            percentage of their initial deposit
                                            as a referral bonus. Additionally,
                                            each successful referral enhances
                                            your status within our loyalty
                                            program.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="referral-headingTwo"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#referral-collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="referral-collapseTwo"
                                            >
                                                How can I refer a friend to
                                                Equitify Trades?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="referral-collapseTwo"
                                        class="collapse questions-show"
                                        aria-labelledby="referral-headingTwo"
                                        data-parent="#referral-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            You can refer friends by sharing
                                            your unique referral link, available
                                            on your account dashboard. When they
                                            sign up using this link, their
                                            account will be linked to your
                                            referral.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="referral-headingThree"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#referral-collapseThree"
                                                aria-expanded="false"
                                                aria-controls="referral-collapseThree"
                                            >
                                                When will I receive my referral
                                                bonus?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="referral-collapseThree"
                                        class="collapse questions-show"
                                        aria-labelledby="referral-headingThree"
                                        data-parent="#referral-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            Referral bonuses are credited to
                                            your account once the referred
                                            friend completes their initial
                                            deposit. You can view your referral
                                            bonus status on your dashboard.
                                        </div>
                                    </div>
                                </div>

                                <div class="card questions-card">
                                    <div
                                        class="card-header questions-card-header"
                                        id="referral-headingFour"
                                    >
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link collapsed questions-btn-link"
                                                data-toggle="collapse"
                                                data-target="#referral-collapseFour"
                                                aria-expanded="false"
                                                aria-controls="referral-collapseFour"
                                            >
                                                Is there a limit on how many
                                                people I can refer?
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        id="referral-collapseFour"
                                        class="collapse questions-show"
                                        aria-labelledby="referral-headingFour"
                                        data-parent="#referral-accordion"
                                    >
                                        <div
                                            class="card-body questions-card-body"
                                        >
                                            No, there is no limit to the number
                                            of friends you can refer to Equitify
                                            Trades. The more friends you refer,
                                            the more bonuses and benefits you
                                            can accumulate.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- questions section end -->
    <TradingViewWidget />
    <Footer />
</template>

<script>
import Navbar from "@/components/layouts/navbar.vue";
import Footer from "@/components/layouts/footer.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
import TradingViewWidget from "@/components/TradingViewWidget.vue";
import axios from "axios";

export default {
    name: "Plans",
    components: {
        Navbar,
        Footer,
        TradingViewWidget,
    },
    data() {
        return {
            plans: [],
            authenticated: false,
            errorMessage: "",
            successMessage: "",
            investmentAmount: {},
            activeTab: "deposits",
            deposits: [],
            withdrawals: [],
            paginationOptions: {
                wrapperClass: "pagination float-right",
                current: 1,
                total: 0,
                perPage: 8,
                visiblePages: 8,
                lastPage: 1,
                authenticated: false,
                userData: null,
                isLogout: false, // Flag to track if logout was initiated
            },
        };
    },
    created() {
        this.fetchTransactions();
    },
    mounted() {
        document.title = "Equitify Trades | Invest, Build and Grow.";
        this.getPlans();
        this.checkAuthentication();
    },
    methods: {
        async checkAuthentication() {
            try {
                // Verify authentication status from the backend
                const response = await axios.get("/api/verify");
                const isAuthenticated = response.data.authenticated;

                if (isAuthenticated) {
                    // User is not authenticated; trigger logout method
                    await this.logout();
                }
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    // If the server responds with 401, trigger logout
                } else {
                    console.error("Error checking authentication:", error);
                }
            }
        },

        async logout() {
            try {
                // Call the Laravel logout endpoint to ensure the session is destroyed
                await axios.post("/api/logout");

                // Clear local authentication state
                this.clearAuthState();

                // Redirect to the login page
                this.$router.push("/login");
            } catch (error) {
                console.error("Logout error:", error.response?.data || error);
            }
        },

        clearAuthState() {
            // Clear localStorage, sessionStorage, and cookies
            localStorage.clear();
            sessionStorage.clear();
            document.cookie.split(";").forEach((c) => {
                document.cookie =
                    c.trim().split("=")[0] +
                    "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            });
        },

        async getPlans(page = 1) {
            try {
                const response = await axios.get(`/api/plans?page=${page}`);
                this.plans = response.data.data; // Get the plans
                this.paginationOptions.current = response.data.current_page;
                this.paginationOptions.total = response.data.total;
                this.paginationOptions.perPage = response.data.per_page;
                this.paginationOptions.lastPage = response.data.last_page;
            } catch (error) {
                console.error("Error fetching plans:", error);
                this.plans = [];
            }
        },
        async submitInvestment(planId) {
            if (!this.authenticated) {
                this.$router.push("/login");
                return;
            }

            const amount = this.investmentAmount[planId];
            if (!amount || amount <= 0) {
                this.errorMessage = "Please enter a valid amount.";
                return;
            }

            try {
                const response = await axios.post("/api/invest", {
                    plan_id: planId,
                    amount,
                });
                this.successMessage = "Investment successfully made!";
                this.errorMessage = ""; // Clear any previous error message
            } catch (error) {
                // If the investment fails, show the error message returned from the backend
                this.successMessage = ""; // Clear any previous success message
                if (
                    error.response &&
                    error.response.data &&
                    error.response.data.error
                ) {
                    this.errorMessage = error.response.data.error;
                } else {
                    this.errorMessage = "Investment failed. Please try again.";
                }
            }
        },
        fetchTransactions() {
            axios.get("/api/transactions/latest").then((response) => {
                this.deposits = response.data.deposits;
                this.withdrawals = response.data.withdrawals;
            });
        },

        //Format time
        formatTimeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const secondsAgo = Math.floor((now - date) / 1000);

            if (secondsAgo < 60)
                return `${secondsAgo} second${secondsAgo === 1 ? "" : "s"} ago`;

            const minutesAgo = Math.floor(secondsAgo / 60);
            if (minutesAgo < 60)
                return `${minutesAgo} minute${minutesAgo === 1 ? "" : "s"} ago`;

            const hoursAgo = Math.floor(minutesAgo / 60);
            if (hoursAgo < 24)
                return `${hoursAgo} hour${hoursAgo === 1 ? "" : "s"} ago`;

            const daysAgo = Math.floor(hoursAgo / 24);
            if (daysAgo < 7)
                return `${daysAgo} day${daysAgo === 1 ? "" : "s"} ago`;

            const weeksAgo = Math.floor(daysAgo / 7);
            if (weeksAgo < 4)
                return `${weeksAgo} week${weeksAgo === 1 ? "" : "s"} ago`;

            const monthsAgo = Math.floor(daysAgo / 30);
            if (monthsAgo < 12)
                return `${monthsAgo} month${monthsAgo === 1 ? "" : "s"} ago`;

            const yearsAgo = Math.floor(daysAgo / 365);
            return `${yearsAgo} year${yearsAgo === 1 ? "" : "s"} ago`;
        },
    },
};
</script>

<style scoped>
.banner-section {
    position: relative;
    overflow: hidden;
}

.background-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
}

.overlay {
    position: relative;
    z-index: 1;
    background: rgba(0, 0, 0, 0.5);
}
.client-describe {
    margin-top: 5% !important;
}

/* Investment card section */
.card {
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
}

.card-body {
    text-align: center;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
}

.card-text {
    font-size: 1rem;
    margin-bottom: 1rem;
}

.min-max-info p {
    font-size: 0.9rem;
}

.investment-section button {
    margin-top: 10px;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.investment-section {
    background-size: cover;
    background-position: center center;
    padding: 50px 0;
}

.investment-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
}

.investment-subtitle {
    font-size: 2rem;
    color: #fff;
}

.investment-title-describe {
    color: #fff;
    margin-top: 10px;
}

.card-button {
    background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
    color: #fff;
    border: none;
}

.card-button:hover {
    background-color: #d41c3a;
}
</style>
