@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>{{ trans('form.button.delete_all') }}</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.user_list') }}
    </div>
    <div class="panel-body">
        {!! Form::open([
            'method' => 'POST',
        ]) !!}
            <table class="table table-hover">
                <tr>
                    <td>
                        {{ Form::checkbox('user', 2, 0, ['id' => 'checkbox-all']) }}
                    </td>
                    <td>{{ trans('form.label.name') }}</td>
                    <td>{{ trans('form.label.avatar') }}</td>
                    <td>{{ trans('form.label.email') }}</td>
                    <td>{{ trans('form.label.action') }}</td>
                </tr>
                <tr>
                    <td>{{ Form::checkbox('s') }}</td>
                    <td>Tsadsa</td>
                    <td>dsa dsadsad</td>
                    <td>dsadsa@gmail.com</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#edit-user">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="http://www.jquery2dotnet.com" class="trash">
                            <span class="glyphicon glyphicon-trash"></span>
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
                    <li class="active">
                        <a href="javascript:void(0)">1
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
@include('include.modal.edit_user_form')

