<div class="well">
    <div class="tab-content">
        <div class="tab-pane fade in active" >
            <div class="row">
                @if($favoriteBooks->count())
                    @foreach($favoriteBooks->load('favoriteUsers', 'readingUsers', 'author') as $book)
                        <div class="col col-md-3">
                                <!--START: INNER PRODUCT -->
                            <div class="product-inner">
                                <a href="{{ action('Web\BookController@index', ['slug' => $book->slug]) }}">
                                    <div class="product-image-box">
                                        <img src="{{ $book->imagePhoto() }}">
                                    </div>
                                    <div class="product-detail">
                                        <h3>{{ $book->title }}</h3>
                                        <span>{{ $book->author->name }}</span>
                                    </div>
                                </a>
                                <div class="woo-wrapper-button" data-id="{{ $book->id }}">
                                    @if(auth()->check())
                                        <!--Check Favorite Book-->
                                        @if($book->favoriteUsers->contains('id', $authUser->id))
                                            <a href="javascript:void(0)" class="add-favorite-book"
                                                data-toggle="tooltip" title="Remove to favorite book">
                                                <span class="glyphicon glyphicon-heart favorite-book"></span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="add-favorite-book"
                                                data-toggle="tooltip" title="Add to favorite book">
                                                <span class="glyphicon glyphicon-heart"></span>
                                            </a>
                                        @endif
                                        <!--End: Check Favorite Book-->

                                        <!--Check Status Read Book-->
                                        @if($tempUser = $book->readingUsers->where('id', $authUser->id)->first())
                                            @if($tempUser->pivot->is_completed)
                                                <a href="javascript:void(0)" class="add-status-read-book" data-status="1"
                                                    data-toggle="tooltip" title="Remove to favorite book">
                                                    <span class="glyphicon glyphicon-check read-book"></span>
                                                </a>
                                                <a href="javascript:void(0)" class="add-status-read-book" data-status="0"
                                                    data-toggle="tooltip" title="Add to reading book">
                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="add-status-read-book" data-status="1"
                                                    data-toggle="tooltip" title="Add to read book">
                                                    <span class="glyphicon glyphicon-check"></span>
                                                </a>
                                                <a href="javascript:void(0)" class="add-status-read-book" data-status="0"
                                                    data-toggle="tooltip" title="Remove to read book">
                                                    <span class="glyphicon glyphicon-eye-open reading-book"></span>
                                                </a>
                                            @endif
                                        @else
                                            <a href="javascript:void(0)" class="add-status-read-book" data-status="1"
                                                data-toggle="tooltip" title="Add to read book">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </a>
                                            <a href="javascript:void(0)" class="add-status-read-book" data-status="0"
                                                data-toggle="tooltip" title="Add to reading book">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                        @endif
                                        <!--End: Check Status Read Book-->
                                    @else
                                        <a href="javascript:void(0)" {{ modalLogin() }}
                                            data-toggle="tooltip" title="Add to favorite book">
                                            <span class="glyphicon glyphicon-heart"></span>
                                        </a>
                                        <a href="javascript:void(0)" data-status="1" {{ modalLogin()}}
                                            data-toggle="tooltip" title="Add to read book">
                                            <span class="glyphicon glyphicon-check"></span>
                                        </a>
                                        <a href="javascript:void(0)" data-status="0" {{ modalLogin() }}
                                            data-toggle="tooltip" title="Add to reading book">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <!--END: INNER PRODUCT -->
                        </div>
                    @endforeach
                @else
                    <p class="text-center">{{ trans('common.noty.book.no_favorite_book') }}</p>
                @endif
            </div>
            <div class="center">
                {{ $favoriteBooks->links() }}
            </div>
        </div>
    </div>
</div>
