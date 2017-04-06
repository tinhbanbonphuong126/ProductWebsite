$(document).ready(function () {
    // Get Json data from API
    ajaxUrl = '';
    pathUrl = window.location.pathname;
    console.log(pathUrl);
    if (pathUrl.indexOf('/cn/') !== -1) {
        ajaxUrl = 'http://fushimi.adnet.space/admin/news?lang=cn';
    } else if (pathUrl.indexOf('/en/') !== -1) {
        ajaxUrl = 'http://fushimi.adnet.space/admin/news?lang=en';
    } else if (pathUrl.indexOf('for-medical-personnel-04.html') !== -1 || pathUrl.indexOf('index1.html') !== -1) {
        ajaxUrl = 'http://fushimi.adnet.space/admin/topics?lang=ja';
    } else if (pathUrl.indexOf('/jp/') !== -1 || pathUrl == '/index.html' || pathUrl == '/') {
        ajaxUrl = 'http://fushimi.adnet.space/admin/news?lang=jp';
    }

    if (ajaxUrl != '') {
        var rows = $("#news-area");
        var tmpl = $('#news-template').html();
        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            success: function (data) {
                var datas = {
                    news: data
                };
                console.log(data);
                var html = Mustache.to_html(tmpl, datas);
                $(rows).html(html);
                $('a.link').each(function( index ) {
                   var href = $(this).attr('href');
                   if (!href) {
                       $(this).removeAttr("href");
                       $(this).removeAttr("target");
                   }
                });
            }
        });
    }

    /////////////////////////// don't care it !!

    /* jQuery back to top */
    $("#back-top").hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $("#back-top").fadeIn();
        } else {
            $("#back-top").fadeOut();
        }
    });

    $("#back-top a").click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

});