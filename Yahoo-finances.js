Yahoo finance currency, Yahoo waluty, Yahoo pary walutowe.

Yahoo finance json link:
https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22GBPJPY%22%2C%22EURUSD%22%2C%22USDJPY%22%2C%22JPYGBP%22%2C%22BBBppp%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=
http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20%28%22GBPJPY%22,%22USDEUR%22,%20%22USDJPY%22,%20%22USDBGN%22,%20%22USDCZK%22,%20%22USDDKK%22,%20%22USDGBP%22,%20%22USDHUF%22,%20%22USDLTL%22,%20%22USDLVL%22,%20%22USDPLN%22,%20%22USDRON%22,%20%22USDSEK%22,%20%22USDCHF%22,%20%22USDNOK%22,%20%22USDHRK%22,%20%22USDRUB%22,%20%22USDTRY%22,%20%22USDAUD%22,%20%22USDBRL%22,%20%22USDCAD%22,%20%22USDCNY%22,%20%22USDHKD%22,%20%22USDIDR%22,%20%22USDILS%22,%20%22USDINR%22,%20%22USDKRW%22,%20%22USDMXN%22,%20%22USDMYR%22,%20%22USDNZD%22,%20%22USDPHP%22,%20%22USDSGD%22,%20%22USDTHB%22,%20%22USDZAR%22,%20%22USDISK%22%29&format=json&env=store://datatables.org/alltableswithkeys
http://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote

links:
https://greenido.wordpress.com/2009/12/22/yahoo-finance-hidden-api/
http://www.jarloo.com/yahoo_finance/

Graph:
http://chart.finance.yahoo.com/z?s=GBPJPY=X&t=1d&q=l&l=on&z=s&p=m50,m200
http://stackoverflow.com/questions/9807353/getting-stock-graphs-from-yahoo-finance

Console:
https://developer.yahoo.com/yql/console/?q=show%20tables&env=store://datatables.org/alltableswithkeys#h=select+*+from+yahoo.finance.xchange+where+pair+in+%28%22GBPJPY%22%2C%22EURUSD%22%2C%22USDJPY%22%2C%22JPYGBP%22%2C%22BBBppp%22%29

YQL:
select * from yahoo.finance.xchange where pair in ("GBPJPY","EURUSD","USDJPY","JPYGBP","XXXYYY")


<script type="text/javascript">
//from https://gist.github.com/henrik/265014
  function getRate(from, to) {
    var script = document.createElement('script');
    script.setAttribute('src', "http://query.yahooapis.com/v1/public/yql?q=select%20rate%2Cname%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes%3Fs%3D"+from+to+"%253DX%26f%3Dl1n'%20and%20columns%3D'rate%2Cname'&format=json&callback=parseExchangeRate");
    document.body.appendChild(script);
  }
  function parseExchangeRate(data) {
    var name = data.query.results.row.name;
    var rate = parseFloat(data.query.results.row.rate, 10);
    alert("Exchange rate " + name + " is " + rate);
  }
  
  getRate("SEK", "USD");
  getRate("USD", "SEK");
  
</script>

// Or commercial currency api: https://currencylayer.com/ and https://openexchangerates.org/
