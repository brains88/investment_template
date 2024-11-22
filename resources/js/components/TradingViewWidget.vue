<template>
    <div id="tradingview-widget-container" class="tradingview-widget-container bg-dark">
      <div class="tradingview-widget-container__widget"></div>
      <div class="tradingview-widget-copyright">
      </div>
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      const widgetContainer = document.getElementById("tradingview-widget-container");
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
        console.error("TradingView widget container not found!");
      }
    },
  };
  </script>
  