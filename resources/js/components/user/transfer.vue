<template>
    <div class="d-flex">
      <div class="main-content w-100">
        <Usernavbar />
        <div class="container mt-5 content-wrapper">
          <!-- Add Transfer Button at the top-right -->
          <div class="d-flex justify-content-end mb-3">
            <button class="btn addfundButton" @click="showTransferForm = true">Transfer Funds</button>
          </div>
          <!-- Transaction History Table -->
          <h4 class="mb-4 text-center text-uppercase">Transaction History</h4>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead>
                <tr>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col" class="text-uppercase">Receiver's Email</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col" class="text-uppercase">Amount</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col" class="text-uppercase">Status</th>
                  <th :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff' }" scope="col" class="text-uppercase">Time</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="transactions.length === 0">
                <td colspan="5" class="text-center">
                  <div class="alert alert-danger mt-4">No Active Transfers yet</div>
                </td>
              </tr>
                <tr v-else v-for="(transaction, index) in transactions" :key="transaction.id">
                  <td>{{ transaction.receiverEmail }}</td>
                  <td>{{ transaction.amount }} USD</td>
                  <td>{{ transaction.status }}</td>
                  <td>{{ formatTimeAgo(transaction.created_at) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
  
        </div>
      </div>
    </div>
  
    <!-- Modal for Transfer Form -->
    <div v-if="showTransferForm" class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Transfer Funds</h5>
            <button type="button" class="close" @click="closeModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitForm">
              <!-- Receiver Email Address -->
              <div class="mb-3">
                <label for="receiverEmail" class="form-label">Receiver's Email</label>
                <input
                  v-model="receiverEmail"
                  type="email"
                  id="receiverEmail"
                  class="form-control"
                  placeholder="Enter receiver's email"
                  required
                />
              </div>
  
              <!-- Amount Input -->
              <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input
                  v-model="amount"
                  type="number"
                  id="amount"
                  class="form-control"
                  placeholder="Enter amount"
                  min="0"
                  required
                />
              </div>
  
              <!-- Password Input -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                  v-model="password"
                  type="password"
                  id="password"
                  class="form-control"
                  placeholder="Enter your password"
                  required
                />
              </div>
               <!-- Success and Error Messages -->
            <div class="message-container mb-3">
              <div v-if="successMessage" class="alert alert-success" role="alert">
                {{ successMessage }}
              </div>
              <div v-if="errorMessage" class="alert alert-danger" role="alert">
                {{ errorMessage }}
              </div>
            </div>
              <!-- Submit Button -->
              <button type="submit" class="addfundButton w-100 p-2":disabled="loading">
              <span
                v-if="loading"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Transfer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  

  <script>
  import Usernavbar from "@/components/layouts/usernavbar.vue";
  import axios from "axios";
  
  export default {
    name: "TransferFunds",
    components: { Usernavbar },
    data() {
      return {
        successMessage: "",
        errorMessage: "",
        loading: false,
        showTransferForm: false,
        receiverEmail: "",
        amount: 0,
        password: "",
        transactions: [],
      };
    },
    methods: {
      async fetchTransactions() {
        try {
          const response = await axios.get("/api/transactions");
          this.transactions = response.data;
        } catch (error) {
          console.error("Error fetching transactions:", error);
        }
      },
      async submitForm() {
        this.loading = true;
        try {
          const response = await axios.post("/api/transfer", {
            receiver_email: this.receiverEmail,
            amount: this.amount,
            password: this.password,
          });
          this.successMessage = response.data.message;
          this.fetchTransactions(); // Refresh transaction list
          this.closeModal();
        } catch (error) {
          console.error("Error during transfer:", error.response?.data);
          this.errorMessage = error.response?.data?.error || "An error occurred. Please try again later.";
        } finally {
          this.loading = false;
        }
      },
      closeModal() {
        this.showTransferForm = false;
        this.receiverEmail = "";
        this.amount = 0;
        this.password = "";
        this.successMessage = "";
        this.errorMessage = "";
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
      this.fetchTransactions();
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
  
  /* Modal Content */
  .modal-content {
    background-color: #fff;
  }
  
  .addfundButton {
    background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
    color: #fff;
    border-radius: 10px;
    border-color: #fff;
  }
  
  .modal-header {
    background-color: rgb(85, 43, 170);
    color: #fff;
  }
  
  .modal-title {
    font-size: 18px;
  }
  
  .modal-content button {
    border-radius: 10px;
    border-color: #fff;
  }
  
  .close {
    color: #fff;
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
  