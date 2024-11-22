// router/index.js

import { createRouter, createWebHistory } from 'vue-router';
import { createStore } from 'vuex'; // If you're using Vuex

// Import your components
import Home from '@/components/home.vue';
import Contact from '@/components/contact.vue';
import Plans from '@/components/plan.vue';
import Login from '@/components/auth/login.vue';
import Register from '@/components/auth/register.vue';
import Verification from '@/components/auth/account-verification.vue';
import passwordReset from '@/components/auth/password_reset.vue';
// Define routes
const routes = [
  { path: '/', component: Home },
  { path: '/contact', component: Contact },
  { path: '/plans', component: Plans },
  { path: '/login', component: Login },
  { path: '/user-verification', component: Verification },
  { path: '/register', component: Register },
  { path: '//password_reset', component: passwordReset },
  { path: '/:pathMatch(.*)*', redirect: '/' },
];

// Create Router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Vuex Store setup (example)
const store = createStore({
  state: {
    // Your store state here
  },
  mutations: {
    // Your mutations here
  },
 actions: {
    logout({ commit }) {
        // Call the backend API to log the user out
        axios.post('/logout') // Adjust to your API route
            .then(response => {
                // Clear frontend state in Vuex
                commit('setAuthenticated', false);
                commit('setUser', null);

                // Optionally clear authentication token
                localStorage.removeItem('auth_token'); // Clear token if using JWT

                // Reload the page to reset everything
                window.location.reload(); // This will reload the page and reset the app state

                // Optionally redirect to login page
                this.$router.push('/login'); // Redirect to login page
            })
            .catch(error => {
                console.error('Logout failed', error);
            });
    }
}

});

// Export both router and store
export { router, store };
