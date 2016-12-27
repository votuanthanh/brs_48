<!-- Begin | Register Form -->
{!! Form::open([
    'method' => 'POST',
    'id' => 'register-form',
]) !!}
    <div class="modal-body">
        <div id="div-register-msg">
            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-register-msg">{{ trans('form.heading.register') }}</span>
        </div>
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.name'),
            'autofocus',
            'required',
        ]) !!}
        {!! Form::email('email', null, [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.email'),
            'autofocus',
            'required',
        ]) !!}
        {!! Form::password('password', [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.password'),
            'required',
        ]) !!}
        {!! Form::password('password_confirmation', [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.confirm_password'),
            'required',
        ]) !!}
        {!! Form::file('avatar') !!}
    </div>
    <div class="modal-footer">
        <div>
            {!! Form::submit(trans('form.button.register'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
        <div>
            <button id="register_login_btn" type="button" class="btn btn-link">{{ trans('form.button.login') }}</button>
            <button id="register_lost_btn" type="button" class="btn btn-link">{{ trans('form.button.lost_password') }}</button>
        </div>
    </div>
{!! Form::close() !!}
<!-- End | Register Form -->
