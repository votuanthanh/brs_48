<!--STAR: HEADER -->
<header class="main-header">
    <section class="inner-header">
        <div class="container">
            <a href="#">
                <img src="{{ asset('images/logo/book-logo.png') }}" alt="logo">
            </a>
            <div class="header-login">
                <div class="your-welcome">
                    <span>{{ trans('common.text.welcome') }}</span>
                </div>
                <a href="#" data-toggle="modal" data-target="#login-modal" id="action-login">{{ trans('form.button.login') }}</a>
                &ndash;
                <a href="#" id="action-register" data-toggle="modal" data-target="#login-modal">{{ trans('form.button.register') }}</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="search-bar">
            <div class="row">
                <div class="col col-sm-7 col-sm-offset-3">
                    {!! Form::open([
                        'method' => 'POST',
                        'class' => 'form-inline',
                        'role' => 'form',
                    ]) !!}
                        {!! Form::text('search', null, [
                                'class' => 'form-control',
                                'autofocus',
                        ]) !!}
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</header>
<!--END: HEADER -->
