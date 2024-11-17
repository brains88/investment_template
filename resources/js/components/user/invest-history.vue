<template>
    <div class="d-flex">
      <div class="main-content w-100">
        <Usernavbar />
        <div class="container mt-5 content-wrapper">
          <h3 class="mb-4 text-center text-uppercase">Investment History</h3>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead>
                <tr>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col">SL</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col">Plan</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col">Return Interest</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col">Received Amount</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col">Upcoming Payment</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(investment, index) in investments" :key="investment.id">
                  <th scope="row">{{ index + 1 }}</th>
                  <td>{{ investment.plan }}</td>
                  <td>
                    {{ investment.investmentAmount }} USD
                    <br />
                    {{ investment.returnInterest }}% per {{ investment.frequency }}
                  </td>
                  <td>
                    {{ investment.receivedTimes }} x {{ investment.receivedAmount.toFixed(2) }} = {{ (investment.receivedTimes * investment.receivedAmount).toFixed(2) }} USD
                  </td>
                  <td>
                    <div class="d-flex flex-column align-items-start">
                      <span class="mb-1">{{ investment.upcomingPayment }}</span>
                      <div class="progress w-100">
                        <div
                          class="progress-bar"
                          role="progressbar"
                          :style="{ width: investment.progress + '%' }"
                          :class="{
                            'bg-success': investment.progress === 100,
                            'bg-info': investment.progress < 100
                          }"
                          :aria-valuenow="investment.progress"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        >
                          {{ investment.progress }}%
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Usernavbar from "@/components/layouts/usernavbar.vue";
  
  export default {
    name: "InvestHistory",
    components: {
      Usernavbar,
    },
    data() {
      return {
        investments: [
          {
            id: 1,
            plan: "Cryptocurrency Plan",
            investmentAmount: 7500,
            returnInterest: 1,
            frequency: "Day",
            receivedTimes: 1,
            receivedAmount: 75,
            upcomingPayment: "0d: 0h 48m 20s",
            progress: 96.27,
          },
          {
            id: 2,
            plan: "Stock Investment",
            investmentAmount: 10000,
            returnInterest: 1.5,
            frequency: "Week",
            receivedTimes: 4,
            receivedAmount: 150,
            upcomingPayment: "2d: 5h 30m",
            progress: 85.75,
          },
          // More investment records can go here
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
  }
  
  .progress {
    height: 1rem;
  }
  
  .progress-bar {
    transition: width 0.5s ease;
    background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
  }
  
  .main-content {
    padding-left: 240px; /* Adjust this value based on navbar width */
  }
  
  .content-wrapper {
    padding: 20px; /* Extra padding around content */
    padding-top: 80px; /* Extra top padding to clear the navbar */
  }
  
  @media (max-width: 768px) {
    .main-content {
      padding-left: 0;
    }
    .table {
      font-size: 0.9rem;
    }
    .progress {
      width: 100% !important;
    }
    th,
    td {
      white-space: nowrap;
    }
  }
  </style>
  