@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
<!-- Begin | Register Form -->
<a href="{{ action('Admin\UserController@index') }}" class="btn btn-success">
    {{ trans('form.button.back') }}
</a>
<h3>{{ trans('form.button.edit_profile') }}</h3>
<img src="{{ $user->avatarPath() }}" width="150" class="thumbnail" height="150">
<div class="row">
    <div class="col-md-7">
        {!! Form::model($user, [
            'action' => ['Admin\UserController@update', $user->id],
            'method' => 'PATCH',
            'id' => 'edit-user-form',
            'files' => true,
        ]) !!}
            {{ Form::hidden('id', $user->id) }}
            <div class="form-group">
                {!! Form::text('name', null, [
                    'class' => 'form-control',
                    'placeholder' => trans('form.placeholder.name'),
                    'autofocus',
                    'required',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::email('email', null, [
                    'class' => 'form-control',
                    'placeholder' => trans('form.placeholder.email'),
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password', [
                    'class' => 'form-control',
                    'placeholder' => trans('form.placeholder.password'),
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password_confirmation', [
                    'class' => 'form-control',
                    'placeholder' => trans('form.placeholder.confirm_password'),
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::file('avatar') !!}
            </div>
            {!! Form::submit(trans('form.button.edit_profile'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        <!-- End | Register Form -->
    </div>
</div>

@endsection
