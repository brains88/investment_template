<template>
<div class="bg-dark">
    <Navbar/>
    <div class="container mt-5 p-4">
    <!-- Login Form -->
    <div class="login-form-container">
      <h1>Login</h1>
      <form @submit.prevent="Login" class="login_form">
        <div class="mb-3">
          <label for="signinEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" placeholder="Email" v-model="email" required />
          <span class="text-danger text-small">{{formErrors.email}}</span>
        </div>
        <div class="mb-3">
          <label for="signinPassword" class="form-label">Password</label>
          <input type="password" class="form-control" placeholder="********" v-model="password" required />
          <span class="text-danger text-small">{{formErrors.password}}</span>
        </div>
          <!-- Success and error messages -->
          <div class="message-container">
            <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
            <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
          </div>
          <!--The end of success message-->

        <button type="submit" class="btn submit-btn w-100" :disabled="loading">
          <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Sign In
        </button>
        <div class="text-center mt-3">
          <a href="#" @click.prevent="openForgotPasswordModal" :style="{ color: '#fff' }">Forgot Password?</a>
        </div>
        <div class="text-center mt-3">
          <router-link to="/register"  :style="{ color: '#fff' }"> New User?</router-link>
        </div>
      </form>
      </div>



    <!-- Forgot Password Modal -->
    <div v-if="showForgotPassword" class="modal-overlay" @click="closeModals">
      <div class="modal-content" @click.stop>
        <h2>Forgot Password</h2>
        <form @submit.prevent="handleForgotPassword">
          <div class="mb-3">
            <label for="forgotEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" v-model="forgotEmail" required />
          </div>
          <button type="submit" class="btn modal-btn w-100" :style="{ backgroundColor: 'rgb(85, 43, 170)' }">
            <span v-if="loadingForgot" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Send Reset Link
          </button>
        </form>
        <button @click="closeModals" class="modal-close">Close</button>
      </div>
    </div>



    </div>
  <Footer/>
</div>
</template>
  
  <script>
  import Navbar from '@/components/layouts/navbar.vue';
  import Footer from '@/components/layouts/footer.vue';
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
        errorMessage: '',
        successMessage: '',
        forgotEmail: '',
        showForgotPassword: false,
        showVerification: false,
        verificationCode: '',
        loadingForgot: false,
        loadingVerification: false,
        formErrors: {},
      };
    },
    methods: {
        Login() {
    this.loading = true;
    this.errorMessage = '';
    this.successMessage = '';

    if (!this.email || !this.password) {
        this.errorMessage = 'Email and password are required';
        this.loading = false;
        return;
    }

    axios.post('/api/login', { email: this.email, password: this.password })
        .then(response => {
            if (response.data && response.data.message === 'Login successful') {
                this.successMessage = response.data.message;
                
                // Redirect to the appropriate page based on the role
                const redirect = response.data.redirect;
                this.$router.push(redirect);
            } else {
                this.errorMessage = response.data.message || 'Login failed. Please try again.';
            }
        })
        .catch(error => {
            if (error.response && error.response.status === 403 && error.response.data.redirect) {
                // Redirect to account activation if unverified
                this.errorMessage = error.response.data.message;
                this.$router.push(error.response.data.redirect);
            } else if (error.response && error.response.status === 422) {
                this.errors = error.response.data.errors;
            } else {
                this.errorMessage = 'Incorrect email or password.';
            }
        })
        .then(() => {
            this.loading = false;
        });
},
      async handleForgotPassword() {
        this.loadingForgot = true;
        // Simulate API request for sending password reset link
        setTimeout(() => {
          this.loadingForgot = false;
          this.showForgotPassword = false; // Close modal after sending
          alert("Reset link sent to your email!");
        }, 1500);
      },
      async handleVerification() {
        this.loadingVerification = true;
        // Simulate verification process
        setTimeout(() => {
          this.loadingVerification = false;
          this.showVerification = false; // Close modal after verification
          alert("Verification successful!");
        }, 1500);
      },
      openForgotPasswordModal() {
        this.showForgotPassword = true;
      },
      closeModals() {
        this.showForgotPassword = false;
        this.showVerification = false;
      },
    },
  };
  </script>
  
  
  <style scoped>
  /* General Styles */
  .login-form-container {
    max-width: 400px;
    margin: 3rem auto;
    padding: 2rem;
    margin-top: 5%;
    border-radius: 8px;
    box-shadow: 4px 4px #ffce28;
    text-align: center;
    background-color: rgb(85, 43, 170);
  }
  
  h1 {
    color: #ffce28;
    font-weight: bold;
    margin-bottom: 1rem;
  }
  
  .form-label {
    font-weight: bold;
    color: #fff;
    margin-top: 10px;
  }
  
  .submit-btn, .modal-btn {
    background-color: #ffce28;
    color: white;
    font-weight: bold;
    border: none;
    padding: 0.75rem;
    margin-top: 1rem;
  }
  
  .submit-btn:hover, .modal-btn:hover {
    background-color: #fff;
    color: #ffce28;
  }
  
  /* Modal Overlay */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(1, 1, 1, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
  }
  
  .modal-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
  }
  
  .modal-close {
    margin-top: 1rem;
    background: none;
    border: none;
    color: rgb(85, 43, 170);
    cursor: pointer;
    font-weight: bold;
  }
  
  .modal-close:hover {
    color: rgba(85, 43, 170, 0.85);
  }
  </style>
  