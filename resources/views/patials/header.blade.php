<!--STAR: HEADER -->
<header class="main-header">
    <section class="inner-header">
        <div class="container">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/framgia_logo.png') }}" alt="logo">
            </a>
            <div class="header-login">
                <div class="your-welcome">
                    <span>{{ trans('common.text.welcome') }}</span>
                </div>
                @if (auth()->check() && auth()->user())
                    <div class="profile-user">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="name-user">{{ auth()->user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-content">
                                <li>
                                    <a href="{{ action('Web\UserController@show', ['id' => auth()->user()->id]) }}">
                                        <span class="glyphicon glyphicon-user"></span>
                                        {{ trans('form.label.profile') }}
                                    </a>
                                </li>
                                @if($authUser->role)
                                    <li>
                                        <a href="{{ action('Admin\BookController@index') }}">
                                            <span class="glyphicon glyphicon-log-in"></span>
                                            {{ trans('form.label.go_to_admin') }}
                                        </a>
                                    </li>
                                @endif
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
            <div class="search-bar">
                <div class="row">
                    <div class="col col-sm-6 wrp-form-search">
                        {!! Form::open([
                            'action' => ['Web\SearchController@handleSearch'],
                            'method' => 'get',
                            'role' => 'form',
                            'id' => 'search-book-typehead',
                        ]) !!}
                            <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
                        {!! Form::close() !!}
                    </div>
                    <button type="submit" class="btn btn-default b-search">
                        <i class="glyphicon glyphicon-search"></i>
                        {{ trans('common.text.search_book') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</header>
<!--END: HEADER -->
