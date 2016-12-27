@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="row">
    <!-- MAIN-LEFT -->
    <div class="col col-md-8">
        <section class="inner-main">
            <header>
                <h1>book.category</h1>
                <a href="#">{{ trans('common.text.view_more') }}</a>
            </header>
            <div class="row">
                <div class="col col-md-4">
                    <!--START: INNER PRODUCT -->
                    <div class="product-inner">
                        <a href="#">
                            <div class="product-image-box">
                                <img src="http://demo.toko.press/bookie2/standard/wp-content/uploads/2016/06/book-15-250x333.jpg">
                            </div>
                            <div class="product-detail">
                                <h3>title</h3>
                                <span>Author</span>
                            </div>
                        </a>
                        <div class="woo-wrapper-button">
                            <a href="#">
                                <span class="glyphicon glyphicon-heart"></span>{{ trans('common.text.like') }}
                            </a>
                            <a href="#">
                                <span class="glyphicon glyphicon-check"></span>{{ trans('common.text.read') }}
                            </a>
                        </div>
                    </div>
                    <!--END: INNER PRODUCT -->
                </div>
                <div class="col col-md-4">
                    <!--START: INNER PRODUCT -->
                    <div class="product-inner">
                        <a href="#">
                            <div class="product-image-box">
                                <img src="http://demo.toko.press/bookie2/standard/wp-content/uploads/2016/06/book-15-250x333.jpg">
                            </div>
                            <div class="product-detail">
                                <h3>books.title</h3>
                                <span>author.name</span>
                            </div>
                        </a>
                        <div class="woo-wrapper-button">
                            <a href="#">
                                <span class="glyphicon glyphicon-heart"></span>{{ trans('common.text.like') }}
                            </a>
                            <a href="#">
                                <span class="glyphicon glyphicon-check"></span>{{ trans('common.text.read') }}
                            </a>
                        </div>
                    </div>
                    <!--END: INNER PRODUCT -->
                </div>
                <div class="col col-md-4">
                    <!--START: INNER PRODUCT -->
                    <div class="product-inner">
                        <a href="#">
                            <div class="product-image-box">
                                <img src="http://demo.toko.press/bookie2/standard/wp-content/uploads/2016/06/book-15-250x333.jpg">
                            </div>
                            <div class="product-detail">
                                <h3>title</h3>
                                <span>Author</span>
                            </div>
                        </a>
                        <div class="woo-wrapper-button">
                            <a href="#">
                                <span class="glyphicon glyphicon-heart"></span>{{ trans('common.text.like') }}
                            </a>
                            <a href="#">
                                <span class="glyphicon glyphicon-check"></span>{{ trans('common.text.read') }}
                            </a>
                        </div>
                    </div>
                    <!--END: INNER PRODUCT -->
                </div>
            </div>
        </section>
    </div>
    <!--END: MAIN-LEFT -->
    <!--STAR: SIDEBAR RIGHT -->
    <div class="col col-md-4 top-book">
         <!--START: TOP RATED BOOK -->
        <h4><i class="glyphicon glyphicon-tags"></i>{{ trans('common.text.top_rated_book') }}</h4>
        <div class="inner-top-book">
            <div class="book-rated-box">
                <a href="#">
                    <img src="https://demo.themeisle.com/bookrev/wp-content/uploads/sites/3/2014/07/recipe-book-front-cover-2-238x300.jpg">
                    <div class="detail-rated-book">
                        <h5 class="title-book">Trai dat day la cua chung minh</h5>
                        <div class="rating-container rating-md rating-animate">
                            <div class="rating">
                                <span class="empty-stars">
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                </span>
                                <span class="filled-stars" style="width: 30%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        <p class="author-book">
                            author <br>
                            <i class="glyphicon glyphicon-calendar"></i>25/20/2017
                        </p>
                    </div>
                </a>
            </div>
            <div class="book-rated-box">
                <a href="#">
                    <img src="https://demo.themeisle.com/bookrev/wp-content/uploads/sites/3/2014/07/recipe-book-front-cover-2-238x300.jpg">
                    <div class="detail-rated-book">
                        <h5 class="title-book">Trai dat day la cua chung minh</h5>
                        <div class="rating-container rating-md rating-animate">
                            <div class="rating">
                                <span class="empty-stars">
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                </span>
                                <span class="filled-stars" style="width: 65%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        <p class="author-book">
                            author <br>
                            <i class="glyphicon glyphicon-calendar"></i>25/20/2017
                        </p>
                    </div>
                </a>
            </div>
            <div class="book-rated-box">
                <a href="#">
                    <img src="https://demo.themeisle.com/bookrev/wp-content/uploads/sites/3/2014/07/recipe-book-front-cover-2-238x300.jpg">
                    <div class="detail-rated-book">
                        <h5 class="title-book">Trai dat day la cua chung minh</h5>
                        <div class="rating-container rating-md rating-animate">
                            <div class="rating">
                                <span class="empty-stars">
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                </span>
                                <span class="filled-stars" style="width: 65%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        <p class="author-book">
                            author <br>
                            <i class="glyphicon glyphicon-calendar"></i>25/20/2017
                        </p>
                    </div>
                </a>
            </div>
            <div class="book-rated-box">
                <a href="#">
                    <img src="https://demo.themeisle.com/bookrev/wp-content/uploads/sites/3/2014/07/recipe-book-front-cover-2-238x300.jpg">
                    <div class="detail-rated-book">
                        <h5 class="title-book">Trai dat day la cua chung minh</h5>
                        <div class="rating-container rating-md rating-animate">
                            <div class="rating">
                                <span class="empty-stars">
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                </span>
                                <span class="filled-stars" style="width: 65%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        <p class="author-book">
                            author <br>
                            <i class="glyphicon glyphicon-calendar"></i>25/20/2017
                        </p>
                    </div>
                </a>
            </div>
            <div class="book-rated-box">
                <a href="#">
                    <img src="https://demo.themeisle.com/bookrev/wp-content/uploads/sites/3/2014/07/recipe-book-front-cover-2-238x300.jpg">
                    <div class="detail-rated-book">
                        <h5 class="title-book">Trai dat day la cua chung minh</h5>
                        <div class="rating-container rating-md rating-animate">
                            <div class="rating">
                                <span class="empty-stars">
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                </span>
                                <span class="filled-stars" style="width: 65%;">
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                </span>
                            </div>
                        </div>
                        <p class="author-book">
                            author <br>
                            <i class="glyphicon glyphicon-calendar"></i>25/20/2017
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!--END: TOP RATED BOOK -->
        <h4><i class="glyphicon glyphicon-tags"></i>{{ trans('common.text.categories') }}</h4>
        <div class="category-box">
            <ul>
                <li><a href=""><i class="glyphicon glyphicon-triangle-right"></i>PHP</li></a>
                <li><a href=""><i class="glyphicon glyphicon-triangle-right"></i>HTML</li></a>
                <li><a href=""><i class="glyphicon glyphicon-triangle-right"></i>CSS</li></a>
            </ul>
        </div>
    </div>
    <!--END: END SIDEBAR RIGHT -->
</div>
@endsection
<div id="wrapper-modal-auth">
    @include('include.modal_auth_form')
</div>
