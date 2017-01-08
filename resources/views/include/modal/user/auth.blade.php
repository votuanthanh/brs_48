<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade {{ count($errors) > 0 ? 'auth-modal' : '' }}"
    id="auth-modal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="http://recruit.framgia.vn/wp-content/uploads/2016/06/framgia-logo-black-1.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>

            <!-- Begin # DIV Form -->
            <div id="div-forms">
                @if(!auth()->check())
                    <!--Login Form -->
                    @include('include.form.user.login')

                    <!-- Register Form-->
                    @include('include.form.user.register')
                @else
                    <!-- Edit Form-->
                    @include('include.form.user.edit')
                @endif
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->
