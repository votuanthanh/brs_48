<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTZo5UvQd2On8xYYGXT65ZhnEh4ACw-EIJc-FD7ZCFjwf7yyDrh">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <!-- Begin # DIV Form -->
            <div id="div-forms">
                <!--Register Form -->
                @include('include.form.user.update')
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->
