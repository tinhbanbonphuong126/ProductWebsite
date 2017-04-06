/**
 * Created by QUE on 2/25/2017.
 */

$(function(){
    //Common validate
    //Validate id
    $.validator.addMethod("validateId", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate name
    $.validator.addMethod("validateName", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate passowrd
    $.validator.addMethod("validatePassword", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate sex
    $.validator.addMethod("validateSex", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate birth
    $.validator.addMethod("validateBirth", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate nation
    $.validator.addMethod("validateNation", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate Mail
    $.validator.addMethod("validateMail", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');

    //Validate Phone
    $.validator.addMethod("validatePhone", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1
        && /^[0-9]+$/.test( value ) ;
    }, 'ログインIDを入力してください。');

    //Validate Address
    $.validator.addMethod("validateAddress", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element )
        || value.length >= 1;
    }, 'ログインIDを入力してください。');
});

//Form Login Validate
$(function(){
    $("#LogInForm").validate({
        rules: {
            id: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                validateId: true
            },
            password: {
                required: true
            }
        }
    });
});

//Form Employee register


$(function(){

    var validatorEmployee =
    $("#CreateEditEmployee").validate({
        rules: {
            name: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                }
            },
            sex: {
                required: true
            },
            birth: {
                required: true
            },
            nation: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                }
            },
            address: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                }
            },
            phone: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                validatePhone: true
            },
            mail: {
                required: true
            },
            password: {
                required: true
            }
        }
    });

    $('#btn-validate-employee').click(function () {
        if ($("#CreateEditEmployee").valid()) {
            $('#myModal').modal('show');
        } else {
            $(".errors").css("display","block");
            validatorEmployee.focusInvalid();
        }
    });
});

//Form User register

$(function() {
var validatorUser=
    $("#CreateEditUser").validate({
        rules: {
           name: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                }
            },
            sex: {
                required: false
            },
            birth: {
                required: false
            },
            address: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                }
            },
            phone: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                validatePhone: true
            },
            mail: {
                required: false
            }
        }

    });

    $('#btn-validate-user').click(function () {
        if ($("#CreateEditUser").valid()) {
            $('#myModal').modal('show');
        } else {
            $(".errors").css("display","block");
            validatorUser.focusInvalid();
        }
    });
});
































