<template>
  <div class="bg-dark">
    <Navbar />
    <div class="container mt-5 mb-5 p-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="register-form-container p-4">
            <h5 class="text-center mb-4 mt-4 p-3 text-uppercase" :style="{ backgroundColor:'#fff', color: 'rgb(85, 43, 170)' }">
              Create Account
            </h5>
            <form @submit.prevent="handleRegister">
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" placeholder="John Micheal" v-model="fullname" required />
                  <span v-if="formErrors.fullname" class="text-danger">{{ formErrors.fullname }}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" placeholder="micheal" v-model="username" required />
                  <span v-if="formErrors.username" class="text-danger">{{ formErrors.username }}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" placeholder="example@gmail.com" v-model="email" required />
                  <span v-if="formErrors.email" class="text-danger">{{ formErrors.email }}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Mobile</label>
                  <input type="tel" class="form-control" placeholder="+1 808 436 364" v-model="mobile" required />
                  <span v-if="formErrors.mobile" class="text-danger">{{ formErrors.mobile }}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Country</label>
                  <input type="text" class="form-control" placeholder="Country" v-model="country" required />
                  <span v-if="formErrors.country" class="text-danger">{{ formErrors.country }}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" placeholder="********" v-model="password" required />
                  <span v-if="formErrors.password" class="text-danger">{{ formErrors.password }}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="********" v-model="confirmPassword" required />
                  <span v-if="formErrors.confirmPassword" class="text-danger">{{ formErrors.confirmPassword }}</span>
                </div>
              </div>
              <!--
              <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" class="form-control" @change="onFileChange" />
                <span v-if="formErrors.profileImage" class="text-danger">{{ formErrors.profileImage }}</span>
              </div> -->
              <!-- Success and error messages -->
              <div class="message-container">
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
              </div>
              <!-- The end of success message -->
              <button type="submit" class="btn submit-btn w-100 mt-3 mb-3" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Register
              </button>
            </form>
            <div class="text-center mt-3" :style="{ color: '#fff' }">Already have an account?
              <router-link to="/login"> Login</router-link>
            </div>
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

export default {
  components: { Navbar, Footer },
  data() {
    return {
      fullname: '',
      email: '',
      username: '',
      password: '',
      mobile: '',
      confirmPassword: '',
      profileImage: null,
      country: '',
      loading: false,
      formErrors: {},
      errorMessage: '',
      successMessage: '',
      referrer: null,
    };
  },
  async mounted() {
    try {
      const response = await axios.get('/api/get-referral');
      this.referrer = response.data.referrer;
    } catch (error) {
      console.error("Could not retrieve referral code:", error);
    }
  },
  methods: {
    onFileChange(event) {
      this.profileImage = event.target.files[0];
    },
    async handleRegister() {
      this.loading = true;
      this.formErrors = {};
      this.errorMessage = '';
      this.successMessage = '';

      if (this.password !== this.confirmPassword) {
        this.formErrors.confirmPassword = "Passwords do not match";
        this.loading = false;
        return;
      }

      const formData = new FormData();
      formData.append("fullname", this.fullname);
      formData.append("email", this.email);
      formData.append("username", this.username);
      formData.append("mobile", this.mobile);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.confirmPassword);
      formData.append("country", this.country);
      if (this.profileImage) {
        formData.append("profileImage", this.profileImage);
      }

      try {
        const response = await axios.post('/api/register', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        this.successMessage = response.data.message;
        this.fullname = '';
        this.email = '';
        this.mobile = '';
        this.username = '';
        this.password = '';
        this.confirmPassword = '';
        this.country = '';
        this.profileImage = null;

        setTimeout(() => {
          this.$router.push('/user-verification');
        }, 2000);
      } catch (error) {
        if (error.response && error.response.data) {
          this.errorMessage = error.response.data.message || 'Registration failed.';
          if (error.response.data.errors) {
            this.formErrors = error.response.data.errors;
          }
        }
      } finally {
        this.loading = false;
      }
    },
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
  label{
    color:#fff;
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
  