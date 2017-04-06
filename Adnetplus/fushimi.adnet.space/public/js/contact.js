var validateform = {
    kanji_name: "required",
    furigana_name: "required",
    phone: {
        required: true,
        number: true
    },
    email: {
        required: true,
        email: true
    },
    confirm_email:{
        required: true,
        email: true
    },
    gakou_name: "required",
    gakubu: "required",
    senmon: "required",
    post_code: "required",
    house: "required"
};
var pref = ["北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県","茨城県","栃木県","群馬県","埼玉県","千葉県","東京都","神奈川県","新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県","静岡県","愛知県","三重県","滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県","鳥取県","島根県","岡山県","広島県","山口県","徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県","鹿児島県","沖縄県"];
$(document).ready(function () {

    // auto paste year and month and day
    var year = new Date().getFullYear();
    // generate first
    generateYear();
    generateMonth();
    generateDays(year,1);
    generatePref(pref);

    // change month change year
    $("#form-recuirt1 select[name='year']").change(function () {
        selectChange("#form-recuirt1");
    });
    $("#form-recuirt1 select[name='month']").change(function () {
        selectChange("#form-recuirt1");
    });
    $("#form-recuirt2 select[name='year']").change(function () {
        selectChange("#form-recuirt2");
    });
    $("#form-recuirt2 select[name='month']").change(function () {
        selectChange("#form-recuirt2");
    });

    // validate form

    var validateform1 = $.extend(true,{},validateform),
        validateform2 = $.extend(true,{},validateform);
    /*
    validate form contact recuirt -- form 1
     */
    validateform1.confirm_email.equalTo = "#email";
    $("#form-recuirt1").validate({
        errorPlacement: function(){
            return false;
        },
        rules: validateform1
    });

    $(".form1-submit").click(function () {
        if (! $("#form-recuirt1").valid()){
            return false;
        }
        // no error send ajax request
        var data = getDataForm("#form-recuirt1");
        callAjaxSendContact(data);
    });

    /*
     validate form contact recuirt -- form 2
     */
    validateform2.confirm_email.equalTo = "#email1";
    $("#form-recuirt2").validate({
        errorPlacement: function(){
            return false;
        },
        rules: validateform2
    });

    $(".form2-submit").click(function () {
        if (! $("#form-recuirt2").valid()){
            return false;
        }
        // no error send ajax request
        var data = getDataForm("#form-recuirt2");
        callAjaxSendContact(data);
    });

});

function callAjaxSendContact(data){
    $.ajax({
        type: 'POST',
        url: 'http://fushimi.adnet.space/admin/contact/recuirtContact',
        data: {data:data},
        success: function (mess) {
            if (mess == "ok"){
                alert("Send contact successfull!");
                window.location.reload();
            }else{
                alert("Send contact error!");
            }
        }
    });
}

function getDataForm(formID){
    var data = {};
    data['kanji_name'] = $(formID + " input[name='kanji_name']").val();
    data['furigana_name'] = $(formID + " input[name='furigana_name']").val();
    data['year'] = $(formID + " select[name='year']").val();
    data['month'] = $(formID + " select[name='month']").val();
    data['day'] = $(formID + " select[name='day']").val();
    data['post_code'] = $(formID + " input[name='post_code']").val();
    data['prefectures'] = $(formID + " select[name='prefectures']").val();
    data['house'] = $(formID + " input[name='house']").val();
    data['phone'] = $(formID + " input[name='phone']").val();
    data['email'] = $(formID + " input[name='email']").val();
    data['gakou_name'] = $(formID + " input[name='gakou_name']").val();
    data['gakubu'] = $(formID + " input[name='gakubu']").val();
    data['senmon'] = $(formID + " input[name='senmon']").val();
    data['kenkyu_temu'] = $(formID + " textarea[name='kenkyu_temu']").val();
    data['gakusei_jidai'] = $(formID + " textarea[name='gakusei_jidai']").val();
    data['jibun_chouso'] = $(formID + " textarea[name='jibun_chouso']").val();
    data['shikaku_jiko'] = $(formID + " textarea[name='shikaku_jiko']").val();
    data['shokushu'] = $(formID + " select[name='shokushu']").val();
    data['kibou_riyu'] = $(formID + " textarea[name='kibou_riyu']").val();
    return data;
}

function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}

function generateYear(){
    var year = new Date().getFullYear();
    var minyear = 1900;
    for (i = year; i >= minyear; i--){
        // select form 1
        $("#form-recuirt2 select[name='year']").append($('<option></option>').val(i).html(i));
        $("#form-recuirt1 select[name='year']").append($('<option></option>').val(i).html(i));
        // select form 2
    }
}

function generateMonth(){
    for (i = 1; i <= 12 ; i++){
        // select form 1
        $("#form-recuirt2 select[name='month']").append($('<option></option>').val(i).html(i));
        $("#form-recuirt1 select[name='month']").append($('<option></option>').val(i).html(i));
        // select form 2
    }
}

function generateDays(year, month) {
    var day = daysInMonth(month, year);

    $("#form-recuirt1 select[name='day']").html('');
    $("#form-recuirt2 select[name='day']").html('');

    for (i = 1; i <= day ; i++){
        // select form 1
        $("#form-recuirt2 select[name='day']").append($('<option></option>').val(i).html(i));
        $("#form-recuirt1 select[name='day']").append($('<option></option>').val(i).html(i));
        // select form 2
    }
}

