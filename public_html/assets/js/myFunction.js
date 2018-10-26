(function ($) {
    $.fn.serializeKeyValue = function (options) {
        "use strict";
        var keyValueArray = {};
        $.each($(this).serializeArray(), function (k, v) {
            keyValueArray[v.name] = v.value;
        });
        return keyValueArray;
    };
}(jQuery));


var consoleLog = function (args) {
    if (CONSOLE_LOG) {
        /*if ($.isArray(args)) {
            $.each(args, function (k, v) {
                console.log(v);
            });
        }
        else {*/
        console.log(args);
        // }
    }
};

var getRegEx = function (type) {
    switch (type) {
        case 'normal':
            return new RegExp("^[a-zA-Z 0-9]+$", 'g');
        case 'name':
            return new RegExp("^[a-zA-Z ]+$", 'g');
            break;
        case 'mobile':
            return new RegExp("^[789]{1}[0-9]{9}$", 'g');
            break;
        case 'email':
            return new RegExp("^[a-zA-Z\.\-\_0-9]+[@]{1}[a-zA-Z0-9]+[\.]{1}[a-zA-Z\.\-0-9]+$", 'g');
            break;
        case 'password':
            return new RegExp("^[a-zA-Z0-9!@#$\_%^&*]{6,16}$", 'g');
        case 'price':
            return new RegExp("^([0-9]+(\.[0-9]+))$", 'g');
        case 'detail':
            return new RegExp("^[a-zA-Z 0-9\.]+$", 'g');
        case 'address':
            return new RegExp("^[0-9\w\s\d,-_\(\)\[\]]+$", 'g');
        case 'address_restrict':
            return new RegExp("[\"\']", 'g');
        default:
            return "";
    }
}

var getSuccessArea = function (options) {
    var settings = $.extend({
        title: "success",
        subTitle: "",
        links: {}
    }, options);
    var area_div = $('<div/>').addClass('success-area');
    var ok_icon = $("<h4/>").append($("<i/>").addClass('fa fa-check fa-5x'));
    var title = $("<h4/>").addClass('text-success').text(settings.title);
    var sub_title = $("<h5/>").addClass('text-normal').text(settings.subTitle);
    var buttons = [];
    $.each(settings.links, function (key, value) {
        buttons.push($("<a/>").attr({'href': value}).text(key.toUpperCase()).addClass('btnM btnM-default'));
    });
    return area_div.append(ok_icon).append(title).append(sub_title).append(buttons);
};

var getErrorArea = function (options) {
    var settings = $.extend({
        title: "Failed",
        subTitle: "",
        links: {}
    }, options);
    var area_div = $('<div/>').addClass('error-area');
    var ok_icon = $("<h4/>").append($("<i/>").addClass('fa fa-times fa-5x'));
    var title = $("<h4/>").addClass('text-danger').text(settings.title);
    var sub_title = $("<h5/>").addClass('text-normal').text(settings.subTitle);
    var buttons = [];
    $.each(settings.links, function (key, value) {
        buttons.push($("<a/>").attr({'href': value}).text(key.toUpperCase()).addClass('btnM btnM-default'));
    });
    return area_div.append(ok_icon).append(title).append(sub_title).append(buttons);
};

var bindAPIToken = function (args) {
    args.API_TOKEN = API_TOKEN;
    return args;
};

var cipher_encode = function (text) {
    return CryptoJS.AES.encrypt(text, SECRET_KEY).toString();
}

var cipher_decode = function (encoded_str) {
    return CryptoJS.AES.decrypt(encoded_str, SECRET_KEY).toString(CryptoJS.enc.Utf8);
}

var secure_mobile_str = function (mobile_no) {
    var split_mobile = mobile_no.split("");
    var secret_mobile = [];
    for (var i = 0; i < split_mobile.length; i++) {
        if ($.inArray(i, [2, 3, 5, 6, 7, 8]) >= 0) {
            secret_mobile.push("*");
        }
        else {
            secret_mobile.push(split_mobile[i]);
        }
    }
    return secret_mobile.join('').toString();
}

