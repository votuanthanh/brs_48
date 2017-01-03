@if (session()->has('flash_notification.message') || count($errors) > 0)
    <div class="alert alert-{{ session('flash_notification.level') ? session('flash_notification.level') : 'danger' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
