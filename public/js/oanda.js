
var OANDA = OANDA || {};

OANDA.baseURL = OANDA.baseURL || "https://api-fxpractice.oanda.com";


OANDA.auth = OANDA.auth || {};
OANDA.auth.enabled = OANDA.auth.enabled || false;
OANDA.auth.token = OANDA.auth.token || "";

var setAuthHeader = function(xhr) {
    xhr.setRequestHeader("Authorization", "Bearer " + OANDA.auth.token);
};

var sendAjaxRequest = function(endpoint, method, parameters, requiresAuth, onComplete) {
    var contentType = "";
    if(method === 'POST' || method === 'PUT' || method === 'PATCH') {
        contentType = "application/x-www-form-urlencoded";
    }
    var beforeSend = function() {};
    if(OANDA.auth.enabled && requiresAuth) {
        beforeSend = setAuthHeader;
    }
    var req = $.ajax({
        url: OANDA.baseURL + endpoint,
        type: method,
        dataType: 'json',
        data : parameters,
        contentType: contentType,
        beforeSend: beforeSend,
    });
    req.always(onComplete);
};

/* Send a raw api request on an endpoint.
 */
OANDA.api = function(endpoint, method, parameters, callback) {

    sendAjaxRequest(endpoint, method, parameters, true, function(jqXHR, textResponse) {
        var response = {};
        if(textResponse != 'success') {
            response.error = { 'HTTPCode' : jqXHR.status };
            try {
                var errorJSON = JSON.parse(jqXHR.responseText);
                $.extend(response.error, errorJSON);
            } catch(e) {
            }
        } else {
            response = jqXHR;
        }
        if(callback) {
            callback(response);
        }
    });
};

OANDA.transaction = OANDA.transaction || {};

/*
 * Lists all transactions for a specified account.
 * Accepts optional parameters:
 * maxId      => Number
 * mindId     => Number
 * count      => Number
 * Instrument => String
 *
 */
OANDA.transaction.list = function(accountId, optParameters, callback) {
    //Disallow passing ids parameter (use listSpecific instead).
    if(optParameters.ids) { delete optParameters.ids; }
    OANDA.api("/v1/accounts/" + accountId + "/transactions", 'GET', optParameters, callback);
};

/* List specific transactions by transaction id.
 * Accepts no optional parameters
 */
OANDA.transaction.listSpecific = function(accountId, transId, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/transactions/" + transId, 'GET', {}, callback);
};

OANDA.trade = OANDA.trade || {};

/* List all trade in account.
 * Accepts optional parameters:
 * maxId      => Number
 * count      => Number
 * instrument => Number
 */
OANDA.trade.list = function(accountId, optParameters, callback) {
    if(optParameters.ids) { delete optParameters.ids; }
    OANDA.api("/v1/accounts/" + accountId + "/trades", 'GET', optParameters, callback);
};

/* List specific trades by id.
 * Accepts no optional parameters
 */
OANDA.trade.listSpecific = function(accountId, tradeIds, callback) {
    var tradesStr = tradeIds.join(',');
    OANDA.api("/v1/accounts/" + accountId + "/trades", 'GET', {ids : tradesStr}, callback);
};

/* Close an existing trade
 * Accepts no optional parameters.
 */
OANDA.trade.close = function(accountId, tradeId, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/trades/" + tradeId, 'DELETE', {}, callback);
};

/* Modfify and existing trade
 * Accepts optional parameters:
 *  stopLoss     => number
 *  takeProfit   => number
 *  trailingStop => number
 */
OANDA.trade.change = function(accountId, tradeId, optParameters, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/trades/" + tradeId, 'PATCH', optParameters, callback);
};

OANDA.order = OANDA.order || {};


/* List all orders in account.
 * Accepts optional parameters:
 * maxId      => Number
 * count      => Number
 * Instrument => String
 */
OANDA.order.list = function(accountId, optParameters, callback) {
    if(optParameters.ids) { delete optParameters.ids; }
    OANDA.api("/v1/accounts/" + accountId + "/orders", 'GET', optParameters, callback);
};

/* List specific orders by id.
 * Accepts no optional parameters
 */
