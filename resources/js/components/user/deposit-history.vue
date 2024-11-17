<template>
    <div class="d-flex">
      <div class="main-content w-100">
        <Usernavbar />
        <div class="container mt-5 content-wrapper">
          <h3 class="mb-4 text-center text-uppercase" :style="{ color: 'rgb(85, 43, 170)' }">
            Fund History
          </h3>
          <div v-if="!deposits.length" class="text-center">Loading deposits...</div>
          <div v-else class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead>
                <tr>
                  <th>Transaction ID</th>
                  <th>Gateway</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="deposits.length === 0">
                <td colspan="5" class="text-center">
                  <div class="alert alert-danger mt-4">No Active Deposit yet</div>
                </td>
              </tr>
                <tr
                  v-else v-for="(deposit, index) in deposits"
                  :key="deposit.id" >
                  <td>{{ deposit.transaction_number }}</td>
                  <td>{{ deposit.wallet.coin }} - {{ deposit.wallet.network }}</td>
                  <td>{{ deposit.amount }} USD</td>
                  <td :style="getRowStyle(deposit.status)">{{ deposit.status }} </td>
                  <td>{{ formatTimeAgo(deposit.created_at) }}</td>
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
  import axios from "axios";
  
  export default {
    name: "InvestHistory",
    components: { Usernavbar },
    data() {
      return {
        deposits: [],
      };
    },
    methods: {
      async fetchDeposits() {
        try {
          const response = await axios.get("/api/deposits");
          this.deposits = response.data;
        } catch (error) {
          console.error("Error fetching deposits:", error);
        }
      },
      getRowStyle(status) {
        if (status === "pending") {
          return {
            backgroundColor: "#f8d7da !important",
            color: "#721c24 !important",
          };
        } else if (status === "completed") {
          return {
            backgroundColor: "#d4edda !important",
            color: "#155724 !important",
          };
        }
        return {};
      },
      formatTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const secondsAgo = Math.floor((now - date) / 1000);
  
        if (secondsAgo < 60) return `${secondsAgo} seconds ago`;
        const minutesAgo = Math.floor(secondsAgo / 60);
        if (minutesAgo < 60) return `${minutesAgo} minutes ago`;
        const hoursAgo = Math.floor(minutesAgo / 60);
        if (hoursAgo < 24) return `${hoursAgo} hours ago`;
        const daysAgo = Math.floor(hoursAgo / 24);
        return `${daysAgo} days ago`;
      },
    },
    mounted() {
      this.fetchDeposits();
    },
  };
  </script>
  
  
  <style scoped>
.table-striped tbody tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}

.pending-bg {
  background-color: #f8d7da !important; /* Light red */
  color: #721c24; /* Dark red text */
}

.completed-bg {
  background-color: #d4edda !important; /* Light green */
  color: #155724; /* Dark green text */
}
.text-white {
  color: white !important;
}

.main-content {
  padding-left: 240px; /* Adjust this value based on navbar width */
}

.content-wrapper {
  padding: 20px;
  padding-top: 80px;
}

@media (max-width: 768px) {
  .main-content {
    padding-left: 0;
  }
  .table {
    font-size: 0.9rem;
  }
  th,
  td {
    white-space: nowrap;
  }
}
</style>