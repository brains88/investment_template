<template>
  <Navbar />
  <!-- Contact Us Section Begin -->
  <section class="contact-us-section" id="contact-us-section">
    <div class="container">
      <!-- Header Section -->
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="contact-us-text">
            <h2 class="contact-us-subtitle">Get in Touch</h2>
            <p class="contact-us-title-describe">
              Please feel free to contact us through our support center. Simply choose the appropriate support options to send us your questions, concerns and/or feedback. Our customer service team is ready to overcome any issues that might occur.
            </p>
          </div>
        </div>
      </div>
      <!-- Contact Form and Image Section -->
      <div class="row">
        <!-- Image Column -->
        <div class="col-lg-6">
          <div class="contact-img">
            <img :src="'assets/img/contact-us.jpg.jfif'" alt="Contact Us" class="img-fluid">
          </div>
        </div>
        <!-- Form Column with Background -->
        <div class="col-lg-5">
          <div :class="formBgClass" class="contact-form p-4 rounded">
            <form @submit.prevent="submitForm">
              <h2 class="contact-head">Send Us a Message</h2>
              <input v-model="formData.name" type="text" required placeholder="Name *" class="contact-frm form-control mb-3">
              <input v-model="formData.email" type="email" required placeholder="Email *" class="contact-frm form-control mb-3">
              <textarea v-model="formData.message" placeholder="Message *" class="contact-msg form-control mb-3"></textarea>
              <input id="form-submit" type="submit" value="SUBMIT NOW" class="contact-btn btn btn-primary w-100" :disabled="isSubmitting">
              
              <!-- Spinner -->
              <div v-if="isSubmitting" class="spinner-border text-primary mt-3" role="status">
                <span class="visually-hidden" :style="{ color: 'green' }">Loading...</span>
              </div>
              
              <br>
              <br>
              <span class="msgSubmit">{{ responseMessage }}</span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us Section End -->
  <Footer />
</template>
<script>
import Navbar from '@/components/layouts/navbar.vue';
import Footer from '@/components/layouts/footer.vue';
import axios from 'axios';

export default {
  name: 'contact',
  components: {
    Navbar,
    Footer,
  },

  data() {
    return {
      formData: {
        name: '',
        email: '',
        message: ''
      },
      isSubmitting: false, // Controls the spinner
      responseMessage: '' // To show the success or error message after submission
    };
  },

  computed: {
    formBgClass() {
      return {
        'bg-success': this.responseMessage.includes('successfully'), // Success message
        'bg-danger': this.responseMessage.includes('error'), // Error message
        'bg-custom': !this.responseMessage // Default background when no message
      };
    }
  },

  methods: {
    async submitForm() {
      this.isSubmitting = true; // Show the spinner when the form is being submitted
      this.responseMessage = ''; // Reset the response message

      try {
        const response = await axios.post('/api/contact', this.formData); // Replace '/contact' with your API endpoint
        this.responseMessage = 'Your message has been sent successfully!';
        this.formData = { name: '', email: '', message: '' }; // Clear form fields after success
      } catch (error) {
        this.responseMessage = 'There was an error sending your message. Please try again later.';
      } finally {
        this.isSubmitting = false; // Hide the spinner after submission is complete
      }
    }
  },

  mounted() {
    document.title = "Contact | Reach Out to Us.";
  },
};
</script>

<style scoped>
.contact-us-section {
  padding: 60px 0;
}

.contact-us-title {
  font-size: 1.5rem;
  color: #333;
}

.contact-us-subtitle {
  font-size: 2rem;
  color: #222;
}

.contact-us-title-describe {
  font-size: 1rem;
  color: #555;
  margin-top: 15px;
}

.bg-custom {
  background-color: rgb(85, 43, 170);
  color: #fff;
}

.bg-success {
  background-color: #28a745; /* Green for success */
  color: #fff;
}

.bg-danger {
  background-color: #dc3545; /* Red for error */
  color: #fff;
}

.contact-form {
  background-color: rgba(85, 43, 170, 0.1);
  padding: 30px;
  border-radius: 8px;
}

.contact-head {
  font-size: 1.8rem;
  color: #fff;
}

.contact-frm, .contact-msg {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;
}

.contact-btn {
  font-size: 1rem;
  padding: 10px 0;
}

.contact-img img {
  max-width: 100%;
  border-radius: 8px;
}
</style>
