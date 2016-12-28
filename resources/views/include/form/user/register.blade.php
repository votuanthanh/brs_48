<!-- Begin | Register Form -->
{!! Form::open([
    'action' => 'Auth\RegisterController@register',
    'method' => 'POST',
    'id' => 'register-form',
    'files' => true,
]) !!}
    <div class="modal-body">
        <div id="div-register-msg">
            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-register-msg">{{ trans('form.heading.register') }}</span>
        </div>
        <div class="form-group">
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.name'),
                'autofocus',
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.email'),
                'autofocus',
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.password'),
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password_confirmation', [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.confirm_password'),
                'required',
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
