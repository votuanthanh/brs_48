@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="{{ action('Admin\BookController@create') }}" class="btn btn-success">
    <span class="glyphicon glyphicon-plus"></span>
    {{ trans('form.button.add_new') }}
</a>
<a href="javascript:void(0)" class="btn btn-danger" id="delete-anything-book">
    <span class="glyphicon glyphicon-trash"></span>
    {{ trans('form.button.delete_all') }}
</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.book_list') }}
    </div>
    <div class="panel-body book-wrapper">
        {!! Form::open([
            'method' => 'post',
            'id' => 'delete-anything-book-form',
            'action' => 'Admin\BookController@deleteAnything',
        ]) !!}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            {{ Form::checkbox('bookAll', null, 0, ['id' => 'checkbox-all']) }}
                        </th>
                        <th>{{ trans('form.label.image') }}</th>
                        <th>{{ trans('form.label.author') }}</th>
                        <th>{{ trans('form.label.title') }}</th>
                        <th>{{ trans('form.label.description') }}</th>
                        <th>{{ trans('form.label.publish_date') }}</th>
                        <th>{{ trans('form.label.point') }}</th>
                        <th>{{ trans('form.label.pages') }}</th>
                        <th>{{ trans('form.label.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ Form::checkbox('idBooks[]', $book->id) }}</td>
                            <td class="td-image">
                                <img src="{{ asset('images/book/'.$book->image) }}" alt="image book">
                            </td>
                            <td>{{ $book->author->name }}</td>
                            <td class="td-title">{{ $book->title }}</td>
                            <td class="td-description">{{ mb_strimwidth($book->description, 0, 50, '...') }}</td>
                            <td>{{ $book->publish_date->format('m-d-y A') }}</td>
                            <td>
                                <div class="rating-container rating-md rating-animate">
                                    <div class="rating">
                                        <span class="empty-stars">
                                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        </span>
                                        <span class="filled-stars" style="width: {{ $book->computePercentRating() }}%;">
                                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                        </span>
                                    </div>
                                </div>
                                ({{ $book->avg_rate }})
                            </td>
                            <td>{{ $book->number_of_pages }}</td>
                            <td class="frm-del">
                                <a href="javascript:void(0)" data-toggle="modal" class="edit-book" data-id="{{ $book->id }}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                {!! Form::close() !!}
                                {!! Form::open(['action' => ['Admin\BookController@destroy', $book->id],
                                    'method' => 'delete',
                                    'class' => 'delete-book-form'
                                ]) !!}
                                    <a href="javascript:void(0)" class="trash del-book">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        {!! Form::close() !!}
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6">
                <h6>{{ trans('form.heading.total_count') }}<span class="label label-info">{{ $books->total() }}</span></h6>
            </div>
            <div class="col-md-6">
                <div class="pull-right pagination-sm">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper-modal"></div>
@endsection
