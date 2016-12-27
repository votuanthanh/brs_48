<div class="col-md-2 sidebar">
    <div class="row">
        <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <div class="absolute-wrapper"> </div>
        <!-- Menu -->
        <div class="side-menu">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Main Menu -->
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">
                        <li class="active panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-manager-user">
                                <span class="glyphicon glyphicon-user"></span>
                                    {{ trans('common.user.manager') }}
                                <span class="caret"></span>
                            </a>
                            <div id="dropdown-manager-user" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#"><i class="glyphicon glyphicon-tag"></i>{{ trans('common.user.list') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!--END: Manger User -->
                        <li class="active panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-manager-book">
                                <span class="glyphicon glyphicon-book"></span>
                                {{ trans('common.book.manager') }}
                                <span class="caret"></span>
                            </a>
                            <div id="dropdown-manager-book" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#"><i class="glyphicon glyphicon-tag"></i>{{ trans('common.book.create') }}</a></li>
                                        <li><a href="#"><i class="glyphicon glyphicon-tag"></i>{{ trans('common.book.list') }}</a></li>
                                        <li><a href="#"><i class="glyphicon glyphicon-tag"></i>{{ trans('common.book.request') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!--END: Manger User -->

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>
