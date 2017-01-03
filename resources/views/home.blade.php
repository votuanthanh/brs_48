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
                    <a href="#">{{ trans('common.text.view_more') }}</a>
                </header>
                <div class="row">
                    @foreach($data['datas'] as $dataBook)
                        <div class="col col-md-4">
                            <!--START: INNER PRODUCT -->
                            <div class="product-inner">
                                <a href="#">
                                    <div class="product-image-box">
                                        <img src="{{ asset('images/book/'.$dataBook['book']->image) }}">
                                    </div>
                                    <div class="product-detail">
                                        <h3>{{ $dataBook['book']->title }}</h3>
                                        <span>{{ $dataBook['book']->author->name }}</span>
                                    </div>
                                </a>
                                <div class="woo-wrapper-button">
                                    @if (auth()->check())
                                        <a href="#">
                                            <span class="glyphicon glyphicon-heart
                                                {{ $dataBook['is_favorite'] ? 'favorite-book' : '' }}">
                                            </span>{{ trans('common.text.like') }}
                                        </a>
                                        <a href="#">
                                            <span class="glyphicon glyphicon-check
                                                {{ isset($dataBook['is_read'])
                                                    ? ($dataBook['is_read'] ? 'read-book' : 'reading-book')
                                                    : '' }}">
                                            </span>{{ trans('common.text.read') }}
                                        </a>
                                    @endif
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
                    <a href="#">
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
                    <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i>{{ $category->name }}</li></a>
                @endforeach
            </ul>
        </div>
    </div>
    <!--END: END SIDEBAR RIGHT -->
</div>
<div id="wrapper-modal-auth">
    @include('include.modal.user.auth')
</div>
@endsection