OANDA.order.listSpecific = function(accountId, orderIds, callback) {
    var ordersStr = orderIds.join(',');
    OANDA.api("/v1/accounts/" + accountId + "/orders", 'GET', {ids: ordersStr}, callback);
};

/* Create a new order.
 * expiry and price are only required if order type is 'marketIfTouched', 'stop' or 'limit'
 * Accepts optional parameters
 * expiry       => string RFC 3339 format
 * price        => number
 * stopLoss     => number
 * takeProfit   => number
 * trailingStop => number
 * upperBound   => number
 * lowerBound   => number
 */
OANDA.order.open = function(accountId, instrument, units, side, type, optParameters, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/orders", 'POST',
              $.extend({instrument: instrument, units: units, side:side, type:type}, optParameters),
              callback);
};

/* Close an existing order.
 * Accepts no optional parameters
 */
OANDA.order.close = function(accountId, orderId, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/orders/" + orderId, 'DELETE', {}, callback);
};

/* Modify an existing order
 * Accepts optional parameters:
 * units        => number
 * price        => number
 * expiry       => string
 * lowerBound   => number
 * upperBound   => number
 * stopLoss     => number
 * takeProfit   => number
 * trailingStop => number
 */
OANDA.order.change = function(accountId, orderId, optParameters, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/orders/" + orderId, 'PATCH', optParameters, callback);
};

OANDA.position = OANDA.position || {};

/* List all positions
 * Accepts no optional parameters
 */
OANDA.position.list = function(accountId, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/positions", 'GET', {}, callback);
};

/* List only position for specific instrument
 * Accepts no optional parameters
 */
OANDA.position.listSpecific = function(accountId, instrument, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/positions/" + instrument, 'GET' ,{}, callback);
};

/* Close all trades in a positions
 * Accepts no optional parameters
 */
OANDA.position.close = function(accountId, instrument, callback) {
    OANDA.api("/v1/accounts/" + accountId + "/positions/" + instrument, 'DELETE', {}, callback);
};

OANDA.account = OANDA.account || {};

/* Register an account
 * Accepts no optional parameters
 */
OANDA.account.register = function(currency, callback) {
    OANDA.api("/v1/accounts", 'POST', {currency:currency}, callback);
};

/* Get accounts
 * Accepts no optional parameters
 */
OANDA.account.get = function(callback) {
    OANDA.api("/v1/accounts", 'GET', {}, callback);
};

/* List all accounts associated with user
 * Accepts no optional parameters
 */
OANDA.account.list = function(callback) {
    OANDA.api("/v1/accounts", 'GET', {}, callback);
}

/* List specific account details
 * Accepts no optional parameters
 */
OANDA.account.listSpecific = function(accountId, callback) {
    OANDA.api("/v1/accounts/" + accountId, 'GET', {}, callback);
}

OANDA.rate = OANDA.rate || {};

/* List all instruments available.
 * Accepts optional parameters:
 * fields => array of strings
 */
OANDA.rate.instruments = function(accountId, fields, callback) {
    var fieldStr = fields.join(',');
    var data = fieldStr ? { "fields" : fieldStr , "accountId" : accountId} : {};
    OANDA.api("/v1/instruments", 'GET', data, callback);
};

/* Return candlesticks for a specific instrument
 * Accepts optional parameters:
 * granularity  => string
 * count        => number
 * start        => string
 * end          => string
 * candleFormat => string
 * includeFirst => boolean
 */
OANDA.rate.history = function(symbol, optParameters, callback) {
    OANDA.api("/v1/candles", 'GET', $.extend({instrument:symbol}, optParameters), callback);
};

/* Lists the current price for a list of instruments
 * Accepts no optional parameters
 */
OANDA.rate.quote = function(symbols, callback) {
    OANDA.api("/v1/prices", 'GET', {instruments: symbols.join(',')}, callback);
};




/*global jOanda, document, window, rc4decrypt, XMLHttpRequest, ActiveXObject, navigator, console, lrrr_data, lrrr_invert */

