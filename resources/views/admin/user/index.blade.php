@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="#" class="btn btn-danger" id="delete-all-user"><span class="glyphicon glyphicon-trash"></span>{{ trans('form.button.delete_all') }}</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.user_list') }}
    </div>
    <div class="panel-body">
        {!! Form::open([
            'action' => 'Admin\UserController@destroyAll',
            'method' => 'DELETE',
            'id' => 'delete-anything-user-form',
        ]) !!}
            <table class="table table-hover">
                <tr>
                    <td>
                        {{ Form::checkbox('listUsers', null, 0, ['id' => 'checkbox-all']) }}
                    </td>
                    <td>{{ trans('form.label.avatar') }}</td>
                    <td>{{ trans('form.label.name') }}</td>
                    <td>{{ trans('form.label.email') }}</td>
                    <td>{{ trans('form.label.action') }}</td>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ Form::checkbox('users[]', $user->id) }}</td>
                        <td><img src="{{ $user->avatarPath() }}" width="75px" height="75px"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ action('Admin\UserController@edit', ['id' => $user->id]) }}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        {!! Form::close() !!}
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6">
                <h6>{{ trans('form.heading.total_count') }}<span class="label label-info">{{ $users->total() }}</span></h6>
            </div>
            <div class="col-md-6">
                <div class="pull-right pagination-sm">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="wrapper-modal-auth">
    @include('include.modal.user.auth')
</div>
@endsection
