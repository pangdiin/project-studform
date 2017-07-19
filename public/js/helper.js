$(window).on('load', function () {
    // Scroll to top on page refresh
    $('body').removeClass('processing-page-load').animate({ scrollTop: 0 }, 800);
    // Show the main wrapper when the page is fully loaded
    $('.main-wrapper').fadeTo(500, 1);
    // Remove page loading when the page is fully loaded
    $('.page-loading').hide();
});
$(document).ready(function(){
  
    $("body").on("click", "a[name='btn_delete']", function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        var linkRedirect = $(this).attr("data-redirect");
        swal({
            title: "Are you sure you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(isConfirmed){
            if(isConfirmed){
                ajaxSwal('DELETE', linkURL);
            }
        });
    });

    $("body").on("click", "a[name='btn_restore']", function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        var linkRedirect = $(this).attr("data-redirect");
        swal({
            title: "Are you sure you?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Restore",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(isConfirmed){
            if(isConfirmed){
                ajaxSwal('PATCH', linkURL, linkRedirect);
            }
        });
    });

    $("body").on("click", "a[name='btn_force']", function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        var linkRedirect = $(this).attr("data-redirect");
        swal({
            title: "Are you sure you want to delete this item permanently?",
            text: " Anywhere in the application that references this item will most likely error. Proceed at your own risk. This can not be un-done.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(isConfirmed){
            if(isConfirmed){
                ajaxSwal('DELETE', linkURL, linkRedirect);
            }
        });
    });
});
    
function ajaxSwal(type, linkURL, linkRedirect) 
{
    swalLoader();
    $.ajax({
        url: linkURL,
        type: type,
        dataType: 'json',
        data: {},
        success: function(data){
            swalSuccess(data.message, function(){
                if(linkRedirect != null && linkRedirect != "undefined"){
                    location.href = linkRedirect;
                }
            });
        },
        error: function(data){
            swalError(data.message);
        }
    });
}


function reload() 
{
    location.reload();
    $('body').addClass('processing-page-load').animate({ scrollTop: 0 }, 800);
    $('.main-wrapper').fadeTo(500, 0);
    $('.page-loading').show();
}

function renderLabels(data)
{
    return '<span class="label label-'+ data.type +'">'+ data.label +'</span>';
} 

function renderImage(data)
{
    return '<img class="img-responsive img-thumbnail" src="'+ data +'"/>';
} 

function renderActions(data) 
{
    var actions = `
        <div class="btn-group">
             <button type="button" class="btn btn-flat btn-xs bg-olive dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cogs"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
    `;
    for (var i = 0; i < data.length; i++) {
        var action = '';
        var link = data[i];
        if(link.type == "show"){
            action = `<li ><a class="text-primary" name="btn_show" href="`+ link.link +`"><i class="fa fa-search"></i> View</a></li>`;
        }else if(link.type == "edit"){
            action = `<li ><a class="text-warning" name="btn_edit" href="`+ link.link +`"><i class="fa fa-pencil"></i> Edit</a></li>`;
        }else if(link.type == "update"){
            action = `<li ><a class="text-warning" name="btn_update" href="`+ link.link +`"><i class="fa fa-pencil"></i> Edit</a></li>`;
        }else if(link.type == "delete"){
            action = `<li ><a class="text-danger" name="btn_delete" href="`+ link.link +`"><i class="fa fa-trash"></i> Delete</a></li>`;
        }else if(link.type == "restore"){
            action = `<li ><a class="text-info" name="btn_restore" href="`+ link.link +`"><i class="fa fa-refresh"></i> Restore</a></li>`;
        }else if(link.type == "force"){
            action = `<li ><a class="text-danger" name="btn_force" href="`+ link.link +`"><i class="fa fa-trash"></i> Force Delete</a></li>`;
        }else{
            action = `<li ><a class="`+ link.class +`" name="`+ link.name +`" href="`+ link.link +`"><i class="`+ link.icon +`"></i> `+ link.label +`</a></li>`;
        }
        actions += action;
    }
    actions += `</ul></div>`;

    return actions;
}

function renderRawActions(data) 
{
    var actions = `
    `;
    for (var i = 0; i < data.length; i++) {
        var action = '';
        var link = data[i];
        if(link.type == "show"){
            action = `<a class="btn btn-xs btn-primary btn-flat" name="btn_show" href="`+ link.link +`"><i class="fa fa-search"></i> </a>`;
        }else if(link.type == "edit"){
            action = `<a class="btn btn-xs btn-info btn-flat" name="btn_edit" href="`+ link.link +`"><i class="fa fa-pencil"></i> </a>`;
        }else if(link.type == "update"){
            action = `<a class="btn btn-info btn-flat btn-xs" name="btn_update" href="`+ link.link +`"><i class="fa fa-pencil"></i> </a>`;
        }else if(link.type == "delete"){
            action = `<a class="btn btn-danger btn-flat btn-xs" name="btn_delete" href="`+ link.link +`"><i class="fa fa-trash"></i> </a>`;
        }else if(link.type == "restore"){
            action = `<a class="btn btn-info btn-flat btn-xs" name="btn_restore" href="`+ link.link +`"><i class="fa fa-refresh"></i> </a>`;
        }else if(link.type == "force"){
            action = `<a class="btn btn-danger btn-flat btn-xs" name="btn_force" href="`+ link.link +`"><i class="fa fa-trash"></i></a>`;
        }else{
            action = `<a class="`+ link.class +`" name="`+ link.name +`" href="`+ link.link +`" data-toggle="tooltip" data-placement="left" title="`+ link.tooltip +`"><i class="`+ link.icon +`"></i></a>`;
        }
        actions += action;
    }
    return actions;
}

