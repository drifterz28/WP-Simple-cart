// JavaScript Document
var currency = {
    "USD": {"code": "USD", "symbol": "$", "name":"US Dollar"},
    "AUD": {"code": "AUD", "symbol": "$", "name":"Australian Dollar"},
    "BRL": {"code": "BRL", "symbol": "$", "name":"Brazilian Real"},
    "CAD": {"code": "CAD", "symbol": "$", "name":"Canadian Dollar"},
    "CZK": {"code": "CZK", "symbol": "Kč", "name":"Czech Koruna"},
    "DKK": {"code": "DKK", "symbol": "DKK", "name":"Danish Krone"},
    "EUR": {"code": "EUR", "symbol": "€", "name":"Euro"},
    "HKD": {"code": "HKD", "symbol": "$", "name":"Hong Kong Dollar"},
    "HUF": {"code": "HUF", "symbol": "Ft", "name":"Hungarian Forint"},
    "ILS": {"code": "ILS", "symbol": "₪", "name":"Israeli New Sheqel"},
    "JPY": {"code": "JPY", "symbol": "¥", "name":"Japanese Yen"},
    "MXN": {"code": "MXN", "symbol": "$", "name":"Mexican Peso"},
    "NOK": {"code": "NOK", "symbol": "NOK", "name":"Norwegian Krone"},
    "NZD": {"code": "NZD", "symbol": "$", "name":"New Zealand Dollar"},
    "PLN": {"code": "PLN", "symbol": "PLN", "name":"Polish Zloty"},
    "GBP": {"code": "GBP", "symbol": "£", "name":"Pound Sterling"},
    "SGD": {"code": "SGD", "symbol": "$", "name":"Singapore Dollar"},
    "SEK": {"code": "SEK", "symbol": "SEK", "name":"Swedish Krona"},
    "CHF": {"code": "CHF", "symbol": "CHF", "name":"Swiss Franc"},
    "THB": {"code": "THB", "symbol": "฿", "name":"Thai Baht"},
    "BTC": {"code": "BTC", "symbol": "BTC", "name":"Bitcoin"}
};

jQuery(function($) {
    $('.payment').on('click',function(){
        var $thisVal = $(this).val();
        $('.payment-settings').hide();
        $('#'+$thisVal).show();
    });

    var currencytype = $('#currencytype').val() || 'USD';
    var symbol = $('#symbol').val();
    $('#currency option[value="'+currencytype+'"]').attr('selected', 'selected');
    if (symbol.length === 0) {
        $('#symbol').val('$');
    }
    $('#currency').on('change', function () {
        var selectedVal = $(this).val();
        $('#currencytype').val(currency[selectedVal].code);
        $('#symbol').val(currency[selectedVal].symbol);
    });
});
