<!-- Begin | Register Form -->
{!! Form::open([
    'method' => 'POST',
    'id' => 'update-register-form',
]) !!}
    <div class="modal-body">
        <div id="div-register-msg">
            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-register-msg">{{ trans('form.heading.update_user') }}</span>
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
            {!! Form::submit(trans('form.button.update'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
<!-- End | Register Form -->
