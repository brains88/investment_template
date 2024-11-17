<template>
  <header class="dashboard-header">
    <nav class="navbar navbar-light gradient-bg fixed-top">
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <button
            class="navbar-toggler me-2 d-lg-none"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#dashboardOffcanvas"
            aria-controls="dashboardOffcanvas"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <router-link class="navbar-brand" to="/dashboard">
            <img :src="'assets/img/logo.png'" alt="Dashboard Logo" class="dashboard-logo" />
          </router-link>
        </div>
        
         <!-- Google Translate Element -->
         <div id="google_translate_element" class="lang-mobile"></div>
         <div class="d-flex align-items-center">
        <router-link v-if="authenticated && userData.role === 'user' " to="/dashboard" key="authenticated">
              <img
                  :src="userData.image ? '/storage/profile_images/' + userData.image : '/path/to/default/image.jpg'"
                    alt="Dashboard" 
                    class="slide-icon" 
                    style="width:45px; height:45px; border-radius:50%;">
             </router-link>
             <router-link  to="/logout" exact-active-class="active-link" @click="logout">
              <i  @click="logout" class="fas fa-sign-out-alt ml-3 me-2 text-white"></i>
            </router-link>
        </div>
        </div>
    </nav>

    <div
      class="offcanvas offcanvas-start gradient-bg fixed-sidebar"
      :class="{'show': isLargeScreen}"
      tabindex="-1"
      id="dashboardOffcanvas"
      aria-labelledby="dashboardOffcanvasLabel"
    >
      <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body dark-bg">
        <!-- Fixed Active Link at the top of the sidebar -->
        <div class="fixed-active-link mt-5 mb-2">
          <router-link class="nav-link active-link" to="/dashboard" exact-active-class="active-link">
            <i class="fas fa-tachometer-alt me-2 "></i> Dashboard
          </router-link>
        </div>

        <!-- Scrollable Menu Items -->
        <ul class="navbar-nav flex-column scrollable-menu">
          <li class="nav-item">
            <router-link class="nav-link" to="/plans" exact-active-class="active-link">
              <i class="fas fa-list-ul me-2"></i> Plan
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/add-funds" exact-active-class="active-link">
              <i class="fas fa-plus-circle me-2"></i> Add Funds
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/user-deposits" exact-active-class="active-link">
              <i class="fas fa-chart-line me-2"></i> Deposit History
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/invest-history" exact-active-class="active-link">
              <i class="fas fa-chart-line me-2"></i> Invest History
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/transfer" exact-active-class="active-link">
              <i class="fas fa-exchange-alt me-2"></i> Transfer
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/withdraw" exact-active-class="active-link">
              <i class="fas fa-hand-holding-usd me-2"></i> Withdraw
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/profile" exact-active-class="active-link">
              <i class="fas fa-user me-2"></i> Profile
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/logout" exact-active-class="active-link" @click="logout">
              <i class="fas fa-sign-out-alt me-2"></i> Logout
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  data() {
    return {
      isLargeScreen: false,
      authenticated: false,
      userData: {},
    };
  },
  mounted() {
    this.checkScreenSize();
    window.addEventListener("resize", this.checkScreenSize);
    this.checkAuthentication();
    this.loadGoogleTranslate(); // Ensure this method is called on mount to load the Translate element
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
          // Redirect to login or handle unauthorized access
        }
      }
    },
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth >= 992;
    },
    loadGoogleTranslate() {
      if (!document.querySelector("script[src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit']")) {
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
        document.head.appendChild(script);
      }

      window.googleTranslateElementInit = () => {
        if (!document.getElementById('google_translate_element').hasChildNodes()) {
          new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
      };
    },

    
  logout() {
      axios.post('/api/logout')
        .then(response => {
          // Handle successful logout
          this.$router.push('/home');
          window.location.reload(); // Reload the page
        })
        .catch(error => {
          // Handle logout error
          //console.error('Logout error:', error);
        });
    },
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.checkScreenSize);
    const translateContainer = document.getElementById('google_translate_element');
    if (translateContainer) {
      translateContainer.innerHTML = ''; // Clean the translate container
    }
  },
};

</script>

<style scoped>
.dashboard-header {
  background-color: transparent;
}

.fixed-top {
  top: 0;
  z-index: 1030;
}

.gradient-bg {
  background-color: #000;
}

.dark-bg {
  background: linear-gradient(90deg, rgb(85, 43, 170), #ffce28);
}

/* Navbar Toggler Icon */
.navbar-toggler {
  border-color: rgba(255, 255, 255, 0.1); /* Optional */
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'><path stroke='rgba(255, 255, 255, 1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>") !important;
}

/* Offcanvas Close Icon */
.btn-close {
  filter: invert(1) brightness(2); /* Makes the close icon white */
}

.dashboard-logo {
  height: 40px;
  width: 100%;
}

.profile-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.user-info {
  color: #fff;
}

.nav-link {
  color: #fff !important;
  font-weight: 500;
  padding: 0.75rem 1rem;
  text-transform: uppercase;
  display: flex;
  align-items: center;
}

.active-link {
  background-color: #fff !important;
  color: rgb(85, 43, 170) !important;
  font-weight: bold;
}

.nav-link:hover {
  background-color: rgb(85, 43, 170) !important;
  color: #fff !important;
  font-weight: bold;
}

/* Sidebar */
.fixed-sidebar {
  width: 250px;
}

/* Fixed Active Link */
.fixed-active-link {
  position: sticky;
  top: 0;
  z-index: 1;
  background-color: #000;
  padding: 0.75rem 1rem;
  color: rgb(85, 43, 170) !important;
  font-weight: bold;
}

/* Scrollable Menu */
.scrollable-menu {
  overflow-y: auto;
  max-height: calc(100vh - 80px); /* Adjust height to prevent overlap */
}

@media (min-width: 992px) {
  .offcanvas-start {
    transform: translateX(0) !important;
    visibility: visible !important;
    position: fixed !important;
    top: 0;
    bottom: 0;
    z-index: 1020;
  }
}
</style>