function selectChange(formID){
    var currentYear = $(formID + " select[name='year']").val();
    var currentMonth = $(formID + " select[name='month']").val();

    generateDays(currentYear,currentMonth);
}

function generatePref(pref) {
    for (i=0; i < pref.length; i++){
        $("#form-recuirt2 select[name='prefectures']").append($('<option></option>').val(pref[i]).html(pref[i]));
        $("#form-recuirt1 select[name='prefectures']").append($('<option></option>').val(pref[i]).html(pref[i]));
    }
}

// form contact en - contact
/*
$("#form-contact").validate({
    rules: {
        'company': {
            required: true
        },
        'name': {
            required: true
        },
        'address': {
            required: true
        },
        'email': {
            required: true,
            email: true,
        },
        'confirm-email': {
            equalTo: "#email"
        },
        'message-type': {
            required: true
        },
        'content': {
            required: true
        },
    },
    messages: {
        'company': {
            required: "Company name is required",
        },
        'name': {
            required: "Contact person name is required",
        },
        'address': {
            required: "Address required",
        },
        'email': {
            required: "E-mail address required",
            email: 'Invalid email address',
        },
        'confirm-email': {
            equalTo: 'Invalid verification email address',
        },
        'message-type': {
            required: "ご用件が必要です",
        },
        'content': {
            required: "Is a required item, but it is necessary",
        },
    }
});
$('#btn-submit').click(function () {
    if(!$("#form-contact").valid()){
        return false;
    }
    var data = {
        "company": $('#company').val(),
        "department": $('#department').val(),
        "name": $('#name').val(),
        "zip11": $('#zip11').val(),
        "address": $('#address').val(),
        "phone": $('#phone').val(),
        "email": $('#email').val(),
        "message-type": $('#message-type').val(),
        "content": $('#content').val(),
    };
    $.ajax({
        data: data,
        dataType: "json",
        url: "http://fushimi.adnet.space/admin/contact/send-contact",
        type: "POST",
        success: function () {
            console.log('aaaa');
        }
    })
});*/

// contact form jp

/*$("#form-contact").validate({
    rules: {
        'company': {
            required: true
        },
        'name': {
            required: true
        },
        'address': {
            required: true
        },
        'email': {
            required: true,
            email: true,
        },
        'confirm-email': {
            equalTo: "#email"
        },
        'message-type': {
            required: true
        },
        'content': {
            required: true
        },
    },
    messages: {
        'company': {
            required: "企業様名が必要です",
        },
        'name': {
            required: "ご担当者名が必要です",
        },
        'address': {
            required: "住所が必要です",
        },
        'email': {
            required: "メールアドレスが必要です",
            email: 'メールアドレスが無効です',
        },
        'confirm-email': {
            equalTo: '確認用メールアドレスが無効です',
        },
        'message-type': {
            required: "ご用件が必要です",
        },
        'content': {
            required: "は必須項目ですが必要です",
        },
    }
});
$('#btn-submit').click(function () {
    if(!$("#form-contact").valid()){
        return false;
    }
    var data = {
        "company": $('#company').val(),
        "department": $('#department').val(),
        "name": $('#name').val(),
        "zip11": $('#zip11').val(),
        "address": $('#address').val(),
        "phone": $('#phone').val(),
        "email": $('#email').val(),
        "message-type": $('#message-type').val(),
        "content": $('#content').val(),
    };
    $.ajax({
        data: data,
        dataType: "json",
        url: "http://fushimi.adnet.space/admin/contact/send-contact",
        type: "POST",
        success: function () {
            console.log('aaaa');
        }
    })
});*/

// form for medical

/*
$("#form-contact").validate({
    rules: {
        'ex-mail': {
            required: true
        },
        'name': {
            required: true
        },
        'address': {
            required: true
        },
        'email': {
            required: true,
            email: true,
        },
        'confirm-email': {
            equalTo: "#email"
        },
        'date': {
            required: true
        },
        'month': {
            required: true
        },
    },
    messages: {
        'ex-mail': {
            required: "は必須項目です"
        },
        'name': {
            required: "は必須項目です"
        },
        'address': {
            required: "は必須項目です"
        },
        'email': {
            required: "は必須項目です",
            email: "は必須項目です",
        },
        'confirm-email': {
            equalTo: "#email"
        },
        'date': {
            required: "は必須項目です"
        },
        'month': {
            required: "は必須項目です"
        },
    }
});
$('#btn-submit').click(function () {
    if(!$("#form-contact").valid()){
        return false;
    }
    var data = {
        "number": $('#number').val(),
        "name": $('#x-mail').val(),
        "Phonetic": $('#Phonetic').val(),
        "zip11": $('#zip11').val(),
        "address": $('#address').val(),
        "phone": $('#phone').val(),
        "email": $('#email').val(),
        "date": $('#date').val(),
        "month": $('#month').val(),
        "time-zone": $('#time-zone').val(),
        "content": $('#content').val(),
    };
    $.ajax({
        data: data,
        dataType: "json",
        url: "http://fushimi.adnet.space/admin/contact/send-contact-medical",
        type: "POST",
        success: function () {
            console.log('aaaa');
        }
    })
});*/
