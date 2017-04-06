$(function(){
    // 「id="box_for_medical"」を非表示
    $("#box_for_medical").css("display", "none");
 
    // 「id="jQueryPush"」がクリックされた場合
    $("#yes_ans").click(function(){
        // 「id="box_for_medical"」の表示、非表示を切り替える
        $("#box_for_medical").toggle();
		$("#yes_ans").toggleClass('active');
    });
});