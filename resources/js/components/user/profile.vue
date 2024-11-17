<template>
    <div class="d-flex">
      <Usernavbar />
      <div class="container main-content w-100">
        <div class="user-profile-container">
          <!-- User Profile Section -->
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="profile-card shadow-lg">
                <img
                  :src="userData.image ? '/storage/profile_images/' + userData.image : defaultImage"
                  alt="User Image"
                  class="user-image img-responsive img-thumbnail"
                />
                <h4 class="user-name">{{ userData.name }}</h4>
                <p class="user-email">{{ userData.mobile }}</p>
                <p class="user-email">Username: {{ userData.username }}</p>
                <p class="user-email">Email: {{ userData.email }}</p>
                <p class="user-email">Country: {{ userData.country }}</p>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <!-- Change Password Section -->
              <div class="password-change-form shadow-lg">
                <h3 class="form-title">Change Password</h3>
                <form @submit.prevent="updatePassword">
                  <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input
                      type="password"
                      id="newPassword"
                      v-model="newPassword"
                      placeholder="Enter new password"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input
                      type="password"
                      id="confirmPassword"
                      v-model="confirmPassword"
                      placeholder="Confirm new password"
                      class="form-control"
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
                  <!--The End of Success message-->
                  <button type="submit" class="btn btn-submit" :disabled="loading">
                    <span
                      v-if="loading"
                      class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Update Password
                  </button>
                </form>
              </div>
            </div>
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
        authenticated: false,
        userData: {},
        newPassword: "",
        confirmPassword: "",
        defaultImage: "https://via.placeholder.com/150", // Placeholder image
      };
    },
    created() {
      this.checkAuthentication();
    },
    methods: {
      async checkAuthentication() {
        try {
          const response = await axios.get("/api/verify");
          this.authenticated = response.data.authenticated;
          if (this.authenticated) {
            this.userData = response.data.user;
          }
        } catch (error) {
          if (error.response && error.response.status === 401) {
            // Redirect to the login page if the session has expired
          } else {
            // Handle other types of errors
          }
        }
      },
      async updatePassword() {
    if (this.newPassword.trim() === "" || this.confirmPassword.trim() === "") {
      this.errorMessage = "Both password fields are required!";
      this.successMessage = "";
      return;
    }

    if (this.newPassword !== this.confirmPassword) {
      this.errorMessage = "Passwords do not match!";
      this.successMessage = "";
      return;
    }

    this.loading = true;
    this.successMessage = "";
    this.errorMessage = "";

    const payload = {
      newPassword: this.newPassword,
      password_confirmation: this.confirmPassword,
    };

    try {
      const response = await axios.put("/api/user/change-password", payload);
      this.successMessage = response.data.message || "Password updated successfully!";
      this.newPassword = "";
      this.confirmPassword = "";
    } catch (error) {
      this.errorMessage = error.response?.data?.message || "Failed to update password.";
      console.error("Failed to update password:", error);
    } finally {
      this.loading = false;
    }
  },
    },
  };
  </script>
<style scoped>
.user-profile-container {
  max-width: 800px;
  margin: 2rem auto;
  font-family: "Arial", sans-serif;
  color: rgb(85, 43, 170);
}

.profile-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
  border-radius: 15px;
  padding: 2rem;
  margin: auto;
  margin-bottom: 2rem;
  color: white;
}

.user-image {
  width: 180px;
  height: 180px;
  border-radius: 10px;
  object-fit: cover;
  border: 3px solid white;
  margin-bottom: 1rem;
}

.user-name {
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
}

.user-email {
  font-size: 1rem;
  margin-bottom: 1rem;
}

.password-change-form {
  background-color: white;
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-title {
  font-size: 1.5rem;
  color: rgb(85, 43, 170);
  margin-bottom: 1rem;
  text-align: center;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  font-weight: bold;
  margin-bottom: 0.5rem;
  display: block;
  color: rgb(85, 43, 170);
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid rgb(85, 43, 170);
  border-radius: 5px;
  font-size: 1rem;
  color: rgb(85, 43, 170);
}

.btn-submit {
  display: block;
  width: 100%;
  padding: 0.75rem;
  background-color: rgb(85, 43, 170);
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-submit:hover {
  background-color: #ffce28;
  color: rgb(85, 43, 170);
}

.shadow-lg {
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.main-content {
  margin-top: 8%;
  padding: 20px;
  padding-top: 70px;
}

@media (max-width: 768px) {
  .main-content {
    padding-left: 0;
    margin-top: 20%;
  }

  .profile-card  {
    margin: 20px auto;
    width: 90%; /* Center and responsive width */
  }
  .password-change-form {
    margin: 20px auto;
    width: 90%; /* Center and responsive width */
  }
}
</style>
  