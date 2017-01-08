@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="row">
    <!-- MAIN-LEFT -->
    <div class="col col-md-8">
        <section class="inner-main">
            @foreach($booksEachCategory as $data)
                <header>
                    <h1>{{ $data['name_category'] }}</h1>
                    <a href="{{ action('Web\SearchController@handleSearch', ['category' => $data['name_category']]) }}">
                        {{ trans('common.text.view_more') }}
                    </a>
                </header>
                <div class="row">
                    @foreach($data['datas'] as $dataBook)
                        <div class="col col-md-4">
                            <!--START: INNER PRODUCT -->
                            <div class="product-inner">
                                <a href="{{ action('Web\BookController@index',['slug' => $dataBook['book']->slug]) }}">
                                    <div class="product-image-box">
                                        <img src="{{ asset('images/book/'.$dataBook['book']->image) }}">
                                    </div>
                                    <div class="product-detail">
                                        <h3>{{ $dataBook['book']->title }}</h3>
                                        <span>{{ $dataBook['book']->author->name }}</span>
                                    </div>
                                </a>
                                <div class="woo-wrapper-button" data-id="{{ $dataBook['book']->id }}">
                                    <a href="javascript:void(0)" class="{{ attrUser('add-favorite-book') }}"
                                        {{ modalLogin() }}>
                                        <span class="glyphicon glyphicon-heart
                                            {{ $dataBook['is_favorite'] ? 'favorite-book tooltip-remove' : 'tooltip-add' }}">
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" {{ modalLogin() }} class="add-status-read-book"
                                        data-status="1">
                                        <span class="glyphicon glyphicon-check
                                            {{ isset($dataBook['is_read'])
                                                ? ($dataBook['is_read'] ? 'read-book remove-read-book' : 'add-read-book')
                                                : '' }}">
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" {{ modalLogin() }} class="add-status-read-book"
                                        data-status = "0">
                                        <span class="glyphicon glyphicon-eye-open
                                            {{ isset($dataBook['is_read'])
                                                ? ($dataBook['is_read'] ? 'add-reading-book' : 'reading-book remove-reading-book')
                                                : '' }}">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <!--END: INNER PRODUCT -->
                        </div>
                    @endforeach
                </div>
            @endforeach
        </section>
    </div>
    <!--END: MAIN-LEFT -->
    <!--STAR: SIDEBAR RIGHT -->
    <div class="col col-md-4 top-book">
         <!--START: TOP RATED BOOK -->
        <h4><i class="glyphicon glyphicon-tags"></i>{{ trans('common.text.top_rated_book') }}</h4>
        <div class="inner-top-book">
            @foreach($bookTopRated as $book)
                <div class="book-rated-box">
                    <a href="{{ action('Web\BookController@index',['slug' => $book->slug]) }}">
                        <img src="{{ asset('images/book/'.$dataBook['book']->image) }}">
                        <div class="detail-rated-book">
                            <h5 class="title-book">{{ $book->title }}</h5>
                            <div class="rating-container rating-md rating-animate">
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
                            <p class="author-book">
                                {{ $book->author->name }}
                                <br>
                                <i class="glyphicon glyphicon-calendar"></i>{{ $book->publish_date->format('d-m-Y') }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <!--END: TOP RATED BOOK -->
        <h4><i class="glyphicon glyphicon-tags"></i>{{ trans('common.text.categories') }}</h4>
        <div class="category-box">
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ action('Web\SearchController@handleSearch', ['category' => $category->name]) }}">
                            <i class="glyphicon glyphicon-triangle-right"></i>
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--END: END SIDEBAR RIGHT -->
</div>
@endsection
