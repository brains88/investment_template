<template>
    <div class="d-flex">
        <div class="main-content w-100">
      <!-- User Navbar -->
      <Usernavbar />
  
      <!-- Page Content Wrapper -->
      <div class="container mt-4">
        <h3 class="text-center text-uppercase">Withdrawal</h3>
  
        <!-- Withdraw Button to Trigger Modal -->
        <div class="d-flex justify-content-end  mt-4">
            <button class="btn withdrawal-button " @click="openWithdrawalModal" :style="{ backgroundColor: 'rgb(85, 43, 170)', color: '#fff', }">Withdraw</button>
          </div>
        <!-- Withdrawal Modal -->
        <div v-if="showWithdrawalModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" :style="{color:'rgb(85, 43, 170)' }">Withdraw Funds</h5>
                <button type="button" class="close" @click="closeModal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body modal-scrollable" style="max-height: 70vh; overflow-y: auto;">
                <form @submit.prevent="submitWithdrawal">
                  <!-- Available Balance Display -->
                  <div class="mb-3">
                    <label class="form-label">Available Balance:</label>
                    <input type="number" :value="availableBalance" class="form-control" readonly />
                </div>
                  <!-- Request Amount -->
                  <div class="mb-3">
                    <label class="form-label">Request Amount:</label>
                    <input type="number" v-model="amount" class="form-control" placeholder="Enter amount to withdraw" required />
                  </div>
  
                  <!-- Withdrawal Type Selection -->
                  <div class="mb-3">
                    <label class="form-label">Withdrawal Method</label>
                    <select v-model="withdrawalType" class="form-control" required>
                      <option disabled value="">Select Withdrawal Method</option>
                      <option value="crypto">Cryptocurrency</option>
                      <option value="bank">Bank Transfer</option>
                    </select>
                  </div>
  
                  <!-- Cryptocurrency Withdrawal Fields -->
                  <div v-if="withdrawalType === 'crypto'">
                    <div class="mb-3">
                      <label class="form-label">Wallet Address *</label>
                      <input type="text" v-model="cryptoWalletAddress" class="form-control" placeholder="Enter wallet address" required />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Network *</label>
                      <select v-model="cryptoNetwork" class="form-control" required>
                        <option disabled value="">Select Network</option>
                        <option value="Ethereum">Ethereum</option>
                        <option value="Bitcoin">Bitcoin</option>
                        <option value="Binance Smart Chain">Binance Smart Chain</option>
                        <option value="Bep20">Bep20</option>
                        <option value="TRC-20">TRC-20</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Coin Type *</label>
                      <select v-model="coinType" class="form-control" required>
                        <option disabled value="">Select Coin</option>
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                        <option value="USDT">USDT</option>
                        <option value="BNB">BNB</option>
                      </select>
                    </div>
                  </div>
  
                  <!-- Bank Transfer Withdrawal Fields -->
                  <div v-if="withdrawalType === 'bank'">
                    <div class="mb-3">
                      <label class="form-label">Bank Name *</label>
                      <input type="text" v-model="bankName" class="form-control" placeholder="Enter bank name" required />
                    </div>
                    <!--
                    <div class="mb-3">
                      <label class="form-label">Transaction Proof</label>
                      <input type="file" @change="handleFileUpload" class="form-control" />
                    </div>
                    -->
                    <div class="mb-3">
                      <label class="form-label">Your Address *</label>
                      <input type="text" v-model="address" class="form-control" placeholder="Enter your address" required />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Bank Account Number *</label>
                      <input type="text" v-model="bankAccountNumber" class="form-control" placeholder="Enter bank account number" required />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Routing Number *</label>
                      <input type="text" v-model="routingNumber" class="form-control" placeholder="Enter routing number" required />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Zelle Email</label>
                      <input type="email" v-model="zelleEmail" class="form-control" placeholder="Enter Zelle email (optional)" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label">PayPal Email</label>
                      <input type="email" v-model="paypalEmail" class="form-control" placeholder="Enter PayPal email (optional)" />
                    </div>
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
                    <!--The end of Success Message-->
                  <!-- Confirm Withdrawal Button -->
                  <button type="submit" class="btn w-100 mt-3" :style="{background: 'linear-gradient(90deg, rgb(85, 43, 170), #ffce28)', color:'#fff' }"
                  :disabled="loading">
                      <span
                        v-if="loading"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                      ></span>
                      Confirm Withdrawal</button>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Withdrawal History Table -->
        <h4 class="mt-5 text-center text-uppercase">Withdrawal History</h4>
        <div class="table-responsive">
        <table class="table table-striped mt-3">
          <thead class="table-dark text-white">
            <tr>
              <th>Transaction ID</th>
              <th>Withdrawal Method</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Time</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
          <tr v-if="transactions.length === 0">
            <td colspan="10" class="text-center">
              <div class="alert alert-danger mt-4">No Available Withdrawals</div>
            </td>
          </tr>
          <tr v-for="transaction in transactions" :key="transaction.id">
            <td>{{ transaction.transaction_number }}</td>
            <td>{{ transaction.method }}</td>
            <td>{{ transaction.amount }} USD</td>
            <td :style="getRowStyle(transaction.status)">{{ transaction.status }}</td>
            <td>{{ formatTimeAgo(transaction.created_at) }}</td>
            <td>
            <button> <i
                class="fa fa-info-circle text-primary"
                style="cursor: pointer"
                @click="showTransaction(transaction.id)"
              ></i></button>
            </td>
          </tr>
        </tbody>
        </table>
    </div>
      </div>
      
        <!-- Transaction Detail Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Transaction Details</h5>
              <button type="button" class="close" @click="closeModal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" v-if="selectedTransaction">
              <p><strong>Transaction ID:</strong> {{ selectedTransaction.transaction_number }}</p>
              <p><strong>Withdrawal Method:</strong> {{ selectedTransaction.method }}</p>
              <p><strong>Amount:</strong> ${{ selectedTransaction.amount }}</p>
              <p :style="getRowStyle(selectedTransaction.status)"><strong>Status:</strong> {{ selectedTransaction.status }}</p>
              <p><strong>Time:</strong> {{ formatTimeAgo(selectedTransaction.created_at) }}</p>

              <div>
                <h5>Withdrawal Message</h5>
                <p>Your withdrawal is processing</p>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    </div>
  </template>
  
  <script>
  import Usernavbar from "@/components/layouts/usernavbar.vue";
  
  export default {
    components: {
      Usernavbar,
    },
    data() {
      return {
        showWithdrawalModal: false,
        withdrawalType: null,
        amount: null,
        successMessage: "",
        errorMessage: "",
        loading: false,
        availableBalance:'',
        cryptoWalletAddress: "",
        cryptoNetwork: "",
        coinType: "",
        bankName: "",
        address: "",
        bankAccountNumber: "",
        routingNumber: "",
        zelleEmail: "",
        paypalEmail: "",
        transactions: [],
        showDetailModal: false,
        data: {
          transactions: [], // Populate this as needed
          selectedTransaction: null,
        },
      };
    },

    created() {
    this.getBalance();
    this.getWithdrawals();
    },
    methods: {
      openWithdrawalModal() {
  this.showWithdrawalModal = true;
    },
    closeModal() {
      this.showWithdrawalModal = false;
      this.showDetailModal = false;
      this.selectedTransaction = null; // Clear the selected transaction
      $('#exampleModal').modal('hide'); // Hide the Bootstrap modal
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

      submitWithdrawal() {
        alert("Withdrawal submitted successfully!");
        this.showWithdrawalModal = false;
      },

      async getBalance() {
    try {
        const response = await axios.get('/api/user/balance');
        // If balance is null or undefined, set it to 0.00
        this.availableBalance = response.data.balance !== null && response.data.balance !== undefined
            ? response.data.balance
            : 0.00;
    } catch (error) {
        // Handle error (for now, just log it)
        console.error(error);
        this.availableBalance = 0.00; // Set to 0.00 in case of error
    }
  },

    async getWithdrawals() {
        try {
            const response = await axios.get('/api/user/withdrawals');
            this.transactions = response.data;
        } catch (error) {
        }
      },
      async submitWithdrawal() {
    // Set loading state to true
    this.loading = true;
    
    // Construct payload dynamically based on withdrawal type
    const payload = {
        amount: this.amount,
        method: this.withdrawalType,
    };

    if (this.withdrawalType === 'crypto') {
        payload.cryptoWalletAddress = this.cryptoWalletAddress;
        payload.cryptoNetwork = this.cryptoNetwork;
        payload.coinType = this.coinType;
    } else if (this.withdrawalType === 'bank') {
        payload.bankName = this.bankName;
        payload.address = this.address;
        payload.bankAccountNumber = this.bankAccountNumber;
        payload.routingNumber = this.routingNumber;
        if (this.zelleEmail) payload.zelleEmail = this.zelleEmail;
        if (this.paypalEmail) payload.paypalEmail = this.paypalEmail;
    }

    try {
        const response = await axios.post('/api/user/withdraw', payload);
        
        // Handle successful response
        this.successMessage = response.data.message || "Withdrawal submitted successfully";
        this.closeModal();
        this.getBalance();
        this.getWithdrawals();
    } catch (error) {
        // Handle error response
        this.errorMessage = error.response?.data?.error || 'An error occurred.';
    } finally {
        // Set loading state to false when the request is finished (either success or error)
        this.loading = false;
    }
      },

    
      showTransaction(id) {
    console.log('Clicked Transaction ID:', id);
    console.log('Transactions Data:', this.transactions);
    this.selectedTransaction = this.transactions.find(transaction => transaction.id === id);
    console.log('Selected Transaction:', this.selectedTransaction);
    $('#exampleModal').modal('show');
  },
  
    },
  };
  </script>
  
  <style scoped>
  .modal-scrollable {
    max-height: 70vh;
    overflow-y: auto;
  }
  .main-content {
    padding-left: 240px; /* Adjust this value based on navbar width */
  }
  input{
    border-color: linear-gradient(90deg, rgb(85, 43, 170), #ffce28) !important;
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
    .withdrawal-button{
      margin-top:15%;
    }
    th,
    td {
      white-space: nowrap;
    }
  }
  @media (max-width: 767px) {
    .withdrawal-button {
        margin-top: 30%;
    }
}


  </style>
  