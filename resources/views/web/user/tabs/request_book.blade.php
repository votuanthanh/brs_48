<div class="well">
    <div class="tab-content">
        <div class="tab-pane fade in active" >
            @if(auth()->check() && $authUser->id == $user->id)
                <div class="row">
                    <div class="col col-md-10 col-md-offset-1 wrp-request-book">
                        <h4>{{ trans('common.text.write_request') }}</h4>
                        <div class="content-form-request">
                            {!! Form::open([
                                'action' => 'Web\UserController@storeRequestBook',
                                'method' => 'POST',
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'id' => 'request-book-form',
                            ]) !!}
                                    {{ Form::hidden('user_id', $user->id) }}
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label for="content">
                                            1.  {{ trans('form.label.name_book') }}:
                                        </label>
                                            {!! Form::text('book_name', null, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('form.placeholder.name_book'),
                                                'required',
                                            ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="conent">
                                            2. {{ trans('form.label.description') }}:
                                        </label>
                                        {!! Form::textarea('description', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('form.placeholder.description'),
                                            'required',
                                        ]) !!}
                                    </div>
                                    <div class="pull-right">
                                        {!! Form::submit(trans('form.button.send_request'), [
                                            'class' => 'btn btn-primary',
                                        ]) !!}
                                    </div>
                                    <div class="clearfix"></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col col-md-10 col-md-offset-1 wrp-request-book">
                    <h4>{{ trans('common.text.list_request_book') }}</h4>
                    @if($requestBooks->count())
                        <table class="table table-hover">
                            <tr>
                                <th>{{ trans('common.text.stt') }}</th>
                                <th>{{ trans('common.text.name_book') }}</th>
                                <th>{{ trans('common.text.date_request') }}</th>
                                <th>{{ trans('common.text.status_request') }}</th>
                            </tr>
                                @foreach($requestBooks as $key => $request)
                                    <tr>
                                        <td class="key">{{ $key + 1 }}</td>
                                        <td>{{ mb_strimwidth($request->book_name, 0, 50, '...') }}</td>
                                        <td>{{ $request->created_at->format('d/m/Y A') }}</td>
                                        <td>
                                            @if(auth()->check() && $authUser->id == $user->id)
                                                    @if($request->is_accepted)
                                                        <h4>
                                                            <label class="label label-success">
                                                                {{ trans('common.text.accepted') }}
                                                            </label>
                                                        </h4>
                                                    @else
                                                        <button class="btn btn-danger cancel-request-book"
                                                            data-id-user= "{{ $user->id }}"
                                                            data-id-request="{{ $request->id }}">
                                                            {{ trans('common.text.cancel_request') }}
                                                        </button>
                                                    @endif
                                            @else
                                                @if($request->is_accepted)
                                                    <h4>
                                                        <label class="label label-success">
                                                            {{ trans('common.text.accepted') }}
                                                        </label>
                                                    </h4>
                                                @else
                                                    <h4>
                                                        <label class="label label-info">
                                                            {{ trans('common.text.not_approved') }}
                                                        </label>
                                                    </h4>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    @else
                        <p class="text-center">{{ trans('common.text.no_request')}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="centet">
            {{ $requestBooks->links() }}
        </div>
    </div>
</div>

