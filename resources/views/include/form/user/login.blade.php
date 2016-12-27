<!-- Begin # Login Form -->
    {!! Form::open([
        'method' => 'POST',
        'id' => 'login-form',
    ]) !!}
        <div class="modal-body">
            <div id="div-login-msg">
                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                <span id="text-login-msg">{{ trans('form.heading.login_form') }}</span>
            </div>
            {!! Form::email('email', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.email'),
                'required' => '',
            ]) !!}
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.password'),
                'required' => '',
            ]) !!}
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
            <div>
                <button id="login_lost_btn" type="button" class="btn btn-link">{{ trans('form.button.lost_password') }}</button>
                <button id="login_register_btn" type="button" class="btn btn-link">{{ trans('form.button.register') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
<!-- End # Login Form -->
