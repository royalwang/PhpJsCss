Yahoo finance currency, Yahoo waluty, Yahoo pary walutowe.

Yahoo finance json link:
https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22GBPJPY%22%2C%22EURUSD%22%2C%22USDJPY%22%2C%22JPYGBP%22%2C%22BBBppp%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=

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
