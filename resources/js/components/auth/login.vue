<template>
    <div class="bg-dark">
        <Navbar />
        <div class="container mt-5 p-4">
            <!-- Login Form -->
            <div class="login-form-container">
                <h1>Login</h1>

                <form @submit.prevent="Login" class="login_form">
                    <div class="mb-3">
                        <label for="signinEmail" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                            v-model="email"
                            required
                        />
                        <span class="text-danger text-small">{{
                            formErrors.email
                        }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="signinPassword" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            placeholder="********"
                            v-model="password"
                            required
                        />
                        <span class="text-danger text-small">{{
                            formErrors.password
                        }}</span>
                    </div>
                    <!-- reCAPTCHA Checkbox -->
                    <!-- reCAPTCHA -->
                    <div id="hcaptcha-login" class="h-captcha"></div>

                    <div class="message-container">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="btn submit-btn w-100"
                        :disabled="loading"
                    >
                        <span
                            v-if="loading"
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                        ></span>
                        Sign In
                    </button>
                    <div
                            class="text-center mt-3"
                            :style="{ color: '#fff' }"
                        >
                            I`m a new User?
                            <router-link to="/register" >Sign Up</router-link>
                        </div>
                    <p class="text-white mt-3 mb-2">
                        <a @click="openForgotPasswordModal" style="">
                            Forgot Password
                        </a>
                    </p>
                </form>
            </div>

            <!-- Forgot Password Modal -->
            <div
                v-if="showForgotPassword"
                class="modal-overlay"
                @click="closeModals"
            >
                <div class="modal-content" @click.stop>
                    <h2>Forgot Password</h2>
                    <form @submit.prevent="handleForgotPassword">
                        <div class="mb-3">
                            <label for="forgotEmail" class="form-label"
                                >Email address</label
                            >
                            <input
                                type="email"
                                class="form-control"
                                v-model="forgotEmail"
                                required
                            />
                        </div>

                        <!-- Success message -->
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <!-- Error message -->
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                        <button
                            type="submit"
                            class="btn modal-btn w-100"
                            :style="{ backgroundColor: 'rgb(85, 43, 170)' }"
                        >
                            <span
                                v-if="loadingForgot"
                                class="spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Send Reset Link
                        </button>
                    </form>
                    <button @click="closeModals" class="modal-close">
                        Close
                    </button>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import Navbar from "@/components/layouts/navbar.vue";
import Footer from "@/components/layouts/footer.vue";
import axios from "axios";

export default {
    components: {
        Navbar,
        Footer,
    },
    data() {
        return {
            email: "",
            password: "",
            loading: false,
            errorMessage: "",
            successMessage: "",
            forgotEmail: "",
            showForgotPassword: false,
            loadingForgot: false,
            formErrors: {},
            captchaChecked: false,
        };
    },
    mounted() {
        this.initializeCaptcha();
    },
    methods: {
        initializeCaptcha() {
            // Check if hCaptcha exists and render it
            if (typeof hcaptcha !== "undefined") {
                // Clear any previous instance of the CAPTCHA widget
                const captchaContainer =
                    document.getElementById("hcaptcha-login");
                captchaContainer.innerHTML = "";

                hcaptcha.render("hcaptcha-login", {
                    sitekey: "068c87f4-fe34-4f50-9a04-0c488d3aafb4",
                    size: "normal",
                });
            } else {
                console.error("hCaptcha script not loaded.");
            }
        },
        async Login() {
            this.loading = true;
            this.errorMessage = "";
            this.successMessage = "";

            if (!this.email || !this.password) {
                this.errorMessage = "Email and password are required";
                this.loading = false;
                return;
            }

            // Get hCaptcha response
            const captchaResponse = hcaptcha.getResponse();
            if (!captchaResponse) {
                this.errorMessage = "Please complete the CAPTCHA.";
                this.loading = false;
                return;
            }

            try {
                const response = await axios.post("/api/login", {
                    email: this.email,
                    password: this.password,
                    captcha: captchaResponse,
                });

                if (response.data.message === "Login successful") {
                    this.successMessage = response.data.message;
                    window.location.href = response.data.redirect;
                } else {
                    this.errorMessage =
                        response.data.message || "Login failed.";
                }
            } catch (error) {
                this.errorMessage =
                    error.response?.data?.message || "An error occurred.";
            } finally {
                this.loading = false;
            }
        },

        // Handle password reset
        async handleForgotPassword() {
            this.loadingForgot = true;
            this.successMessage = ""; // Clear previous messages
            this.errorMessage = "";

            try {
                const response = await axios.post("/api/password/email", {
                    email: this.forgotEmail,
                });

                // Set success message only if the request is successful
                this.successMessage = "Reset link sent to your email!";
                this.showForgotPassword = false;
            } catch (error) {
                // Display error message
                this.errorMessage = "Unable to send reset link. Try Again";
            } finally {
                this.loadingForgot = false;
            }
        },
        // Open the forgot password modal
        openForgotPasswordModal() {
            this.showForgotPassword = true;
        },

        // Close the modals
        closeModals() {
            this.showForgotPassword = false;
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
