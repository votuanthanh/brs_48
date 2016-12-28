<!-- Begin # Login Form -->
{!! Form::open([
    'action' => 'Auth\LoginController@login',
    'method' => 'POST',
    'id' => 'login-form',
]) !!}
    <div class="modal-body">
        <div id="div-login-msg">
            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-login-msg">{{ trans('form.heading.login_form') }}</span>
        </div>
        <div class="form-group">
            {!! Form::email('email', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.email'),
                'required' => '',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.password'),
                'required' => '',
            ]) !!}
        </div>
        <div class="checkbox">
            <label>
                {!! Form::checkbox('remember_me') !!} {{ trans('form.label.remember_me') }}
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <div>
            {!! Form::submit(trans('form.button.login'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
<!-- End # Login Form -->
