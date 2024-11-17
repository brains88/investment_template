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
            <div class="contact-form bg-custom p-4 rounded">
              <form id="contactForm" method="post">
                <h2 class="contact-head">Send Us a Message</h2>
                <input type="text" name="name" required placeholder="Name *" class="contact-frm form-control mb-3">
                <input type="email" name="email" required placeholder="Email *" class="contact-frm form-control mb-3">
                <textarea name="message" id="message" placeholder="Message *" class="contact-msg form-control mb-3"></textarea>
                <input id="form-submit" type="submit" value="SUBMIT NOW" class="contact-btn btn btn-primary w-100">
                <br>
                <br>
                <span class="msgSubmit"></span>
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
  
  export default {
    name: 'contact',
    components: {
      Navbar,
      Footer,
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
  