function withProfileImage (opt) {
    if (!opt.id) {
        return opt.text;
    }               
    var optimage = $(opt.element).data('image'); 
    if(!optimage){
        return opt.text;
    } else {                    
        var $opt = $(
            '<div class="clearfix"><img src="' + optimage + '" class="img-responsive pull-left" width="25px; margin-right: 10px;"/>  ' + opt.text + '</div>'
        );
        return $opt;
    }

};


/**
 * Works same as array_get function of Laravel
 * @param array
 * @param key
 * @returns {*}
 */
var array_get = function (array, key, defaultValue) {
    "use strict";

    if (typeof defaultValue === 'undefined') {
        defaultValue = null;
    }

    var result;

    try {
        result = array[key];
    } catch (err) {
        result = defaultValue;
    }

    if(result === null) {
        result = defaultValue;
    }

    return result;
};

/**
 * Get the array/object length
 * @param array
 * @returns {number}
 */
var array_length = function (array) {
    "use strict";

    return _.size(array);
};

/**
 * Get the first element.
 * Passing n will return the first n elements of the array.
 * @param array
 * @param n
 * @returns {*}
 */
var array_first = function (array, n) {
    "use strict";

    return _.first(array, n);
};

/**
 * Get the first element.
 * Passing n will return the last n elements of the array.
 * @param array
 * @param n
 * @returns {*}
 */
var array_last = function (array, n) {
    "use strict";

    return _.last(array, n);
};

/**
 * Works same as dd function of Laravel
 */
var dd = function () {
    "use strict";
    console.log.apply(console, arguments);
};

/**
 * Json encode
 * @param object
 */
var json_encode = function (object) {
    "use strict";
    if (typeof object === 'undefined') {
        object = null;
    }
    return JSON.stringify(object);
};

/**
 * Json decode
 * @param jsonString
 * @returns {*}
 */
var json_decode = function (jsonString, defaultValue) {
    "use strict";
    if (typeof jsonString === 'string') {
        var result;
        try {
            result = $.parseJSON(jsonString);
        } catch (err) {
            result = defaultValue;
        }
        return result;
    }
    return jsonString;
};

var swalLoader = function(message) {
    if(message == ""){
        message = "Please wait while we send your request.";
    }
    swal({  
        title: 'Loading...', 
        text: message,
        imageUrl: window.location.origin + "/img/ring.gif", 
        animation: false,
        showConfirmButton: false,
        allowOutsideClick: false
    });
};

var swalError = function(message, callback){
    swal({  
        title: 'Failed', 
        type: 'error',
        text: message,
        closeOnConfirm: true,
    }).then(function(){
    
    }, function(dismiss){
        if(dismiss == 'close'){
            if(callback)
                callback();
        }
    });
};

var swalSuccess = function(message, callback){
    swal({  
        title: 'Success', 
        type: 'success',
        text: message,
    }).then(function(){
        reload();
        
    }, function(dismiss){
        if(dismiss == 'close'){
            if(callback)
                callback();

            reload();
        }
    });
};

function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function resetForm() 
{
    $('.form-group').removeClass('has-error');
    $('.form-group').find('.help-block').empty();
}

function displayError(el, errors) 
{
    if(errors && errors.length > 0){
        el.addClass('has-error');
        el.find('.help-block').empty();

        for (var i = 0; i < errors.length; i++) {
            var error = errors[i];
            el.find('.help-block').append('<strong>' + error + '</strong><br>');
        }
    }
}




(function ($) {

    $.fn.boxStoreForm = function (options) {

        // Render options
        var settings = $.extend({
            // Form
            source: '',
            // Triger
            trigger: '[name=btn_store]',

            // Image
            image: false,

            //Callbacks
            onLoadStart: function (box) {
            }, //Right after the button has been clicked
            onLoadDone: function (box) {
            }, //When the source has been loaded
            onErrorDone: function (box) {
            } //When error has occured

        }, options);

        //The overlay
        var overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');

        return this.each(function () {
            //if a source is specified
            if (settings.source === '') {
                if (console) {
                    console.log('Please specify a source first - boxStoreForm()');
                }
                return;
            }
            //the box
            var box = $(this);
            //the button
            var rBtn = box.find(settings.trigger).first();

            //On trigger click
            rBtn.on('click', function (e) {
                e.preventDefault();
                //Add loading overlay
                start(box);
                // console.log(this.getFormData(box));
                // //Perform ajax call
                if(settings.image == true){
                    var formData = new FormData(box[0]);

                    $.ajax({
                        url: settings.source,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success:function(data){
                            done(box);
                        },
                        error: function(data){
                            errorDone(box);
                        }
                    });   


                }else{
                    $.ajax({
                        url: settings.source,
                        type: 'POST',
                        data: box.serialize(),
                        success:function(data){
                            done(box);
                        },
                        error: function(data){
                            errorDone(box);
                        }
                    });    
                }

                
            });
        });

        function start(box) {
            //Add overlay and loading img
            box.append(overlay);
            box.find('.box-error ').remove();

            settings.onLoadStart.call(box);
        }

        function done(box) {
            //Remove overlay and loading img
            box.find(overlay).remove();
            if(settings.image == true){
                box.find('input[type=text], textarea').each(function(){
                    $(this).val(null);
                });
                $('.btn.btn-flat.btn-danger.fileinput-exists').trigger('click');
            }else{
                box.trigger("reset");
            }
            settings.onLoadDone.call(box);
        }

        function errorDone(box, message) {

            //Remove overlay and loading img
            box.find(overlay).remove();
            box.find('.box-body').prepend('<div class="form-group text-center box-error has-error text-danger"><span class="help-block"><i class="fa fa-times"></i> An error had occured. Please try again.</span></div>');
            settings.onErrorDone.call(box);

        }

    };
})(jQuery);
















