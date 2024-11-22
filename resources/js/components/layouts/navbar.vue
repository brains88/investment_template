<template>
  <!-- Header Section -->
  <header class="header-section" id="header-section">
    <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg reunir-navbar bg-white">
      <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo Section -->
        <div class="logo-section">
          <router-link class="logo-title navbar-brand" to="/">
            <img :src="'assets/img/logo.png'" alt="Equitify Trades" />
          </router-link>
        </div>

        <!-- Toggler Button for Mobile -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars" style="color: rgb(85, 43, 170);"></i>
        </button>

        <!-- Mobile Login Button -->
        <div class="mobile-join-btn d-lg-none">
          <router-link v-if="authenticated && userData.role === 'user' " to="/dashboard" key="authenticated">
              <img
                  :src="userData.image ? '/storage/profile_images/' + userData.image : '/path/to/default/image.jpg'"
                    alt="Dashboard" 
                    class="slide-icon ml-3" 
                    style="width:45px; height:45px; border-radius:50%;">
             </router-link>
             <router-link v-if="authenticated && (userData.role === 'admin')" 
              class="consultant-btn text-uppercase" 
              to="/admin" 
              key="authenticated">
              Welcome Admin
          </router-link>
          <router-link to="/login" v-if="!authenticated" >
          <button class="join-btn">Login</button>
          </router-link>
        </div>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse nav-main justify-content-center" id="navbarNav">
          <ul class="navbar-nav" id="primary-menu">
            <li class="nav-item">
              <router-link class="nav-link" to="/" exact-active-class="active-link">HOME</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/plans" exact-active-class="active-link">PLANS</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/contact" exact-active-class="active-link">CONTACT</router-link>
            </li>
          </ul>
        </div>
      
        <!-- Right Side Button for Desktop -->
        <div class="right-side-box d-none d-lg-block">
                    <div>
            <a 
              v-if="authenticated && userData.role === 'user'" 
              href="/dashboard"
              key="authenticated"
            >
              <img
                :src="userData.image ? '/storage/profile_images/' + userData.image : '/path/to/default/image.jpg'"
                alt="Dashboard" 
                class="slide-icon ml-3" 
                style="width:45px; height:45px; border-radius:50%;"
              />
            </a>
            
            <a 
              v-if="authenticated && userData.role === 'admin'" 
              href="/admin"
              class="consultant-btn text-uppercase" 
              key="authenticated"
            >
              Welcome Admin
            </a>
          </div>

          <router-link to="/login"  v-if="!authenticated" >
          <button class="join-btn">
            Login</button>
          </router-link>
        </div>
      </div>
    </nav>
  </header>  
</template>

 <script>
import axios from 'axios';

export default {
  data() {
    return {
      authenticated: false,
      userData: {},
    };
  },
  created() {
    this.checkAuthentication();
  },
  methods: {
    async checkAuthentication() {
      try {
        const response = await axios.get('/api/verify');
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
    reloadHome() {
      if (this.$route.path == '/home'|| this.$route.path == '/') {

        window.location.reload(); // Force a page reload
      }
    }
    },
    
}
</script>

<style scoped>
/* Navbar */
.nav-link {
  color: rgb(85, 43, 170) !important;
}
.active-link {
  color: #ffce28 !important;
  font-weight: bold;
}
.logo-section img {
  width: 100px !important;
}
.join-btn {
  background-color: rgb(85, 43, 170);
  color: #fff !important;
  border-radius: 10px;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none !important;
  border: none;
}
.join-btn:hover {
  background-color: #fff;
  color: rgb(85, 43, 170) !important;
  border-color: rgb(85, 43, 170);
}

.text-center a {
  color: rgb(85, 43, 170);
}
.text-center a:hover {
  text-decoration: underline;
}

</style>
