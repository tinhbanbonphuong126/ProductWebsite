/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});


$(function(){
    $(".datepicker").datetimepicker({
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        changeMonth: true,
        changeYear: true
    });
    $(".pickerCreate").datetimepicker({
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        showTime: false,
        showTimepicker:false,
        yearRange: '1900:2100',

    });
    $('.datetime').datetimepicker({
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        timeFormat: "HH:mm:ss"
    });
});

//$(function () {
//    $.datetimepicker.setLocale('ja');
//    $('.datepicker').datetimepicker({
//        formatDate: 'Y/m/d',
//        format:'Y/m/d',
//        timepicker:false,
//        lang:'ja',
//    });
//
//    $('.datetime').datetimepicker({
//        formatDate:'Y/m/d',
//        step:30,
//        lang:'ja',
//    });
//});

//$('.datetime').datepicker({
//    format: 'yyyy/mm/dd H:i',
//    language:'ja',
//});