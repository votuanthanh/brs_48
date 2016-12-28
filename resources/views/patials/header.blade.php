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
                @if (auth()->check() && auth()->user())
                    <div class="profile-user">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="name-user">{{ auth()->user()->name }}  <span class="caret"></span></a>
                            <ul class="dropdown-content">
                                <li>
                                    <a href="#"><span class="glyphicon glyphicon-user"></span> {{ trans('form.label.profile') }}</a>
                                </li>
                                <li>
                                    <a id="logout-submit" href="#">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                        {{ trans('form.button.logout') }}
                                        {!! Form::open([
                                            'action' => 'Auth\LoginController@logout',
                                            'method' => 'POST',
                                            'role' => 'form',
                                            'id' => 'form-logout',
                                        ]) !!}
                                        {!! Form::close() !!}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="#" data-toggle="modal" data-target="#auth-modal" id="action-login">
                        {{ trans('form.button.login') }}
                    </a>
                    &ndash;
                    <a href="#" id="action-register" data-toggle="modal" data-target="#auth-modal">
                        {{ trans('form.button.register') }}
                    </a>
                @endif
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
