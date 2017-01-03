@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="{{ action('Admin\BookController@index') }}" class="btn btn-success">
    <span class="glyphicon glyphicon-success"></span>
    {{ trans('form.button.back') }}
</a>
<a href="javascript:void(0)" class="btn btn-danger" id="delete-anything-request-book">
    <span class="glyphicon glyphicon-trash"></span>
    {{ trans('form.button.delete_all') }}
</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.book.request') }}
    </div>
    <div class="panel-body book-wrapper">
        {!! Form::open([
            'action' => 'Admin\RequestBookController@delete',
            'id' => 'request-book-form',
            'method' => 'POST',
        ]) !!}
            <table class="table table-hover">
                <tr>
                    <td>
                        {{ Form::checkbox('request_book', 'all', 0, ['id' => 'checkbox-all']) }}
                    </td>
                    <td>{{ trans('form.label.name') }}</td>
                    <td>{{ trans('form.label.email') }}</td>
                    <td>{{ trans('form.label.name_book') }}</td>
                    <td>{{ trans('form.label.description') }}</td>
                    <td>{{ trans('form.label.date_request') }}</td>
                    <td>{{ trans('form.label.request') }}</td>
                </tr>
                @foreach($requestBooks as $request)
                    <tr>
                        <td>{{ Form::checkbox('requestBook[]', $request->id) }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>{{ $request->book_name }}</td>
                        <td>{{ $request->description }}</td>
                        <td>{{ $request->created_at->format('d-m-Y') }}</td>
                        <td>
                            {!! Form::close() !!}
                            {!! Form::open([
                                'action' => 'Admin\RequestBookController@ajaxAccepted',
                                'class' => 'ajax-accepte-request-form',
                                'method' => 'POST',
                            ]) !!}
                                {!! Form::hidden('id', $request->id) !!}
                            {!! Form::close() !!}
                            @if ($request->is_accepted)
                                <a href="javascript:void(0)" class="btn btn-success action-accept-request">
                                    <span class="glyphicon glyphicon-ok"></span> Accepted
                                </a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-info action-accept-request">
                                    Accept
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        {!! Form::close() !!}
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6">
                <h6>{{ trans('form.heading.total_count') }}
                    <span class="label label-info">{{ $requestBooks->total() }}</span>
                </h6>
            </div>
            <div class="col-md-6">
                <div class="pull-right pagination-sm">
                    {{ $requestBooks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
