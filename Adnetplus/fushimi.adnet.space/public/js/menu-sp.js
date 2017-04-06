$(function() {
    $(".nav").css("display","none");
    $(".menu_button").on("click", function() {
        $(".nav").slideToggle();
		$('.menu_button').toggleClass('navOpen'); // class付与/削除
    });
});