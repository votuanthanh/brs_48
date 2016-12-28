<!-- Begin | Lost Password Form -->
    {!! Form::open([
        'method' => 'POST',
        'id' => 'lost-form',
    ]) !!}
        <div class="modal-body">
            <div id="div-lost-msg">
                <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                <span id="text-lost-msg">{{ trans('form.heading.lost_password') }}</span>
            </div>
            {!! Form::email('email', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.email'),
                'required' => '',
            ]) !!}
        </div>
        <div class="modal-footer">
            <div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ trans('form.button.send') }}</button>
            </div>
            <div>
                <button id="lost_login_btn" type="button" class="btn btn-link">{{ trans('form.button.login') }}</button>
                <button id="lost_register_btn" type="button" class="btn btn-link">{{ trans('form.button.register') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
<!-- End | Lost Password Form -->
