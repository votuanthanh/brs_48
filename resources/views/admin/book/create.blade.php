@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> {{ trans('form.button.back') }}</a>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-list"></span>{{ trans('form.heading.book_create') }}
    </div>
    <div class="panel-body book-create-wrapper">
        {!! Form::open([
                'method' => 'POST',
                'class' => 'form-horizontal',
                'role' => 'form',
            ]) !!}
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">
                        {{ trans('form.label.name') }}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('form.placeholder.name_book'),
                            'required',
                        ]) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="author" class="col-sm-2 control-label">
                        {{ trans('form.label.author') }}
                    </label>
                    <div class="col-sm-4">
                         {!! Form::select('author', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'combobox form-control',]) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="category" class="col-sm-2 control-label">
                        {{ trans('form.label.category') }}
                    </label>
                    <div class="col-sm-4">
                         {!! Form::select('category', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'combobox form-control',]) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">
                        {{ trans('form.label.description') }}
                    </label>
                    <div class="col-sm-10">
                         {!! Form::textarea('description', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('form.placeholder.description'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="pulish-date" class="col-sm-2 control-label">
                        {{ trans('form.label.publish_date') }}
                    </label>
                    <div class="col-sm-10">
                         {!! Form::date('publish_date', \Carbon\Carbon::now()); !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="star" class="col-sm-2 control-label">
                        {{ trans('form.label.star') }}
                    </label>
                    <div class="col-sm-10">
                         <div id="star1"></div>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label for="content" class="col-sm-2 control-label">
                        {{ trans('form.label.pages') }}
                    </label>
                    <div class="col-sm-10">
                         {!! Form::text('pages', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('form.placeholder.pages'),
                            'required',
                        ]) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">
                        {{ trans('form.label.avatar') }}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::file('image') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                {!! Form::submit(trans('form.button.create'), [
                    'class' => 'btn btn-primary col-sm-offset-2',
                ]) !!}
            {!! Form::close() !!}
    </div>
</div>
@endsection
@include('include.modal.edit_book_form')