/* Alerts Section Confirm Message Box */
var alertNormal = function (message_text) {
    $.alert({
        title: 'Alert!',
        icon: 'fa fa-warning',
        content: message_text,
    });
}

var alertSuccess = function (message_text, message_title) {
    var local_title = "Success !!";
    if (typeof message_title !== 'undefined') {
        local_title = message_title;
    }
    $.alert({
        title: local_title,
        icon: 'fa fa-check',
        type: 'green',
        content: message_text,
    });
}

var alertError = function (message_text, message_title) {
    var local_title = "Error !!";
    if (typeof message_title !== 'undefined') {
        local_title = message_title;
    }
    $.alert({
        title: local_title,
        icon: 'fa fa-times',
        type: 'red',
        content: message_text,
    });
}

var MBNormal = function (message_text, message_title, buttons_func) {
    if (typeof buttons_func === 'undefined') {
        consoleLog('Wrong Buttons received');
        return false;
    }
    if (typeof message_title === 'undefined') {
        message_title = "Confirm !";
    }
    var real_buttons = $.extend({
        /*ok: function () {},
        cancel: function () {},*/
    }, buttons_func);
    $.confirm({
        title: message_title,
        content: message_text,
        buttons: real_buttons
        /*buttons: {
            confirm: function () {
                $.alert('Confirmed!');
            },
            cancel: function () {
                $.alert('Canceled!');
            },
            somethingElse: {
                text: 'Something else',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function () {
                    $.alert('Something else?');
                }
            }
        }*/
    });
}

var MBSuccess = function (message_text, message_title, buttons_func) {
    if (typeof buttons_func === 'undefined') {
        consoleLog('Wrong Buttons received');
        return false;
    }
    if (typeof message_title === 'undefined') {
        message_title = "Confirm !";
    }
    var real_buttons = $.extend({
        /*ok: function () {},
        cancel: function () {},*/
    }, buttons_func);
    $.confirm({
        title: message_title,
        content: message_text,
        icon: 'fa fa-check',
        type: 'green',
        buttons: real_buttons
        /*buttons: {
            confirm: function () {
                $.alert('Confirmed!');
            },
            cancel: function () {
                $.alert('Canceled!');
            },
            somethingElse: {
                text: 'Something else',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function () {
                    $.alert('Something else?');
                }
            }
        }*/
    });
}

var MBError = function (message_text, message_title, buttons_func) {
    if (typeof buttons_func === 'undefined') {
        consoleLog('Wrong Buttons received');
        return false;
    }
    if (typeof message_title === 'undefined') {
        message_title = "Confirm !";
    }
    var real_buttons = $.extend({
        /*ok: function () {},
        cancel: function () {},*/
    }, buttons_func);
    $.confirm({
        title: message_title,
        content: message_text,
        icon: 'fa fa-times',
        type: 'red',
        buttons: real_buttons
        /*buttons: {
            confirm: function () {
                $.alert('Confirmed!');
            },
            cancel: function () {
                $.alert('Canceled!');
            },
            somethingElse: {
                text: 'Something else',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function () {
                    $.alert('Something else?');
                }
            }
        }*/
    });
}

/* Message Box End*/


/* Redirect Function */
var redirect = function (url, is_full) {
    if (typeof is_full === 'undefined') {
        window.location = BASE_URL + url;
    }
    else if (is_full === true) {
        window.location = url;
    }
}

var openModel = function (open_id) {
    if (typeof open_id !== 'undefined') {
        $('#' + open_id).modal({
            'backdrop': false, 'show': true
        });
    }
    else {
        return false;
    }
}

var closeModel = function (close_id, open_id) {
    if (typeof close_id !== 'undefined') {
        $('#' + close_id).modal('hide');
    }
    else {
        return false;
    }
    if (typeof open_id !== 'undefined') {
        openModel(open_id);
    }
};

/**------------------------------------------------------------
 *          Geo Location package
 * ------------------------------------------------------------
 *
 */
