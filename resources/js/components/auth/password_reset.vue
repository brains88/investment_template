<template>
    <div class="bg-dark">
      <Navbar />
      <div class="container mt-5 mb-5 p-4">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="register-form-container p-4">
              <h5 class="text-center mb-4 mt-4 p-3 text-uppercase" :style="{ backgroundColor:'#fff', color: 'rgb(85, 43, 170)' }">Password Reset</h5>
              <form @submit.prevent="passwordReset">
                <div class="row">
                  <div class="col-12 mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" placeholder="*******" v-model="newpassword" required />
                    <span v-if="formErrors.newpassword" class="text-danger">{{ formErrors.newpassword }}</span>
                  </div>
                  <div class="col-12  mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="*******" v-model="confirmpassword" required />
                    <span v-if="formErrors.confirmpassword" class="text-danger">{{ formErrors.confirmpassword }}</span>
                  </div>
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- The end of success message-->
                  <button type="submit" class="btn submit-btn w-100 mt-3 mb-3" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Reset Password
                  </button>
                  </div>
                </form>
              </div>
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
    components: { Navbar, Footer },
    data() {
      return {
        newpassword: '',
        confirmpassword: '',
        loading: false,
        formErrors: {},
        errorMessage: '',
        successMessage: '',
        token: this.$route.query.token, // Assuming token is passed in the URL
        email: this.$route.query.email, // Assuming email is passed in the URL
      };
    },
    
    mounted() {
      document.title = 'Password Reset | Equitify Trades';
    },
  
    methods: {
      async passwordReset() {
        this.loading = true;
        this.formErrors = {}; // Reset errors at the start
        this.errorMessage = ''; // Clear error message
        this.successMessage = ''; // Clear success message
  
        if (this.newpassword !== this.confirmpassword) {
          this.formErrors.confirmpassword = "Passwords do not match";
          this.loading = false;
          return;
        }
  
        const formData = new FormData();
        formData.append("email", this.email);
        formData.append("token", this.token);
        formData.append("password", this.newpassword);
        formData.append("password_confirmation", this.confirmpassword);
  
        try {
          const response = await axios.post('/api/password/reset', formData);
          
          // Success message and form reset
          this.successMessage = 'Your password has been reset successfully. You can now log in with your new password.';
          this.newpassword = '';
          this.confirmpassword = '';
          
          // Redirect to login page after a short delay
          setTimeout(() => {
            this.$router.push('/login');
          }, 2000); // Redirect after 2 seconds
  
        } catch (error) {
          if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
            Object.keys(errors).forEach(field => {
              this.formErrors[field] = errors[field][0];
            });
          } else {
            this.errorMessage = 'An error occurred while resetting your password. Please try again later.';
          }
        } finally {
          this.loading = false;
        }
      }
    },
  };
  </script>
  
  <style scoped>
  .register-form-container {
    background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
    border-radius: 8px;
    box-shadow: 3px 3px 3px 3px #000;
    margin-top:8%;
  }
  label {
    color: #fff;
  }
  .submit-btn {
    background-color: #5533aa;
    color: white;
    font-weight: bold;
  }
  
  .submit-btn:hover {
    background-color: #442288;
  }
  </style>
  