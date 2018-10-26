(function ($) {
    $.fn.defaultLoader = function (options) {
        "use strict";
        var settings = $.extend({
            theme: "default",
            position: 'fixed',
            color: "#FFFFFF",
            backgroundColor: "(0,0,0)",
            backgroundDrop: false,
            fontAwesome: "fa-spinner",
            imagePosition: "center center",
            zIndex: 99999,
            loaderContent: $("<div/>").append($('<i/>').addClass('fa fa-spinner fa-5x fa-spin')).append($("<h3/>").text('Processing...'))
        }, options);
        var setBackgroundColor = function () {
            var bg_black = ['(0,0,0)', '#000', '#000000', 'black'];
            var bg_white = ['(255,255,255)', '#FFF', '#FFFFFF', 'white'];
            if ($.inArray(settings.backgroundColor, bg_black) > -1) {
                settings.backgroundColor = 'rgba(0,0,0,0.7)';
                settings.color = "#FFFFFF";
            }
            else if ($.inArray(settings.backgroundColor, bg_white) > -1) {
                settings.backgroundColor = 'rgba(255,255,255,0.7)';
                settings.color = "#000000";
            }
            else {
                settings.backgroundColor = 'rgba(255,255,255,0.7)';
                settings.color = "#000000";
            }
        };
        setBackgroundColor();
        var loaderObject, actualLoader;
        if (settings.theme === 'default') {
            // actualLoader = $('<i/>').addClass('fa ' + settings.fontAwesome + ' fa-5x fa-spin');
            loaderObject = $("<div/>").css({
                'width': '100%',
                'height': '100%',
                'display': 'table',
                'z-index': settings.zIndex,
                'background': settings.backgroundColor,
                'position': settings.position,
                'top': '0px',
                'left': '0px',
                'text-align': 'center',
                'color': settings.color,
            }).addClass('M-loader').append($("<div/>").css({
                'display': 'table-cell',
                'vertical-align': 'middle',
            }).append(settings.loaderContent));

            if (true === settings.backgroundDrop) {
                console.log('true drop');
                loaderObject.attr({
                    'onclick': '$("this").defaultLoader.stop();'
                });
            }
            this.append(loaderObject);
        }
        else {
            console.log('Need to write new theme, because the theme you have selected not found in plugin');
            settings.theme = 'default';
            this.defaultLoader(settings);
            return;
        }
    };

    $.fn.defaultLoader.stop = function () {
        $(".M-loader").remove();
    }

    $.defaultLoader = function () {
        $('body').defaultLoader();
    }

    $.defaultLoader.stop = function () {
        $(".M-loader").remove();
    }

    $.fn.loginPopup = function (options) {
        "use strict";
        var settings = $.extend({
            theme: "default",
            position: 'fixed',
            color: "#FFFFFF",
            backgroundColor: "(0,0,0)",
            backgroundDrop: false,
            fontAwesome: "fa-spinner",
            imagePosition: "center center",
            zIndex: 99999,
            loaderContent: $("<div/>").append($('<i/>').addClass('fa fa-spinner fa-5x fa-spin')).append($("<h3/>").text('Processing...'))
        }, options);
        var setBackgroundColor = function () {
            var bg_black = ['(0,0,0)', '#000', '#000000', 'black'];
            var bg_white = ['(255,255,255)', '#FFF', '#FFFFFF', 'white'];
            if ($.inArray(settings.backgroundColor, bg_black) > -1) {
                settings.backgroundColor = 'rgba(0,0,0,0.8)';
                //settings.color = "#FFFFFF";
            }
            else if ($.inArray(settings.backgroundColor, bg_white) > -1) {
                settings.backgroundColor = 'rgba(255,255,255,0.8)';
                //settings.color = "#000000";
            }
            else {
                settings.backgroundColor = 'rgba(255,255,255,0.8)';
                //settings.color = "#000000";
            }
        };
        setBackgroundColor();
        // consoleLog(settings); return;
        var loaderObject;
        if (settings.theme === 'default') {
            var row = $("<div/>").addClass('row');
            var col_form = $("<div/>").addClass('col-sm-4 col-sm-offset-4');
            var panel = '<div class="panel panel-default">' +
                '<div class="panel-heading">' +
                '<span class="bold">Login Required</span>' +
                '<span class="bold pull-right" onclick="cancelLogin();"><i class="fa fa-times"></i></span>' +
                '</div>' +
                '<div class="panel-body">' +
                '<form method="POST" action="#" onsubmit="return loginBackground()" id="dynamic_login">' +
                '<div class="form-group">' +
                '<label class="col-sm-12 label-control">Password</label>'+
                '<div class="col-sm-12">' +
                '<input type="text" name="username" value="'+settings.mobile_no+'" hidden>'+
                '<input type="password" class="form-control" name="d_password" placeholder="Password">'+
                '</div>'+
                '</div>'+
                '<div class="form-group">' +
                '<div class="col-sm-12">' +
                '<button type="submit" class="btnM btnM-theme btn-block">Login Now</button>'+
                '</div>'+
                '</div>'+
                '</form>' +
                '</div>' +
                '<div class="panel-footer">' +
                '<a href="'+BASE_URL+"user/Recover"+'">Forget Password ?</a>' +
                '</div>' +
                '</div>';
            var loginForm = row.append(col_form.append(panel));

            loaderObject = $("<div/>").css({
                'width': '100%',
                'height': '100%',
                'display': 'table',
                'z-index': settings.zIndex,
                'background': settings.backgroundColor,
                'position': settings.position,
                'top': '0px',
                'left': '0px',
                // 'text-align': 'center',
                // 'color': settings.color,
            }).addClass('loginPopupWindow').append($("<div/>").css({
                'display': 'table-cell',
                'vertical-align': 'middle',
            }).append(loginForm));

            if (true === settings.backgroundDrop) {
                console.log('true drop');
                loaderObject.attr({
                    'onclick': '$("this").defaultLoader.stop();'
                });
            }
            if (false === $(".loginPopupWindow").is(":visible")) {
                this.append(loaderObject);
            }
        }
        else {
            console.log('Need to write new theme, because the theme you have selected not found in plugin');
            settings.theme = 'default';
            this.loginPopup(settings);
            return;
        }
    };
    $.fn.loginPopup.stop = function () {
        $(".loginPopupWindow").remove();
    }

    $.loginPopup = function () {
        $('body').loginPopup();
    }

    $.loginPopup.stop = function () {
        $(".loginPopupWindow").remove();
    }
}(jQuery));

