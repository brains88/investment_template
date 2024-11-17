<template>
    <section class="footer" :style="{backgroundColor: 'rgb(85, 43, 170)', color: '#fff', padding: '20px 0'}">
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center text-center">
            <!-- Email Address with Icon -->
            <div class="col-md-auto">
                <p class="mb-0">
                    <i :style="{color: '#ffce28 !important'}" class="fas fa-envelope" ></i> support@equitifytrades.com
                </p>
            </div>
            
            <!-- Physical Address with Icon -->
            <div class="col-md-auto">
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt" :style="{color: '#ffce28 !important'}"></i> Houston, Texas, United State.
                </p>
            </div>
            
            <!-- Copyright and Social Media Links -->
            <div class="col-md-auto">
                <p class="mb-0">
                    &copy; {{ currentYear }} EquitifyTrades. All rights reserved.
                    <!-- Social Media Icons -->
                    <a  class="text-white ml-3">
                        <i class="fab fa-facebook-f" :style="{color: '#ffce28'}"></i>
                    </a>
                    <a  class="text-white ml-3">
                        <i class="fab fa-twitter" :style="{color: '#ffce28'}"></i>
                    </a>
                    <a  class="text-white ml-3">
                        <i class="fab fa-instagram" :style="{color: '#ffce28'}"></i>
                    </a>
                    <a  class="text-white ml-3">
                        <i class="fab fa-linkedin-in" :style="{color: '#ffce28'}"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    data() {
        return {
            currentYear: new Date().getFullYear()
        };
    }
}
</script>
