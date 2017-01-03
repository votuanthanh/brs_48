
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./combobox');

$(document).ready(function () {

    $('.auth-modal').modal();

    $('#action-register').on('click', function () {
        $('#login-form').hide();
        $('#register-form').show();
    });

    $('#action-login').on('click', function () {
        $('#login-form').show();
        $('#register-form').hide();
    });

    //Checkbox all
    $("#checkbox-all").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    //Delete Anything Books
    $('#delete-anything-book').click(function () {
        //console.log(1);
        $('#delete-anything-book-form').submit();
    });

    //Delete a book with confirm form bootstrap
    $('.del-book').click(function() {
        $form = $(this).closest('.delete-book-form');
        $.confirm({
            title:"Delete confirmation",
            text: "This is a confirmation dialog manually triggered! Please confirm:",
            confirm: function(button) {
                $form.submit();
            }
        });
    });

    //delete anthing request book that choiced
    $('#delete-anything-request-book').click(function () {
        $form = $('#request-book-form');
        //console.log($form);
        $.confirm({
            title:"Delete confirmation",
            text: "Warning...! Will delete all request book that choosed. Please confirm:",
            confirm: function(button) {
                $form.submit();
            }
        });
    });

    //set status reqeust book 0: watting requst , 1: has send mail
    $('.book-wrapper').on('click', '.action-accept-request', function () {
        $this = $(this);
        $form = $this.parent().children('.ajax-accepte-request-form');

        //add load watting
        $.confirm({
            title:"Request Book confirmation",
            text: "Processing sending email to user is required that will send. Are you sure?",
            confirm: function(button) {
                var html = '<img src="../../images/common/reload.gif" width="17" height="17"> waiting...';
                $this.html(html);
                $this.attr('disabled', 'disabled');
                //alert if user multiple click
                if ($this.data('requestRunning')) {
                    alert('Doing sending email');
                    return;
                }
                //Running first time
                $this.data('requestRunning', true);
                //handle ajax accept request book
                $.ajax({
                    url: laroute.action('Admin\RequestBookController@ajaxAccepted'),
                    type: "POST",
                    data: $form.serialize(),
                    datatype: "json",
                    success : function (data) {
                        if (data.status) {
                            if (data.option) {
                                $this.html('<span class="glyphicon glyphicon-ok"></span>Accepted')
                                    .removeClass('btn-info')
                                    .addClass('btn-success');
                            } else {
                                $this.html('Accept')
                                    .removeClass('btn-success')
                                    .addClass('btn-info');
                            }
                        }
                    },
                    complete: function() {
                        //Running finish
                        $this.data('requestRunning', false);
                        $this.removeAttr('disabled');
                    },
                });
            }
        });
    });

    //set star for book
    $('#star-create-book').raty({
        path: '../../bower/raty/lib/images',
        starOn: 'star-on.png',
        starOff: 'star-off.png',
        starHalf: 'star-half.png',
        score : 0,
        scoreName : 'score',
        // The name of hidden field generated by Raty
        // Re-validate the star rating whenever user change it
        click: function (score, evt) {
            // Update the score
            $('#star-create-book').raty('score', score);
            $('#book-form').bootstrapValidator('revalidateField', 'star');
            return false;
        }
    });

    /**
     * PROCESS FORM
     */

    //submit log out
    $('#logout-submit').click(function () {
        event.preventDefault();
        $("#form-logout").submit();
    });

    //Validate Login Form
    $('#login-form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 4
                    }
                }
            },
        }
    });

    //Validate Login Form
    $('#register-form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 4
                    }
                }
            },
            password_confirmation: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same',
                    }
                }
            },
            avatar: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 512000,   // 2048 * 1024
                        message: 'Files must be jpeg, jpg, png',
                    }
                }
            }
        }
    });

    //Validate Create Form Book
    $('#book-form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            star: {
                validators: {
                    notEmpty: {
                        message: 'The rating is required',
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            description: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            author: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            category: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            publish_date: {
                validators: {
                    notEmpty: {
                    },
                }
            },
            pages: {
                validators: {
                    notEmpty: {
                    },
                    integer: {
                    }
                }
            },
            image: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'Files must be jpeg, jpg, png',
                    }
                }
            }
        }
    })
    .find('[name="author"], [name="category"]')
    .combobox()
    .end();

    //Show model Edit Word + Answer
    $('.edit-book').click(function () {
        var $that = $(this);
        var idBook = $that.data('id');
        var url = laroute.action('Admin\BookController@edit', { manager_book: idBook });

        $.ajax({
            url: url,
            type: "get",
            datatype: "json",
            success : function (data) {
               if (data.status) {
                    console.log(data);
                    $('.wrapper-modal').text('').append(data.view);
                    $('#edit-book').modal('show');
                    $('#star-book-update').raty({
                        path: '../../bower/raty/lib/images',
                        starOn: 'star-on.png',
                        starOff: 'star-off.png',
                        starHalf: 'star-half.png',
                        score : data.star,
                    });
               } else {
                    alert(data.message);
               }
            },
        })
    });
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
