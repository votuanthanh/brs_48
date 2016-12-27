
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./combobox');

$(document).ready(function () {
    $('#wrapper-modal-auth').on('#action-register', 'click', function () {
        $('#login-form').hide();
        $('#register-form').show();
    });

    $('#wrapper-modal-auth').on('#action-login', 'click', function () {
        $('#login-form').show();
        $('#register-form').hide();
    });

    //Checkbox all
    $("#checkbox-all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    //set combox
    $('.combobox').combobox();

    //set star for book
    $('#star1').raty({ starType: 'i', score      : 5});
});

//LOGIN + REGISTRY + LOST FORM
$(function() {

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $('#login_register_btn').click( function () {
        modalAnimate($formLogin, $formRegister)
    });
    $('#register_login_btn').click( function () {
        modalAnimate($formRegister, $formLogin);
    });
    $('#login_lost_btn').click( function () {
        modalAnimate($formLogin, $formLost);
    });
    $('#lost_login_btn').click( function () {
        modalAnimate($formLost, $formLogin);
    });
    $('#lost_register_btn').click( function () {
        modalAnimate($formLost, $formRegister);
    });
    $('#register_lost_btn').click( function () {
        modalAnimate($formRegister, $formLost);
    });

    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function() {
            $divForms.animate({ height: $newH }, $modalAnimateTime, function() {
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }

    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});
