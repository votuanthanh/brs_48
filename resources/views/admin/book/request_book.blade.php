@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-success"></span> {{ trans('form.button.back') }}</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.book_list') }}
    </div>
    <div class="panel-body book-wrapper">
        {!! Form::open([
            'method' => 'POST',
        ]) !!}
            <table class="table table-hover">
                <tr>
                    <td>
                        {{ Form::checkbox('user', 2, 0, ['id' => 'checkbox-all']) }}
                    </td>
                    <td>{{ trans('form.label.name') }}</td>
                    <td>{{ trans('form.label.email') }}</td>
                    <td>{{ trans('form.label.name_book') }}</td>
                    <td>{{ trans('form.label.description') }}</td>
                    <td>{{ trans('form.label.date_request') }}</td>
                    <td>{{ trans('form.label.request') }}</td>
                </tr>
                <tr>
                    <td>{{ Form::checkbox('book[]') }}</td>
                    <td>Thanh</td>
                    <td>thanh.dtu94@gmail.com</td>
                    <td>Dac nhan tam</td>
                    <td>Mot cuon sach tuyen voi! :)</td>
                    <td>20/10/2016 AM</td>
                    <td>
                        <a href="#" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> {{ trans('form.button.accept') }}
                        </a>
                    </td>
                </tr>
            </table>
        {!! Form::close() !!}
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6">
                <h6>{{ trans('form.heading.total_count') }}<span class="label label-info">25</span></h6>
            </div>
            <div class="col-md-6">
                <ul class="pagination pagination-sm pull-right">
                    <li class="disabled"><a href="javascript:void(0)">«</a></li>
                    <li class="active"><a href="javascript:void(0)">1
                        <span class="sr-only">{{ trans('common.text.current') }}</span>
                        </a>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="javascript:void(0)">»</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
