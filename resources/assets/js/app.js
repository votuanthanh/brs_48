
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./combobox');

$(document).ready(function () {
    /**
     * Setting Tooltip
     */
    //set global
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });

    //set golobal ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
        $.confirm({
            title:"Delete confirmation",
            text: "Are you sure! delete all book that has choiced!",
            confirm: function(button) {
                $('#delete-anything-book-form').submit();
            }
        });
    });

    $('.b-search').click(function () {
        $('#search-book-typehead').submit();
    });

    //Delete Anything User
    $('#delete-all-user').click(function () {
    });

    //Delete a book with confirm form bootstrap
    $('.del-book').click(function() {
        var $form = $(this).closest('.delete-book-form');
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
        var $this = $(this);
        var $form = $this.parent().children('.ajax-accepte-request-form');

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
     //show review form
    $('#see-also, .js-cancel').click(function () {
        $('.box-form').toggleClass('show');
    });

    $('.js-quick-rely, .hidden-comment-form').click(function () {
        $wrapperForm = $(this).closest('.review-block-like').children('.commnet-form-request');
        $wrapperForm.toggleClass('show');
    });
//
    /**
     * Ajax add favorite book
     */
    $('.container').on('click', '.add-favorite-book', function (e) {
        e.preventDefault();
        var $this = $(this);
        var idBook = $this.parent().data('id');
        var url = laroute.action('Web\BookController@ajaxFavoriteBook');

        //alert if user multiple click
        if ($this.data('requestRunning')) {
            alert('Process Doing. Please waiting to do');
            return;
        }
        $this.data('requestRunning', true);
        $.ajax({
            url: url,
            type: "POST",
            data : { id : idBook },
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    $this.find('span')
                        .addClass('favorite-book')
                    $this.attr('data-original-title', 'Remove to favorite book')
                } else {
                    $this.find('span')
                        .removeClass('favorite-book')
                    $this.attr('data-original-title', 'Add to favorite book');
                }
            },
            complete: function() {
                //Running finish
                $this.data('requestRunning', false);
            },
        })
    });

    /**
     * Ajax add favorite book
     */
    $('.container').on('click', '.add-status-read-book', function (e) {
        e.preventDefault();
        var $this = $(this);
        var status = $this.data('status');
        var idBook = $this.parent().data('id');
        var url = laroute.action('Web\BookController@ajaxStatusBook');

        console.log(status + '-' + idBook + '-' + url);

        //alert if user multiple click
        if ($this.data('requestRunning')) {
            alert('Process Doing. Please waiting to do');
            return;
        }
        $this.data('requestRunning', true);

        $.ajax({
            url: url,
            type: "POST",
            data : { id : idBook, status: status },
            datatype: "json",
            success : function (data) {
                //child of this
                var $span = $this.find('span');
                var $parent = $this.parent();

                if (status) {
                    if (data.status) {
                        $span.addClass('read-book');
                        $parent.find('span').removeClass('reading-book');
                        $this.attr('data-original-title', 'Remove to read book')
                    } else {
                        $span.removeClass('read-book');
                        $this.attr('data-original-title', 'Add to read book')
                    }
                } else {
                    if (data.status) {
                        $span.addClass('reading-book');
                        $parent.find('span').removeClass('read-book');
                        $this.attr('data-original-title', 'Remove to reading book')
                    } else {
                        $span.removeClass('reading-book');
                        $this.attr('data-original-title', 'Add to reading book')
                    }
                }
            },
            complete: function() {
                //Running finish
                $this.data('requestRunning', false);
            },
        })
    });

    //add like review
    $('.button-like').click(function (e) {
        var $this = $(this);
        var idReview = $this.data('id');

        var url = laroute.action('Web\ReviewController@likeReivew', {id : idReview});

        console.log(idReview + '-' + url);

        //alert if user multiple click
        if ($this.data('requestRunning')) {
            alert('Process Doing. Please waiting to do');
            return;
        }
        $this.data('requestRunning', true);

        $.ajax({
            url: url,
            type: "GET",
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    $this.remove();
                }
            },
            complete: function() {
                //Running finish
                $this.data('requestRunning', false);
            },
        })
    });


    /**
     * Ajax Follower or Following
     */
    $('.container').on('click', '.action-relate', function (e) {
        e.preventDefault();
        var $this = $(this);
        var idUser = $this.data('id');
        var url = laroute.action('Web\UserController@ajaxRelationship');

        console.log(idUser + '-' + url);

        //alert if user multiple click
        if ($this.data('requestRunning')) {
            alert('Process Doing. Please waiting to do');
            return;
        }
        $this.data('requestRunning', true);

        $.ajax({
            url: url,
            type: "POST",
            data : { id : idUser },
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    $this.removeClass('btn-default')
                        .addClass('btn-info')
                        .text('Following');
                } else {
                    $this.removeClass('btn-info')
                        .addClass('btn-default')
                        .text('Follow');
                }
            },
            complete: function() {
                //Running finish
                $this.data('requestRunning', false);
            },
        })
    });

    //Create Comment For Review
    $('.write-comment-for-review').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $form = $this.parent();
        var url = laroute.action('Web\ReviewController@handleComment');

        //handle ajax accept request book
        $.ajax({
            url: url,
            type: "POST",
            data: $form.serialize(),
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    var boxComment = $form.closest('.review-block-like').find('.box-comment');
                    boxComment.append(data.view);
                    $form.parent().removeClass('show');
                }
                console.log(boxComment);
            },
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
            $('#book-form').bootstrapValidator('revalidateField', 'score');
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

    //Validate Registry Form
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
                    }
                }
            },
            avatar: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
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
                    }
                }
            },
            score: {
                validators: {
                    notEmpty: {
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
                    }
                }
            }
        }
    })
    .find('[name="author"], [name="category"]')
    .combobox()
    .end();

    $('#edit-user-form').bootstrapValidator({
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
                    stringLength: {
                        min: 4
                    }
                }
            },
            password_confirmation: {
                validators: {
                    identical: {
                        field: 'password',
                    }
                }
            },
            avatar: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                    }
                }
            }
        }
    });

    $('#star-review-book').raty({
        path: '../../bower/raty/lib/images',
        starOn: 'star-on.png',
        starOff: 'star-off.png',
        starHalf: 'star-half.png',
        scoreName : 'star',
        // The name of hidden field generated by Raty
        // Re-validate the star rating whenever user change it
        click: function (score, evt) {
            // Update the star
            $('#star-review-book').raty('score', score);
            $('#reivew-book-form').bootstrapValidator('revalidateField', 'star');
            return false;
        }
    });
    // validate form review book
    $('#reivew-book-form').bootstrapValidator({
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
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 10,
                    },
                }
            },
            content: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 25,
                    },
                }
            },
        }
    });

    //valite request book
    $('#request-book-form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            book_name: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 10,
                    },
                }
            },
            description: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 25,
                    },
                }
            },
        }
    });

    //valite request book
    $('.comment-review-form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            content: {
                validators: {
                    notEmpty: {
                    },
                    stringLength: {
                        min: 10,
                    },
                }
            },
        }
    });

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

    //Show model Edit Word + Answer
    $('.cancel-request-book').click(function () {
        var $this = $(this);
        var idUser = $this.data('id-user');
        var idRequest = $this.data('id-request');
        var url = laroute.action('Web\UserController@ajaxCancelRequestBook');

        $.confirm({
            title:"Request Book confirmation",
            text: "Are you sure to cancel request to admin?",
            confirm: function(button) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {idUser: idUser, idRequest: idRequest },
                    datatype: "json",
                    success : function (data) {
                        if (data.status) {
                            $this.closest('tr').remove();

                            $('table').find('.key').each(function (index, element) {
                                $(element).text(index + 1);
                            });
                        }
                    },
                })
            },
        });

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
