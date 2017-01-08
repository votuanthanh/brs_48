<!-- Begin | Edit User Form -->
{!! Form::open([
    'action' => ['Web\UserController@update', $authUser->id],
    'method' => 'PUT',
    'id' => 'edit-user-form',
    'files' => true,
]) !!}
    <div class="modal-body">
        <div id="div-register-msg">
            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-register-msg">{{ trans('form.heading.edit_user') }}</span>
        </div>
        <div class="form-group">
            {!! Form::text('name', $authUser->name, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.name'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email', $authUser->email, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.email'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.password'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password_confirmation', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.confirm_password'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::file('avatar') !!}
        </div>
    </div>
    <div class="modal-footer">
        <div>
            {!! Form::submit(trans('form.button.register'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
<!-- End | Register Form -->
