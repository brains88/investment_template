import { createRouter, createWebHashHistory } from 'vue-router';
import { createStore } from 'vuex'; // Remove if Vuex is not used
// Import middleware functions if used, otherwise remove
import { requireAuth, requireAdminAuth, preventUserAccess } from '@/middleware/index.js';
import Home from '@/components/home.vue';
import Contact from '@/components/contact.vue';
import Plans from '@/components/plan.vue';
import Login from '@/components/auth/login.vue';
import Register from '@/components/auth/register.vue';
import Verification from '@/components/auth/account-verification.vue';
//User Routes
import Dashboard from '@/components/user/dashboard.vue';
import investHistory from '@/components/user/invest-history.vue';
import addFunds from '@/components/user/add-funds.vue';
import userDeposit from '@/components/user/deposit-history.vue';
import Transfer from '@/components/user/transfer.vue';
import Withdraw from '@/components/user/withdraw.vue';
import withdrawHistory from '@/components/user/withdraw-history.vue';
import Profile from '@/components/user/profile.vue';

// Admin Routes
import AdminDashboard from '@/components/admin/dashboard.vue'; 

// Define routes
const routes = [
    // Public Routes
    { path: '/', component: Home },
    { path: '/contact', component: Contact },
    { path: '/plans', component: Plans},
  
  
    // Auth Routes
    { path: '/login', component: Login },
    { path: '/user-verification', component: Verification },
    { path: '/register', component: Register },
  
    // User Routes (protected)
   { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true },},
   { path: '/add-funds',component: addFunds,Usermeta: { requiresAuth: true }, },
   { path: '/user-deposits',component: userDeposit,Usermeta: { requiresAuth: true }, },
   { path: '/invest-history',component:investHistory,Usermeta: { requiresAuth: true }, },
    { path: '/transfer',component: Transfer,Usermeta: { requiresAuth: true }, },
    {path: '/withdraw',component: Withdraw,Usermeta: { requiresAuth: true },},
    {path: '/withdraw-history',component: withdrawHistory,Usermeta: { requiresAuth: true },},
    {path: '/profile',component: Profile,Usermeta: { requiresAuth: true },},
    
    //Admin Routes
    {path: '/admin',component:AdminDashboard,meta: { requiresAdmin: true, preventUserAccess: true }},
  
    // Catch-all route
    { path: '/:pathMatch(.*)*', redirect: '/' }, // You can replace with a 404 component
  ];
  
  // Create Router instance
  const router = createRouter({
    history: createWebHashHistory(),
    routes,
  });
  
  // Global Route Guard for Authentication and Role Check
  router.beforeEach(async (to, from, next) => {
      // Check if the route requires authentication
      if (to.meta.requiresAuth) {
        try {
          // Make a request to check authentication state
          const response = await axios.get('/api/verify');
          const authenticated = response.data.authenticated;
    
          // If authenticated, proceed to the route
          if (authenticated) {
            next();
          } else {
            // If not authenticated, redirect to the login page
            next('/login');
          }
        } catch (error) {
          // Handle errors
          console.error('Error checking authentication:', error);
          next('/login');
        }
      } else if (to.meta.requiresAdmin) {
        try {
          // Make a request to check if the user is an admin
          const response = await axios.get('/api/checkAdmin');
          const isAdmin = response.data.isAdmin;
    
          // If user is an admin, proceed to the route
          if (isAdmin) {
            next();
          } else {
            // If not an admin, redirect to the login page
            next('/login');
          }
        } catch (error) {
          // Handle errors
          console.error('Error checking admin status:', error);
          next('/login');
        }
      } else if (to.meta.preventUserAccess) {
        try {
          // Make a request to check if the user is a User
          const response = await axios.get('/api/checkUser');
          const isUser = response.data.isUser;
    
          // If user is a User, prevent access to admin route and redirect to user dashboard
          if (isUser) {
            next('/dashboard');
          } else {
            next();
          }
        } catch (error) {
          // Handle errors
          console.error('Error checking User status:', error);
          next('/login');
        }
      } else {
        // For other routes, proceed without authentication
        next();
      }
      
    });

 // Vuex store (if needed)
const store = createStore({
  // Define your Vuex store state and mutations here
});

export { router, store };
  