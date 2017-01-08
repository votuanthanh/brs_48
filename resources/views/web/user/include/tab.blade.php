<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a id="favorites"
            @if($tabCurrent == config('settings.tab.favorite_book'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show', ['id' => $user->id]) }}">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>{{ $user->favoriteBooks->count() }}
            <div class="hidden-xs"> Favorites Books</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="following"
            @if($tabCurrent == config('settings.tab.request_book'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.request_book')]) }}">
            <span class="glyphicon glyphicon-book" aria-hidden="true"></span>{{ $user->requestBooks->count() }}
            <div class="hidden-xs">Request Book</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="stars"
            @if($tabCurrent == config('settings.tab.review_book'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.review_book')]) }}">
            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>{{ $user->reviewBooks->count() }}
            <div class="hidden-xs">Review Book</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="following"
            @if($tabCurrent == config('settings.tab.reading_book'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.reading_book')]) }}">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                {{ $user->readingBooks()->wherePivot('is_completed', false)->count() }}
            <div class="hidden-xs">Reading</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="following"
            @if($tabCurrent == config('settings.tab.read_book'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.read_book')]) }}">
            <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                {{ $user->readingBooks()->wherePivot('is_completed', true)->count() }}
            <div class="hidden-xs">Read</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="following"
            @if($tabCurrent == config('settings.tab.following_users'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.following_users')]) }}">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>{{ $user->following->count()  }}
            <div class="hidden-xs">Following</div>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a id="following"
            @if($tabCurrent == config('settings.tab.followers'))
                class="btn btn-primary"
            @else
                class="btn btn-default"
            @endif
            href="{{ action('Web\UserController@show',
                ['id' => $user->id, 'tabCurrent' => config('settings.tab.followers')]) }}">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>{{ $user->followers->count() }}
            <div class="hidden-xs">Followers</div>
        </a>
    </div>
</div>
