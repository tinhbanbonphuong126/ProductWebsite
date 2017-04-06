$(function() {
    var topBtn = $('#page-top');    
    topBtn.hide();
    //スクロールが100に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});

jQuery(document).ready(function ($) {    

    /* jQuery back to top */
    $("#back-top").hide();

    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $("#back-top").fadeIn();
        } else {
            $("#back-top").fadeOut();
        }
    });

    $("#back-top a").click(function(){
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

});
