<li class="list-group-item">
    <a href="{{ action('Web\UserController@show', ['id' => $user->id]) }}">
        <img src="{{ $user->avatarPath() }}">
        <div class="detail">
            <div class="title">{{ $user->name }}</div>
            <div class="description">{{ $user->email }}</div>
        </div>
        <div class="status pull-right">
            <div class="stat">
                <span class="stat-label">
                {{ trans('common.text.followers') }}: </span> {{ $user->followers->count() }}
            </div>
            <div class="stat">
                <span class="stat-label">
                {{ trans('common.text.following') }} </span> {{ $user->following->count() }}
            </div>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

