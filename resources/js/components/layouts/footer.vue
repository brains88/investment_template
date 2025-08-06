<template>
    <section
        class="footer"
        :style="{
            backgroundColor: 'rgb(85, 43, 170)',
            color: '#fff',
            padding: '20px 0',
        }"
    >
        <div class="container">
            <div
                class="row d-flex justify-content-between align-items-center text-center"
            >
                <!-- Email Address with Icon -->
                <div class="col-md-auto">
                    <p class="mb-0" :style="{ fontSize: '12px !important' }">
                        <i
                            :style="{ color: '#ffce28' }"
                            class="fas fa-envelope"
                        ></i>
                        support@equitifytrades.com
                    </p>
                </div>

                <!-- Physical Address with Icon -->
                <div class="col-md-auto">
                    <p class="mb-0" :style="{ fontSize: '12px !important' }">
                        <i
                            class="fas fa-map-marker-alt"
                            :style="{ color: '#ffce28' }"
                        ></i>
                        Australia Square, Level 33/264 George St, Sydney NSW
                        2000, Australia
                    </p>
                </div>

                <!-- Copyright and Social Media Links -->
                <div class="col-md-auto">
                    <p
                        class="mb-0"
                        :style="{ fontSize: '14px !important', color: '#fff' }"
                    >
                        &copy; {{ currentYear }} EquitifyTrades. All rights
                        reserved.
                        <!-- Follow Us Section -->
                        <span
                            class="ml-3"
                            style="font-size: 16px; font-weight: bold"
                        >
                            Follow Us
                            <i class="fas fa-hand-point-right text-warning"></i>
                        </span>
                        <!-- Social Media Icons -->
                        <a
                            href="https://facebook.com"
                            target="_blank"
                            class="text-white ml-2"
                        >
                            <i
                                class="fab fa-facebook-f"
                                :style="{ color: '#ffce28', fontSize: '16px' }"
                            ></i>
                        </a>
                        <a
                            href="https://twitter.com"
                            target="_blank"
                            class="text-white ml-2"
                        >
                            <i
                                class="fab fa-twitter"
                                :style="{ color: '#ffce28', fontSize: '16px' }"
                            ></i>
                        </a>
                        <a
                            href="https://instagram.com"
                            target="_blank"
                            class="text-white ml-2"
                        >
                            <i
                                class="fab fa-instagram"
                                :style="{ color: '#ffce28', fontSize: '16px' }"
                            ></i>
                        </a>
                        <a
                            href="https://linkedin.com"
                            target="_blank"
                            class="text-white ml-2"
                        >
                            <i
                                class="fab fa-linkedin-in"
                                :style="{ color: '#ffce28', fontSize: '16px' }"
                            ></i>
                        </a>
                        <a
                            href=""
                            target="_blank"
                            class="text-white ml-2"
                        >
                            <i
                                class="fab fa-telegram"
                                :style="{ color: '#ffce28', fontSize: '16px' }"
                            ></i>
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
            currentYear: new Date().getFullYear(),
        };
    },
};
</script>
