<template>
  <div class="d-flex">
    <Usernavbar />
    <div class="main-content w-100">
      <div class="container mt-5 content-wrapper">
        <!-- Add Fund Form -->
        <div class="add-fund-form">
          <h5 class="form-title text-uppercase">Add Funds</h5>
          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label for="coin" class="form-label">Select Coin</label>
              <select v-model="selectedWallet" id="coin" class="form-select custom-select">
                <option value="" disabled>Select Coin</option>
                <option v-for="wallet in wallets" :key="wallet.id" :value="wallet">
                  {{ wallet.coin }} - {{ wallet.network }}
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input
                v-model="amount"
                type="number"
                id="amount"
                class="form-control custom-input"
                placeholder="Enter amount"
                min="0"
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
            <button type="submit" class="addfundButton w-100 p-2" :disabled="loading">
              <span
                v-if="loading"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Deposit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div v-if="showModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Deposit Details</h5>
        <button type="button" class="close" @click="closeModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Amount:</strong> ${{ amount }}</p>
        <p><strong>Coin:</strong> {{ selectedWallet.coin }}</p>
        <p><strong>Network:</strong> {{ selectedWallet.network }}</p>
        <p class="wallet-address">
          <strong>Wallet Address:</strong> 
          <br />
          {{ selectedWallet.address }}
          <br />
          <button class="btn btn-sm btn-outline-secondary mt-2" @click="copyAddress">
            Copy Address
          </button>
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary mx-auto" @click="closeModal" aria-label="Close" >
          I have completed the transaction
        </button>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import Usernavbar from "@/components/layouts/usernavbar.vue";

export default {
  name: "InvestHistory",
  components: { Usernavbar },
  data() {
    return {
      successMessage: "",
      errorMessage: "",
      selectedWallet: null,
      loading: false,
      wallets: [],
      amount: 0,
      showModal: false,
    };
  },
  methods: {
  async getWallets() {
    try {
      const response = await axios.get("/api/wallets");
      this.wallets = response.data.data;
    } catch (error) {
      console.error("Error fetching wallets:", error);
    }
  },
  showModalDialog(message) {
    this.modalMessage = message;
    this.showModal = true;
  },
  closeModal() {
    this.showModal = false;
    this.modalMessage = "";
  },
  clearMessages() {
    setTimeout(() => {
      this.successMessage = "";
      this.errorMessage = "";
    }, 5000); // Clear messages after 5 seconds
  },
  async submitForm() {
    this.loading = true;
    if (!this.selectedWallet || this.amount <= 0) {
      this.errorMessage = "Please select a valid wallet and amount.";
      this.loading = false;
      this.clearMessages();
      return;
    }
    try {
      const response = await axios.post("/api/deposits", {
        wallet_id: this.selectedWallet.id,
        amount: this.amount,
      });
      this.successMessage = "Deposit created successfully.";
      this.showModalDialog("Deposit created successfully.");
    } catch (error) {
      this.errorMessage =
        error.response?.data?.message || "An error occurred. Please try again.";
      this.showModalDialog(this.errorMessage);
    } finally {
      this.loading = false;
      this.clearMessages();
    }
  },
  copyAddress() {
    navigator.clipboard.writeText(this.selectedWallet.address).then(() => {
      alert("Wallet address copied to clipboard!");
    });
  },
},

  mounted() {
    this.getWallets();
  },
};
</script>

<style scoped>
/* Enhanced styling for Add Fund Form */
.add-fund-form {
  background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
  border-radius: 15px;
  padding: 25px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  max-width: 500px;
  margin: 0 auto;
}
.form-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 15px;
  color: #5532aa;
  text-align: center;
}

.custom-input {
  border-radius: 8px;
  border: 1px solid #ddd;
  padding: 10px;
  font-size: 14px;
}
.custom-select:focus{
  border-color: #5532aa;
  outline: none;
  box-shadow: 0 0 5px rgba(85, 50, 170, 0.5);
}
.addfundButton {
  background: linear-gradient(to right, #5532aa, #ffce28);
  color: white;
  font-weight: bold;
  border-radius: 12px;
  transition: all 0.3s ease;
}
.addfundButton:hover {
  background: linear-gradient(to right, #4e29b0, #e5bc23);
}
/* Enhanced styling for modal */
.modal {
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 1050;
  overflow: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-content {
  border-radius: 15px;
  padding: 20px;
  background: #fff;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}
.modal-header {
  border-bottom: none;
  text-align: center;
  position: relative;
}
.modal-header .close {
  position: absolute;
  top: 0;
  right: 10px;
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}
.modal-body {
  text-align: center;
}
.modal-body p {
  margin-bottom: 10px;
}
.wallet-address {
  word-wrap: break-word;
  font-size: 14px;
}
.modal-footer {
  border-top: none;
  display: flex;
  justify-content: center;
}
.modal-footer button {
  background-color: #5532aa;
  color: white;
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  font-weight: bold;
  cursor: pointer;
}
.modal-footer button:hover {
  background-color: #4e29b0;
}

/* Button inside modal body */
.modal-body .btn-outline-secondary {
  font-size: 12px;
  padding: 5px 10px;
  margin-top: 10px;
}
.main-content{
  margin-top: 8%;
}

@media (max-width: 768px) {
      .main-content {
        padding-left: 0;
      }
    }
</style>