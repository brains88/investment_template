<template>
  <div>
    <!-- Ticker-Tape Widget -->
    <div id="tradingview-widget-container-ticker" class="tradingview-widget-container bg-dark">
      <div class="tradingview-widget-container__widget"></div>
    </div>

    <!-- News Widget -->
    <div id="tradingview-widget-container-news" class="tradingview-widget-container mt-3">
      <div class="tradingview-widget-container__widget"></div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // Initialize the Ticker-Tape widget
    this.initTickerTapeWidget();

    // Initialize the News widget
    this.initNewsWidget();
  },
  methods: {
    initTickerTapeWidget() {
      const widgetContainer = document.getElementById("tradingview-widget-container-ticker");
      if (widgetContainer) {
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js";
        script.async = true;

        script.innerHTML = JSON.stringify({
          symbols: [
            { proName: "FOREXCOM:SPXUSD", title: "S&P 500" },
            { proName: "FOREXCOM:NSXUSD", title: "US 100" },
            { proName: "FX_IDC:EURUSD", title: "EUR/USD" },
            { proName: "BITSTAMP:BTCUSD", title: "Bitcoin" },
            { proName: "BITSTAMP:ETHUSD", title: "Ethereum" },
          ],
          showSymbolLogo: false,
          colorTheme: "dark",
          isTransparent: true,
          displayMode: "adaptive",
          locale: "en",
        });

        widgetContainer.appendChild(script);
      } else {
        console.error("Ticker-Tape widget container not found!");
      }
    },
    initNewsWidget() {
      const widgetContainer = document.getElementById("tradingview-widget-container-news");
      if (widgetContainer) {
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js"; // Correct script for news feed
        script.async = true;

        script.innerHTML = JSON.stringify({
          colorTheme: "dark",  // Match the theme with ticker tape
          width: "100%",
          height: 400,
          autosize: true,
          locale: "en",
          largeChartUrl: "", // No large chart
          isTransparent: true,
          showSymbolLogo: true,
          tabs: [
            {
              title: "News",
              symbols: [
                { s: "FOREXCOM:GBPJPY" },
                { s: "FX_IDC:EURUSD" },
                { s: "BITSTAMP:BTCUSD" },
                { s: "FOREXCOM:SPXUSD" },
              ],  // Add multiple symbols for different news sources
              originalTitle: "News",
            },
          ],
        });

        widgetContainer.appendChild(script);
      } else {
        console.error("News widget container not found!");
      }
    },
  },
};
</script>

<style scoped>
.tradingview-widget-container {
  border: 1px solid #333;
  border-radius: 8px;
}
</style>