jOanda.namespace('widgets').liverates = (function() {

    function QuotePanel(id) {
        this._boxes = {};
    }

    QuotePanel.prototype = {
        DEFAULT_COLOUR: "#666666",

        QUOTE_UPDATE_RATE: 5000,
        // 5 seconds
        ONE_SECOND: 1000,
        // in milliseconds
        FRAMERATE: 200,

        green_pulse: function(curr) {
            var ONE_SECOND = this.ONE_SECOND,
            FRAMERATE = this.FRAMERATE,
            DEFAULT_COLOUR = this.DEFAULT_COLOUR;

            // stop if curr isn't a 6-char string
            // Change to Green
            this.colour_box_elements(curr, '#5bba00');
            // Fade out via five frames over 3.5 seconds
            //   - Full brightness for 2.2 seconds, fade every .4 seconds
            this._timeout_colour(curr, '#5aa911', ONE_SECOND);
            this._timeout_colour(curr, '#599922', ONE_SECOND + FRAMERATE * 6);
            this._timeout_colour(curr, '#688933', ONE_SECOND + FRAMERATE * 8);
            this._timeout_colour(curr, '#688844', ONE_SECOND + FRAMERATE * 10);
            this._timeout_colour(curr, '#688855', ONE_SECOND + FRAMERATE * 12);
            this._timeout_reset(curr, ONE_SECOND + FRAMERATE * 15);
        },
        red_pulse: function(curr) {
            var ONE_SECOND = this.ONE_SECOND,
            FRAMERATE = this.FRAMERATE,
            DEFAULT_COLOUR = this.DEFAULT_COLOUR;

            // stop if curr isn't a 6-char string
            // Change to Green
            this.colour_box_elements(curr, '#e81515');
            // Fade out over 5 frames per two seconds
            this._timeout_colour(curr, '#d82525', ONE_SECOND);
            this._timeout_colour(curr, '#c83535', ONE_SECOND + FRAMERATE * 6);
            this._timeout_colour(curr, '#b84545', ONE_SECOND + FRAMERATE * 8);
            this._timeout_colour(curr, '#a85555', ONE_SECOND + FRAMERATE * 10);
            this._timeout_colour(curr, '#986666', ONE_SECOND + FRAMERATE * 12);
            this._timeout_reset(curr, ONE_SECOND + FRAMERATE * 15);
        },
        _timeout_colour: function(instrument, colour, timeout) {
            window.setTimeout((function(ref) {
                return function() {
                    ref.colour_box_elements(instrument, colour);
                };
            })(this), timeout);
        },
        _timeout_reset: function(instrument, timeout) {
            window.setTimeout((function(ref) {
                return function() {
                    ref._toggle_img(instrument, '');
                    ref.colour_box_elements(instrument, ref.DEFAULT_COLOUR);
                    instrument = null;
                };
            })(this), timeout);
        },
        colour_box_elements: function(curr, colour) {
            var box = this._quote_box(curr),
            colour_element = this.colour_element;

            if (box.buy_float.className == "inline_int") {
                colour_element(box.buy_float, colour);
            }
            if (box.ask_float.className == "inline_int") {
                colour_element(box.ask_float, colour);
            }
            colour_element(box.buy_pip, colour);
            colour_element(box.buy_ette, colour);
            colour_element(box.ask_pip, colour);
            colour_element(box.ask_ette, colour);
            box.imgbg.style.background = colour;
        },
        colour_element: function(element, colour) {
            element.style.color = colour;
        },
        start: function() {
            // Install the timer
            this.timer = window.setInterval((function(ref) {
                return function() {
                    ref.refresh();
                };
            })(this), 5000);

            // refresh the panel
            this.refresh();
        },
        stop: function() {
            // kill the timer
            window.clearInterval(this.timer);

            if (this.request) {
                // stop the request if it is active
                this.request.abort();
            }
            this.request = null;
        },
        // Get an object representing a quote box.
        // Cache the object if it does not exist in cache
        _quote_box: function(instrument) {
            if (!this._boxes[instrument]) {
                this._boxes[instrument] = {
                    buy_float: document.getElementById(instrument + '-b-int'),
                    buy_pip: document.getElementById(instrument + '-b-pip'),
                    buy_ette: document.getElementById(instrument + '-b-ette'),
                    ask_float: document.getElementById(instrument + '-a-int'),
                    ask_pip: document.getElementById(instrument + '-a-pip'),
                    ask_ette: document.getElementById(instrument + '-a-ette'),
                    spread: document.getElementById(instrument + '-spread'),
                    imgbg: document.getElementById(instrument + '-img-div'),
                    imgup: document.getElementById(instrument + '-img-up'),
                    imgdash: document.getElementById(instrument + '-img-dash'),
                    imgdown: document.getElementById(instrument + '-img-down')
                };
            }
            return this._boxes[instrument];
        },
        _toggle_img: function(instrument, mode) {

            var box = this._boxes[instrument];
            box.imgup.className = 'img-up hidden';
            box.imgdash.className = 'img-dash hidden';
            box.imgdown.className = 'img-down hidden';

            if (mode == 'up') {
                box.imgup.className = 'img-up';
            }
            else if (mode == 'down') {
                box.imgdown.className = 'img-down';
            }
            else {
                box.imgdash.className = 'img-dash';
            }
        },

        update: function(rates_json_string) {

            // Ajax response formatting
            var CURR_INDEX = 0,
            BID_INDEX = 1,
            ASK_INDEX = 2,
            SPREAD_INDEX = 4,
            BOUNDARY_INDEX = 5;

            var rates_string = rates_json_string;
            var rates_lines = rates_string.split(/\r\n|\r|\n/);

            for (var x = 0; x < rates_lines.length; x++) {
                var pair_data = rates_lines[x].split("=");
                var animate = true;
                this.process_pair(pair_data, animate);
                if(typeof(lrrr_invert) !== 'undefined' && lrrr_invert != null) {
                    animate = false;

                    // calculate inverse
                    var inverse_curr_array = pair_data[CURR_INDEX].split("/");
                    inverse_curr = inverse_curr_array[1] + "/" + inverse_curr_array[0];
                    pair_data[CURR_INDEX] = inverse_curr;

                    var inverted_bid = this.round(1/pair_data[ASK_INDEX], 5);
                    var inverted_ask = this.round(1/pair_data[BID_INDEX], 5);
                    pair_data[BID_INDEX] = inverted_bid;
                    pair_data[ASK_INDEX] = inverted_ask;

                    this.process_pair(pair_data, animate);
                }
            }
        },
        process_pair: function(pair_data, animate) {
            // Ajax response formatting
            var CURR_INDEX = 0,
            BID_INDEX = 1,
            ASK_INDEX = 2,
            SPREAD_INDEX = 4,
            BOUNDARY_INDEX = 5;

            var curr = pair_data[CURR_INDEX].replace("/", "_").toUpperCase(),
            box = this._quote_box(curr);

            // skip any pairs panel is not configured for
            // skip anything with a spread of 0, clearly data error
            if (!lrrr_data[curr] || !pair_data[SPREAD_INDEX] === 0 || box.buy_pip == null ) {
                return false;
            }

            // Update the spread for the quote-box display (not for inlines)
            if(typeof(box.spread) !== 'undefined' && box.spread != null) {
                box.spread.innerHTML = pair_data[SPREAD_INDEX];
            }

            // Update the innerHTML of the rate display elements
            var p = this.parser(pair_data[BID_INDEX]);
            box.buy_pip.innerHTML = p['pip'];
            box.buy_ette.innerHTML = p['pippette'];
            box.buy_float.innerHTML = p['int'];

            var a = this.parser(pair_data[ASK_INDEX]);
            box.ask_pip.innerHTML = a['pip'];
            box.ask_ette.innerHTML = a['pippette'];
            box.ask_float.innerHTML = a['int'];

            // checking against reserved hash and animate
            if (lrrr_data[curr]['ask'] < pair_data[ASK_INDEX]) {
                if (animate){ this.green_pulse(curr); }
                this._toggle_img(curr, 'up');
            }
            else if (lrrr_data[curr]['ask'] > pair_data[ASK_INDEX]) {
                if (animate){ this.red_pulse(curr);}
                this._toggle_img(curr, 'down');
            } else {
                this._toggle_img(curr, "");
            }

            // update reserved hash
            lrrr_data[curr]['ask'] = pair_data[ASK_INDEX];
            lrrr_data[curr]['bid'] = pair_data[BID_INDEX];
            lrrr_data[curr]['spread'] = pair_data[SPREAD_INDEX];
        },
        parser: function(quote_value) {
            var rt = {};
            var len = quote_value.length;
            rt['pippette'] = quote_value.substring(len - 1);
            rt['pip'] = quote_value.substring(len - 3, len - 1);
            rt['int'] = quote_value.substring(0, len - 3);
            return rt;
        },
        round: function(value, decimals, precision){
            value = Number(value);
            if (precision === undefined) {
                precision = 6;
            }
            var rounded = value.toPrecision(precision);
            rounded = this.stringify(rounded);

            var negative = false;
            if (rounded.substring(0, 1) === '-') {
                negative = true;
                rounded = rounded.substring(1);
            }
            //Compute how many decimal places are being shown in the result
            var decimalPlaces = 0;
            if (rounded.indexOf('.') > -1) {
                decimalPlaces = rounded.length - rounded.indexOf('.') - 1;
            }

            //Re-round if number of decimal places is too great
            if (decimalPlaces > decimals) {
                rounded = this.toFixed(rounded * 1.0, Math.min(decimals, decimalPlaces));
            }

            rounded = this.stringify(rounded);
            if (negative) {
                rounded = '-' + rounded;
            }

            return rounded;
        },
        stringify: function(numString) {
            var whole, decimals, sign, exp;

            var matches = /([0-9]+)\.([0-9]*)e([\-+])(.*)$/.exec(numString);

            if (matches) {
                whole = matches[1];
                decimals = matches[2];
                sign = matches[3];
                exp = matches[4];
            }
            else {
                matches = /([0-9]+)e([\-+])(.*)$/.exec(numString);
                if (matches) {
                    whole = matches[1];
                    decimals = '';
                    sign = matches[2];
                    exp = matches[3];
                }
            }

            var i;
            if (whole) {
                numString = whole + decimals;
                if (sign === '-') {
                    for (i = 0; i < exp - 1; i++) {
                        numString = '0' + numString;
                    }
                    numString = '0.' + numString;
                }
                else {
                    for (i = 0; i < exp - decimals.length; i++) {
                        numString = numString + '0';
                    }
                }
            } else {
                numString += '';
            }

            return numString;
        },
        toFixed: function(value, decimals) {
            var rounded = Math.round(value * Math.pow(10, decimals)) + "";
            if (/\D/.test(rounded)) {
                return "" + value;
            }
            while(rounded.length < 1 + decimals) {
                rounded = '0' + rounded;
            }
            var diff = (rounded.length - decimals);
            var start = rounded.substring(0, diff);
            var end = rounded.substring(diff);

            if(end) {
              end = "." + end;
            }

            return start + end;
        },
        XHR: function() {
            var xmlhttp;

            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            return xmlhttp;
        },
        refresh: function() {
            var tstamp = new Date().getTime(),
            request = this.request;

            // If we have a live request that isn't finised abort the refresh
            // IE6 may be in readyState 0 on completion
            if (request && request.readyState !== 4 && request.readyState !== 0) {
                return;
            }
            request = new this.XHR();
            this.request = request;

            request.onreadystatechange = (function(ref) {

                return function() {
                    var request = ref.request;
                    if (request.readyState == 4 && request.status == 200) {
                        try {
                            ref.update(rc4decrypt(request.responseText));
                        } catch(err) {
                            ref.stop();
                            if (typeof(console) != "undefined") {
                                console.log("Quote-Panel stopped: "+err.message);
                            }
                        }

                        if (request.async) {
                            ref.request = null; //Memory cleanup for IE
                        }
                    }
                };
            })(this);

            // Negate browsers from caching the ajax request
            // Build url GET params from lrrr variables
            var ajax_rates_url = '/lfr/rates_lrrr';
            ajax_rates_url += '?tstamp=' + tstamp;

            request.open("GET", ajax_rates_url, true);
            request.send(""); //empty string fix for FF
        }
    }
    /* end cronjob functions */
    return QuotePanel;
})();

