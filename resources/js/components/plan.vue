<template>
    <Navbar />
    <div class="mt-5">
      <section class="investment-section" id="investment-section" :style="{ backgroundImage: 'url(assets/img/investment-bg.jpg.jfif)' }">
        <div class="overlay" :style="{ backgroundColor: '#ffffff' }">
          <div class="container text-center">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-8 text-center">
                <div class="investment-text">
                  <h5 class="investment-title">INVESTMENT OFFER</h5>
                  <h2 class="investment-subtitle">Our Investment Plans</h2>
                  <p class="investment-title-describe">
                    Equitify Trades provides a straightforward and transparent mechanism to attract investments and make more profits.
                  </p>
                </div>
              </div>
            </div>
  
            <!-- Cards to display plans -->
            <div class="row mb-4">
              <div class="col-lg-4 mb-4" v-for="plan in plans" :key="plan.id">
                <div class="card shadow-lg">
                  <img :src="'assets/img/coin.jpg'" class="card-img-top" alt="Investment Plan" />
                  <div class="card-body">
                    <h3 class="plan-name text-center">{{ plan.name }}</h3>
                    <p class="card-text text-center">
                      <span class="badge bg-success p-3 mb-3"><b>{{ plan.interest }}%</b></span>
                      <br />
                      <span>Daily For {{ plan.duration }} Month(s)</span>
                    </p>
                    <div class="min-max-info">
                      <p class="text-muted">
                        Min. : <b>${{ plan.min_amount }}</b> | Max. : <b>${{ plan.max_amount }}</b>
                      </p>
                    </div>
                      <!-- Success and error messages -->
                        <div class="message-container">
                            <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                            <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                        </div>
                        <!--The end of success message-->
                    <div v-if="authenticated">
                      <input type="number" v-model="investmentAmount[plan.id]" placeholder="Enter amount" class="form-control mb-3" :style="{ margin: 'auto' }" />
                      <button @click="submitInvestment(plan.id)" class="btn card-button w-100">Invest Now</button>
                    </div>
                    <div v-else>
                      <button @click="$router.push('/login')" class="btn card-button w-100">Invest Now</button>
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
    </div>
    
    <Footer />
  </template>
  
  <script>
  import Navbar from '@/components/layouts/navbar.vue';
  import Footer from '@/components/layouts/footer.vue';
  import { Bootstrap4Pagination } from 'laravel-vue-pagination';
  import axios from 'axios';
  
  export default {
    name: 'plans',
    components: {
      Navbar,
      Footer,
      Bootstrap4Pagination,
    },
    data() {
      return {
        plans: [],
        authenticated: false,
        errorMessage: '',
        successMessage: '',
        userData: {},
        investmentAmount: {},
        paginationOptions: {
          wrapperClass: 'pagination float-right',
          current: 1,
          total: 0,
          perPage: 8,
          visiblePages: 8,
          lastPage: 1,
        },
      };
    },
    created() {
      this.checkAuthentication();
    },
    mounted() {
      document.title = "Plans | Choose Your Plan & Grow Wealthy.";
      this.getPlans();
    },
    methods: {
      async checkAuthentication() {
        try {
          const response = await axios.get('/api/verify');
          this.authenticated = response.data.authenticated;
          if (this.authenticated) {
            this.userData = response.data.user;
          }
        } catch (error) {
          console.error("Error checking authentication", error);
        }
      },
      async getPlans(page = 1) {
        try {
          const response = await axios.get(`/api/plans?page=${page}`);
          this.plans = response.data.data;  // Get the plans
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
      this.$router.push('/login');
      return;
    }

    const amount = this.investmentAmount[planId];
    if (!amount || amount <= 0) {
      this.errorMessage = "Please enter a valid amount.";
      return;
    }

    try {
      const response = await axios.post('/api/invest', { plan_id: planId, amount });
      this.successMessage = "Investment successfully made!";
      this.errorMessage = '';  // Clear any previous error message
    } catch (error) {
      // If the investment fails, show the error message returned from the backend
      this.successMessage = '';  // Clear any previous success message
      if (error.response && error.response.data && error.response.data.error) {
        this.errorMessage = error.response.data.error;
      } else {
        this.errorMessage = "Investment failed. Please try again.";
      }
    }
  },
},
  };
  </script>
  
  
  
  <style scoped>
  .page-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
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
  
  button {
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
  
  .overlay {
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
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
    background:linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
    color: #fff;
    border: none;
  }
  
  .card-button:hover {
    background-color: #d41c3a;
  }

  </style>
  