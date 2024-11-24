<template>
  <div class="page-container bg-dark">
    <Navbar />
    <div class="content">
      <div class="container mt-5 p-4">
        <!-- Login Form -->
        <div class="login-form-container">
          <h4 class="text-uppercase mb-4 mt-4">Account Verification</h4>
          <form @submit.prevent="handleVerification" class="login_form">
            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Enter Verification Code" v-model="verificationCode" required />
            </div>
            <!-- Success and error messages -->
            <div class="message-container">
              <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
              <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
            </div>
            <!-- The end of success message -->
            <button type="submit" class="btn submit-btn w-100 text-uppercase" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Verify Account
            </button>
          </form>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from '@/components/layouts/navbar.vue';
import Footer from '@/components/layouts/footer.vue';
import axios from 'axios';

export default {
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      email: '',
      password: '',
      loading: false,
      verificationCode: '',
      errorMessage: '', // Store error message
      successMessage: '',
    };
  },
  methods: {
    async handleVerification() {
      this.loading = true; 
      this.errorMessage = '';

      try {
        const response = await axios.post('/api/user-verification', {
          verificationCode: this.verificationCode,
        });

        this.loading = false; 

        if (response.data.redirect) {
          this.successMessage = 'Verification successful! Dashboard loading ....';
           // Use window.location.href to redirect to the Laravel route
           window.location.href = response.data.redirect; // Laravel route will be sent here
        } else {
          // Optional: Handle case where there's no redirect
          this.successMessage = 'Verification successful!';
        }
      } catch (error) {
        this.loading = false; // Set loading to false on error
        // Display error message in the template
        this.errorMessage = 'Verification failed! Please check the code and try again.';

        console.log(error);
      }
    },
  },

};
</script>

<style scoped>
/* Flexbox layout to push footer to the bottom */
.page-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.content {
  flex: 1;
}

/* General Styles */
.login-form-container {
  max-width: 400px;
  margin: 3rem auto;
  padding: 2rem;
  border-radius: 8px;
  margin-top:9%;
  box-shadow: 4px 4px #ffce28;
  text-align: center;
  background-color: rgb(85, 43, 170);
}

h4 {
  color: #ffce28;
  font-weight: bold;
  margin-bottom: 1rem;
}

.form-label {
  font-weight: bold;
  color: #fff;
  margin-top: 10px;
}

.submit-btn,
.modal-btn {
  background-color: #ffce28;
  color: white;
  font-weight: bold;
  border: none;
  padding: 0.75rem;
  margin-top: 1rem;
}

.submit-btn:hover,
.modal-btn:hover {
  background-color: #fff;
  color: #ffce28;
}

/* Remove extra margin and padding from body and html */
body,
html {
  margin: 0;
  padding: 0;
}

.container {
  padding-bottom: 0 !important;
}

</style>