jOanda.onready(function() {
    if(typeof(lrrr_mount) !== 'undefined' && lrrr_mount != null) {
        quotepanel = new jOanda.widgets.liverates();
        // default start the quote panel
        quotepanel.start();
    }
});

function inline_hover(thing){
    thing.className += " inline_hover ";
}
function inline_hover_out(thing){
    thing.className = "rate_row";
}
function inline_click(thing){
    var children = thing.getElementsByTagName('a');
    var url = children[0].href;
    window.location = ( url);
}

/* Transformed JS from: /jslib/rc4.js */
var key = "aaf6cb4f0ced8a211c2728328597268509ade33040233a11af";

function hexEncode(e) {
    var d = "0123456789abcdef",
        b = [],
        a = [],
        c;
    for (c = 0; c < 256; c++) {
        b[c] = d.charAt(c >> 4) + d.charAt(c & 15)
    }
    for (c = 0; c < e.length; c++) {
        a[c] = b[e.charCodeAt(c)]
    }
    return a.join("")
}

function hexDecode(f) {
    var e = "0123456789abcdef",
        b = [],
        a = [],
        c = 0,
        d;
    for (d = 0; d < 256; d++) {
        b[e.charAt(d >> 4) + e.charAt(d & 15)] = String.fromCharCode(d)
    }
    if (!f.match(/^[a-f0-9]*$/i)) {
        return false
    }
    if (f.length % 2) {
        f = "0" + f
    }
    for (d = 0; d < f.length; d += 2) {
        a[c++] = b[f.substr(d, 2)]
    }
    return a.join("")
}

