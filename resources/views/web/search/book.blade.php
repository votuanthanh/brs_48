<li class="list-group-item">
    <a href="{{ action('Web\BookController@index', ['slug' => $book->slug]) }}">
        <img src="{{ $book->imagePhoto() }}">
        <div class="detail">
            <div class="title">{{ $book->title }}</div>
            <div class="description">{{ mb_strimwidth($book->description, 0, 100, '...') }}</div>
        </div>
        <div class="rating-container rating-md rating-animate pull-left">
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
        <div class="status pull-right">
            <div class="stat">
                <span class="stat-label">
                    <i class="glyphicon glyphicon-heart favorite-book"></i> {{ trans('common.text.favorite') }}:
                </span> {{ $book->favoriteUsers->count() }}
            </div>
            <div class="stat">
                <span class="stat-label">
                    <i class="glyphicon glyphicon-check read-book"></i>{{ trans('common.text.read') }}:
                </span> {{ $book->readingUsers->count() }}
            </div>
            <div class="stat">
                <span class="stat-label">
                    <i class="glyphicon glyphicon-eye-open reading-book"></i>{{ trans('common.text.reading') }}:
                </span> {{ $book->reviewUsers->count() }}
            </div>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

