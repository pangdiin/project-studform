(function ($) {
    $.fn.liveOrders = function (options) {
        // Render options
        var vars = {
            timer: null,
            request: null,

            DEFAULT_COLOUR: "#fff",

            QUOTE_UPDATE_RATE: 5000,
            // 5 seconds
            ONE_SECOND: 1000,
            // in milliseconds
            FRAMERATE: 200,

            // Initial Lists
            orders: [],
            newOrders: [],

            // Selected Currency
            current_rate : 0

        };
        var templates = {
            empty  : `<tr><td colspan="10"><div class="text-center">No results.</i></div></td></tr>`,
            overlay: `<tr class="overlay"><td colspan="10"><div class="text-center"><i class="fa fa-3x fa-refresh fa-spin"></i></div></td></tr>`
        };

        var settings = $.extend({
            type: 'import',
            linkURL: null,
            live_currency: {
                currency:       'USD',
                amount:         '[name=amount]',
                entry_rate:     '.entry-rate',
                market_value:   '.market-value',
            }

        }, options);

        // Box

        function green_pulse(el) 
        {
            var ONE_SECOND = vars.ONE_SECOND,
            FRAMERATE = vars.FRAMERATE,
            DEFAULT_COLOUR = vars.DEFAULT_COLOUR;

            // stop if el isn't a 6-char string
            // Change to Green
            colour_element(el, '#5bba00');
            // Fade out via five frames over 3.5 seconds
            //   - Full brightness for 2.2 seconds, fade every .4 seconds
            _timeout_colour(el, '#5aa911', ONE_SECOND);
            _timeout_colour(el, '#599922', ONE_SECOND + FRAMERATE * 6);
            _timeout_colour(el, '#688933', ONE_SECOND + FRAMERATE * 8);
            _timeout_colour(el, '#688844', ONE_SECOND + FRAMERATE * 10);
            _timeout_colour(el, '#688855', ONE_SECOND + FRAMERATE * 12);
            _timeout_reset(el, ONE_SECOND + FRAMERATE * 15);
        }
        function red_pulse(el) 
        {
            var ONE_SECOND = vars.ONE_SECOND,
            FRAMERATE = vars.FRAMERATE,
            DEFAULT_COLOUR = vars.DEFAULT_COLOUR;

            // stop if el isn't a 6-char string
            // Change to Green
            colour_element(el, '#e81515');
            // Fade out over 5 frames per two seconds
            _timeout_colour(el, '#d82525', ONE_SECOND);
            _timeout_colour(el, '#c83535', ONE_SECOND + FRAMERATE * 6);
            _timeout_colour(el, '#b84545', ONE_SECOND + FRAMERATE * 8);
            _timeout_colour(el, '#a85555', ONE_SECOND + FRAMERATE * 10);
            _timeout_colour(el, '#986666', ONE_SECOND + FRAMERATE * 12);
            _timeout_reset(el, ONE_SECOND + FRAMERATE * 15);
        }
        function colour_element(el, colour) 
        {
            el.css('background', colour);
            el.css('font-weight', 'bold');
        }

        function  _timeout_colour(el, colour, timeout) 
        {
            window.setTimeout((function(ref) {
                return function() {
                    colour_element(el, colour)
                };
            })(this), timeout);
        }
        function _timeout_reset(el, timeout) {
            window.setTimeout((function(ref) {
                return function() {
                    el.css('background', vars.DEFAULT_COLOUR);
                    el.css('font-weight', 'normal');
                    el.find('i').removeClass('fa-arrow-up');
                    el.find('i').removeClass('fa-arrow-down');
                    el.find('i').addClass('fa-minus');
                };
            })(this), timeout);
        }

        function _process_item(el, item) 
        {
            var prev_order = searchOrder(item);

            var item_currency = (item.base_currency + `/` + item.currency);
            var market_value   = (item.rate * item.amount).toFixed(4);
            // var exchange_risk  = (item.rate * item.amount) - (item.amount * item.entry_rate);
            var exchange_rate = ((((item.entry_rate * item.amount) - (item.rate * item.amount)) / (item.entry_rate * item.amount)) * 100).toFixed(4);
            // var exchange_rate = (item.amount / ( item.amount - (item.amount * item.entry_rate) )).toFixed(4);

            // var exchange_rate  = 
            var market_arrow    = 'fa fa-minus';
            var market_color    = '';

            var exchange_arrow    = 'fa fa-minus';
            var exchange_color    = '';
            if(prev_order){
                if(market_value > prev_order.market.rate){
                    market_arrow = 'fa fa-arrow-up';
                    market_color = 'success';
                }else if(market_value < prev_order.market.rate){
                    market_arrow = 'fa fa-arrow-down';
                    market_color = 'danger';
                }else{
                    market_arrow = 'fa fa-minus';
                    market_color = 'default';
                }
                // Exchange
                if(exchange_rate > prev_order.exchange.rate){
                    exchange_arrow = 'fa fa-arrow-up';
                    exchange_color = 'success';

                }else if(exchange_rate < prev_order.exchange.rate){
                    exchange_arrow = 'fa fa-arrow-down';
                    exchange_color = 'danger';
                }else{
                    exchange_arrow = 'fa fa-minus';
                    exchange_color = 'default';
                }
            }

            var order = {
                id:             item.id,
                order_number:   item.order_number,
                pair:           item_currency,  
                base_currency:  item.base_currency,  
                currency:       item.currency,  
                start_date:     item.start_date,
                end_date:       item.end_date,
                entry_rate:     item.entry_rate,
                exit_rate:      item.exit_rate,
                isExpired:      item.isExpired,
                amount:         item.amount,
                market: {
                    rate:       market_value,
                    arrow:      market_arrow,
                    color:      market_color,
                },
                exchange: {
                    rate:       exchange_rate,
                    arrow:      exchange_arrow,
                    color:      exchange_color,
                },
            };


            _display_item(el, order);


            if(prev_order){
                replaceOrder(order);
            }else{
                vars.orders.push(order);
            }

        }

        function _display_item(el, item) 
        {
            var linkURL = window.location.origin + '/order/' + settings.type + '/';

            var delBtn = (item.isExpired ? 
                `` : `<a name="btn_delete" class="btn btn-danger btn-flat btn-xs" href="`+ linkURL  + 'delete/' + item.id +`" ><i class="fa fa-trash"></i></a>`
                );

            var editBtn = (item.isExpired ? 
                `` : `<button name="btn_edit" class="btn_order_edit btn btn-primary btn-flat btn-xs" data-id="`+ item.id +`" data-link="`+ linkURL  + 'update/' + item.id +`"  data-toggle="modal" href="#modal-form" ><i class="fa fa-pencil"></i></button>`
                );

            var template = `
                <tr id="order-item-` + item.id + `" class="order-item">
                    <td>` + item.order_number + `</td>
                    <td>` + item.pair + `</td>
                    <td>` + item.start_date + `</td>
                    <td>` + item.end_date + `</td>
                    <td>` + `<label class="label text-left label-primary">` + item.base_currency + `</label> <strong><span class="text-primary pull-right">` + item.entry_rate.toFixed(4)     + `</span></strong></td>
                    <td>` + `<label class="label text-left label-success">` + item.currency + `</label> <strong><span class="text-success pull-right">` + (item.amount).toFixed(4)     + `</span></strong></td>
                    <td class="clearfix market   text-right " style="transition: 3s;"><i class="pull-left `+ item.market.arrow   +`"></i>` + item.market.rate   + `</td>
                    <td class="clearfix exchange text-right " style="transition: 3s;"><i class="pull-left `+ item.exchange.arrow +`"></i>` + item.exchange.rate + `</td>
                    <td>
                        <a class="btn btn-info btn-flat btn-xs btn-view" href="`+ linkURL  + 'show/' + item.id +`" ><i class="fa fa-search"></i></a>
                        `+ editBtn +`
                        `+ delBtn +`
                    </td>
                </tr>
            `;
            el.append(template);

            var market   = el.find('#order-item-' + item.id).find('.market');
            var exchange = el.find('#order-item-' + item.id).find('.exchange');
          
            if(item.market.color == "success"){
                green_pulse(market);
            }else if(item.market.color == "danger"){
                red_pulse(market);
            }else{
                // _timeout_reset(market, vars.ONE_SECOND + vars.FRAMERATE * 15);
            }


            if(item.exchange.color == "success"){
                green_pulse(exchange);
            }else if(item.exchange.color == "danger"){
                red_pulse(exchange);
            }else{
                // _timeout_reset(exchange, vars.ONE_SECOND + vars.FRAMERATE * 15);
            }



        }


        // Process 
        function start(el)
        {
            el.html(templates.overlay);
            vars.timer = window.setInterval((function(ref) {
                return function() {
                    refresh(el);
                };
            })(this), 5000);

            // refresh the panel
            refresh(el);
        };

        function stop(el) 
        {
            window.clearInterval(vars.timer);
            if (vars.request) {
                // stop the request if it is active
                vars.request.abort();
            }
            vars.request = null;
        };

        function refresh(el, force) 
        {
            var tstamp = new Date().getTime();
            var currency = $('body').find(settings.live_currency.currency).val();
            // If we have a live request that isn't finised abort the refresh
            // IE6 may be in readyState 0 on completion
            if(vars.request && force == false){
                return;
            }
            vars.request = $.ajax({
                url: settings.linkURL,
                data: { 
                    timestamp: tstamp, 
                    currency: currency
                },
                dataType: 'json',
                type: 'POST',
                async: false,
                success: function(response){
                    vars.request = null;
                    update(el, response);

                    
                },
                error: function(response){
                    vars.request = null;
                    refresh(el);
                }
            });            
        };

        function update(el, data) 
        {
            // Ajax response formatting
            vars.newOrders = data; 
            el.empty();
            if(data.length > 0){
                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    _process_item(el, item);
                }
            }else{
                el.html(templates.empty);
                stop(el);
            }
        }

        // Helper
        function searchOrder(order) 
        {
            for (var i = 0; i < vars.orders.length; i++) {
                var item = vars.orders[i];
                if(item.id == order.id){
                    return item;
                }
            }
            return null;
        }

        function replaceOrder(order) 
        {
            for (var i = 0; i < vars.orders.length; i++) {
                var item = vars.orders[i];
                if(item.id == order.id){
                    vars.orders[i] = order;
                }
            }
            return null;
        }

        function editModal(el) 
        {
            el.on('click', '.btn_order_edit', function(e){
                var linkURL = $(this).attr('data-link');

                var id = $(this).attr('data-id');
                // var id = $('[name=x_order_id]').val();
                var order = null; 
                for (var i = vars.newOrders.length - 1; i >= 0; i--) {
                    var item = vars.newOrders[i];
                    if(item.id == id){
                        order = item;
                    }
                }

                $('[name=order_number]').val(order.order_number);
                $('select[name=currency]').val(order.currency);
                $('[name=due_date]').val(order.due_date2);
                $('[name=amount]').val(order.amount);
                $('.entry-rate').html(order.entry_rate.toFixed(4));
                $('#entry-rate-currency').html(order.currency);
                
                $('[name=patch_link]').val(linkURL);
                $('[name=btn_submit]').attr('data-link', linkURL);
            });
        }

        //  Return
        return this.each(function () {
            var el = $(this);
            start(el);
            $('body').on('click', '.btn-view', function(){
                if(vars.request){
                    vars.request.abort();
                }
            });
            editModal(el);

        });

    };
})(jQuery);