function rc4(e, g) {
    var b = 0,
        d, a, h, f = [],
        c = [];
    for (d = 0; d < 256; d++) {
        f[d] = d
    }
    for (d = 0; d < 256; d++) {
        b = (b + f[d] + e.charCodeAt(d % e.length)) % 256;
        a = f[d];
        f[d] = f[b];
        f[b] = a
    }
    d = 0;
    b = 0;
    for (h = 0; h < g.length; h++) {
        d = (d + 1) % 256;
        b = (b + f[d]) % 256;
        a = f[d];
        f[d] = f[b];
        f[b] = a;
        c[c.length] = String.fromCharCode(g.charCodeAt(h) ^ f[(f[d] + f[b]) % 256])
    }
    return c.join("")
}

function rc4decrypt(a) {
    return rc4(key, hexDecode(a))
};

<div class="rate_row" onmouseover="inline_hover(this)" onmouseout="inline_hover_out(this)" onclick="inline_click(this)">
<div class="inline title left">
<a href="/currency/live-exchange-rates/EURUSD" class="primary">EUR/USD</a>
</div>
<div class="inline value right">
<span id="EUR_USD-a-int" class="inline_int" style="color: rgb(102, 102, 102);">1.12</span><span id="EUR_USD-a-pip" class="pip" style="color: rgb(102, 102, 102);">58</span><span id="EUR_USD-a-ette" class="inline_pipette" style="color: rgb(102, 102, 102);">8</span>
</div>
<div class="inline value right">
<span id="EUR_USD-b-int" class="inline_int" style="color: rgb(102, 102, 102);">1.12</span><span id="EUR_USD-b-pip" class="pip" style="color: rgb(102, 102, 102);">57</span><span id="EUR_USD-b-ette" class="inline_pipette" style="color: rgb(102, 102, 102);">6</span>
</div>
<div class="inline arrow right">
<div id="EUR_USD-img-div" class="quote-image" style="background: rgb(102, 102, 102);">
<div id="EUR_USD-img-down" class="img-down hidden"></div>
<div id="EUR_USD-img-dash" class="img-dash"></div>
<div id="EUR_USD-img-up" class="img-up hidden"></div>
</div>
</div>
<div class="clear"></div>
<div class="inline title left">
<a>USD/EUR</a>
</div>
<div class="inline value right">
<span id="USD_EUR-a-int" class="inline_int">0.88</span><span id="USD_EUR-a-pip" class="pip">82</span><span id="USD_EUR-a-ette" class="inline_pipette">9</span>
</div>
<div class="inline value right">
<span id="USD_EUR-b-int" class="inline_int">0.88</span><span id="USD_EUR-b-pip" class="pip">81</span><span id="USD_EUR-b-ette" class="inline_pipette">9</span>
</div>
<div class="inline arrow right">
<div id="USD_EUR-img-div" class="quote-image">
<div id="USD_EUR-img-down" class="img-down hidden"></div>
<div id="USD_EUR-img-dash" class="img-dash hidden"></div>
<div id="USD_EUR-img-up" class="img-up"></div>
</div>
</div>
<div class="clear"></div>
</div>