<!-- Begin | Register Form -->
{!! Form::model($book, [
    'action' => ['Admin\BookController@update', $book->id],
    'method' => 'PATCH',
    'id' => 'book-form',
    'files' => true,
]) !!}
    <div class="modal-body">
        <div id="div-update-book-msg">
            <div id="icon-update-book-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-update-book-msg">{{ trans('form.heading.update_book') }}</span>
        </div>
        <div class="form-group">
            {!! Form::text('title', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.name_book'),
                'autofocus',
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::select('author', $optionAuthor, $book->author->id, [
                'class' => 'combobox form-control',
                'data-placeholder' => trans('form.placeholder.author'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::select('category', $optionCategory, $book->category->id, [
                'class' => 'combobox1 form-control',
                'data-placeholder' => trans('form.placeholder.category'),
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::textarea('description', null, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.description'),
                'autofocus',
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            <label>{{ trans('form.label.publish_date') }}</label>
            {!! Form::date('publish_date', $book->publish_date->format('Y-m-d')); !!}
        </div>
        <div class="form-group">
            <div id="star-book-update"></div>
        </div>
        <div class="form-group">
            {!! Form::text('pages', $book->number_of_pages, [
                'class' => 'form-control',
                'placeholder' => trans('form.placeholder.pages'),
                'required',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::file('image') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        <div>
            {!! Form::submit(trans('form.button.update'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
<!-- End | Register Form -->
