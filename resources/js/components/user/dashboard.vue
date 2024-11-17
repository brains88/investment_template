<template>
  <div class="dashboard-wrapper">
    <!-- Import Navbar -->
    <Usernavbar />

    <!-- Dashboard Content -->
    <div class="dashboard container my-5 mt-5">
      <h2 class="dashboard-title mt-5">User Dashboard</h2>
      <div class="row mt-4">
        <!-- Card Components -->
        <div class="col-md-6 col-lg-3 mb-3" v-for="(value, key) in metrics" :key="key">
          <div class="card shadow-sm text-center">
            <div class="card-body">
              <h5 class="card-title">{{ key.replace(/^\w/, (c) => c.toUpperCase()) }}</h5>
              <p class="card-text">${{ value }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Investment, Deposit, Withdrawal Chart -->
      <div class="chart-container mt-5">
        <canvas id="investmentDepositChart"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import Usernavbar from "@/components/layouts/usernavbar.vue";
import axios from "axios";
import Chart from "chart.js/auto";

export default {
  components: {
    Usernavbar,
  },
  data() {
    return {
      metrics: {
        balance: 0.0,
        withdrawal: 0.0,
        deposit: 0.0,
        investment: 0.0,
      },
      monthlyData: [], // Holds monthly data
    };
  },
  created() {
    this.fetchMetrics();
  },
  methods: {
    async fetchMetrics() {
      try {
        const response = await axios.get("/api/user/dashboard");
        const data = response.data;

        // Update metrics with overall data from the server
        this.metrics = {
          balance: data.balance ?? 0.0,
          withdrawal: data.withdrawal ?? 0.0,
          deposit: data.deposit ?? 0.0,
          investment: data.investment ?? 0.0,
        };

        // Fetch monthly data for chart
        this.monthlyData = data.monthlyData; // Assumes API provides monthly data for each category
        this.initChart();
      } catch (error) {
        console.error("Error fetching metrics:", error);
      }
    },
    initChart() {
      const ctx = document.getElementById("investmentDepositChart").getContext("2d");

      // Extract monthly data
      const labels = this.monthlyData.map((entry) => entry.month); // Months for x-axis
      const investments = this.monthlyData.map((entry) => entry.investment);
      const deposits = this.monthlyData.map((entry) => entry.deposit);
      const withdrawals = this.monthlyData.map((entry) => entry.withdrawal);

      new Chart(ctx, {
        type: "bar",
        data: {
          labels, // x-axis labels
          datasets: [
            {
              label: "Investment ($)",
              data: investments,
              backgroundColor: "rgba(85, 43, 170, 0.6)",
              borderColor: "#553AAA",
              borderWidth: 1,
            },
            {
              label: "Deposit ($)",
              data: deposits,
              backgroundColor: "rgba(255, 206, 40, 0.6)",
              borderColor: "#FFCE28",
              borderWidth: 1,
            },
            {
              label: "Withdrawal ($)",
              data: withdrawals,
              backgroundColor: "rgba(244, 67, 54, 0.6)",
              borderColor: "#F44336",
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          animation: {
            duration: 1000, // Animation duration in milliseconds
            easing: "easeInOutQuad", // Easing style
          },
          plugins: {
            legend: {
              display: true,
              position: "top",
            },
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: "Amount ($)",
              },
            },
            x: {
              title: {
                display: true,
                text: "Months",
              },
            },
          },
        },
      });
    },
  },
};
</script>

<style scoped>
/* Dashboard styling */
.dashboard-wrapper {
  padding-left: 250px; /* Adjusts padding to accommodate sidebar on large screens */
}

/* Ensure that cards don't overlap with the navbar */
.dashboard-wrapper .dashboard {
  padding-top: 20px; /* Adds padding to the top to ensure no content is hidden under the navbar */
}

.dashboard-title {
  color: rgb(85, 43, 170);
  font-weight: bold;
}

.card {
  border-radius: 10px;
  border-color: rgb(85, 43, 170);
}

.card-title {
  color: rgb(85, 43, 170);
  font-weight: bold;
}

.card-text {
  font-size: 1.5em;
  background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
  color: #fff;
}

.chart-container {
  margin-top: 40px;
  width: 100%;
  height: auto;
}

/* Responsive Sidebar Adjustment */
@media (max-width: 992px) {
  .dashboard-wrapper {
    padding-left: 0; /* Removes padding on smaller screens */
  }
}

@media (max-width: 768px) {
  .dashboard-title {
    margin-top: 40% !important;
  }
}
@media (max-width: 767px) {
  .dashboard-title {
    margin-top: 40% !important; /* Adjust margin-top on smaller screens */
  }
}
</style>
