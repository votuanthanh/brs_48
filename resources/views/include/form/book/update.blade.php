<!-- Begin | Register Form -->
{!! Form::open([
    'method' => 'POST',
    'id' => 'update-book-form',
]) !!}
    <div class="modal-body">
        <div id="div-update-book-msg">
            <div id="icon-update-book-msg" class="glyphicon glyphicon-chevron-right"></div>
            <span id="text-update-book-msg">{{ trans('form.heading.update_book') }}</span>
        </div>
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.name_book'),
            'autofocus',
            'required',
        ]) !!}

        {!! Form::select('author', ['L' => 'Large', 'S' => 'Small'], 'S', ['class' => 'combobox form-control',]) !!}

        {!! Form::select('category', ['L' => 'Large', 'S' => 'Small'], 'S', ['class' => 'combobox form-control']) !!}

        {!! Form::textarea('description', null, [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.description'),
            'autofocus',
            'required',
        ]) !!}

        {!! Form::date('publish_date', \Carbon\Carbon::now()); !!} <label>{{ trans('form.label.publish_date') }}</label>

        <div id="star"></div>

        {!! Form::text('pages', null, [
            'class' => 'form-control',
            'placeholder' => trans('form.placeholder.pages'),
            'required',
        ]) !!}

        {!! Form::file('image') !!}
    </div>
    <div class="modal-footer">
        <div>
            {!! Form::submit(trans('form.button.update'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
<!-- End | Register Form -->
