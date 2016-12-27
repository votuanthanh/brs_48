@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-trash"></span> {{ trans('form.button.add_new') }}</a>
<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> {{ trans('form.button.delete_all') }}</a>
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
                    <td>{{ trans('form.label.image') }}</td>
                    <td>{{ trans('form.label.author') }}</td>
                    <td>{{ trans('form.label.title') }}</td>
                    <td>{{ trans('form.label.description') }}</td>
                    <td>{{ trans('form.label.publish_date') }}</td>
                    <td>{{ trans('form.label.point') }}</td>
                    <td>{{ trans('form.label.pages') }}</td>
                    <td>{{ trans('form.label.action') }}</td>
                </tr>
                <tr>
                    <td>{{ Form::checkbox('book[]') }}</td>
                    <td>Tsadsa</td>
                    <td>Author</td>
                    <td class="td-title">dsa dsadsad dsad asd asd sad sa</td>
                    <td class="td-description">dsa dsadsad sadsad sadsad sadsad sadsad sadsad sadsad sadsad sadsad sadsad</td>
                    <td>20/10/2016 AM</td>
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
                                <span class="filled-stars" style="width: 85%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        (5.6)
                    </td>
                    <td>555</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#edit-book">
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
@include('include.modal.edit_book_form')

