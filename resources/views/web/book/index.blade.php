@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="main">
    <div class="row wrp-book">
        <div class="col col-md-3">
            <img src="https://www.vinabook.com/images/thumbnails/product/240x/241103_p72852mbiatruoc.jpg" width="250">
        </div>
        <div class="col col-md-9 container-book">
            <div class="top-book">
                <div class="detail-book">
                    <h3 class="title-book">{{ $data['item']['book']->title }}</h3>
                    <ul>
                        <li><strong>Author: </strong>{{ $data['item']['book']->author->name }}</li>
                        <li><strong>Category: </strong>
                            <a href="{{ action('Web\SearchController@handleSearch',
                                ['category' => $data['item']['book']->category->name ]) }}">
                                {{ $data['item']['book']->category->name }}
                            </a>
                        </li>
                        <li><strong>Puslish Date: </strong>
                            {{ $data['item']['book']->publish_date->format('d-m-Y') }}
                        </li>
                    </ul>
                </div>
                <div class="rating-container rating-md rating-animate">
                    <div class="rating">
                        <span class="empty-stars">
                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                        </span>
                        <span class="filled-stars" style="width: {{ $data['item']['book']->computePercentRating() }}%;">
                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                            <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                        </span>
                    </div>
                    <br>
                    <a href="#review">{{ $data['item']['book']->reviews->count() }} review</a>
                </div>
                <div class="woo-wrapper-button" data-id="{{ $data['item']['book']->id }}">
                    <a href="javascript:void(0)" {{ modalLogin() }} class="{{ attrUser('add-favorite-book') }}">
                        @if (auth()->check() && $data['item']['book']->favoriteUsers->contains('id', auth()->user()->id))
                            <span class="glyphicon glyphicon-heart favorite-book"></span>
                            {{ trans('common.text.like') }}
                        @else
                            <span class="glyphicon glyphicon-heart"></span>
                            {{ trans('common.text.like') }}
                        @endif
                    </a>
                    <a href="javascript:void(0)" {{ modalLogin() }} class="{{ attrUser('add-status-read-book') }}"
                        data-status="1">
                        <span class="glyphicon glyphicon-check
                            {{ isset($data['item']['statusBook'])
                                ? ($data['item']['statusBook'] ? 'read-book' : '' )
                                : ''
                            }}
                        ">
                        </span>{{ trans('common.text.read') }}
                    </a>
                    <a href="javascript:void(0)" {{ modalLogin() }} class="{{ attrUser('add-status-read-book') }}"
                        data-status="0">
                        <span class="glyphicon glyphicon-eye-open
                            {{ isset($data['item']['statusBook'])
                                ? ($data['item']['statusBook'] ? '' : 'reading-book' )
                                : ''
                            }}
                        ">
                        </span>Reading
                    </a>
                </div>
                <div class="description-book">
                    <p>
                        {{ mb_strimwidth($data['item']['book']->description, 0, 500, '...') }}
                        <a href="#more">more</a>
                    </p>
                </div>
            </div>
            <div class="author-detail">
                <div class="col col col-md-6">
                    <table class="table">
                    </table>
                </div>
                <div class="colcol-md-6">

                </div>
            </div>
        </div>
    </div>
    <h4 class="border" id="more">Introduce Book</h4>
    <div class="introduce-book">
        <div class="introduce-author pull-right col-md-3">
            <h5 class="title">Information Author</h5>
            <p class="name-author">{{ $data['item']['book']->author->name }}</p>
            <p>
                {{ $data['item']['book']->author->description }}
            </p>
        </div>
        <div class="text-introduce-book">
            <p>{{ $data['item']['book']->description }}</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <h4>Detail Inforation Book</h4>
    <div class="section-detail-book">
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <td>{{ $data['item']['book']->title }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $data['item']['book']->author->name }}</td>
            </tr>
            <tr>
                <th>Numer of page</th>
                <td>{{ $data['item']['book']->number_of_pages }}</td>
            </tr>
            <tr>
                <th>Pulish day</th>
                <td>{{ $data['item']['book']->publish_date->format('d-m-Y') }}</td>
            </tr>
        </table>
    </div>
    <div class="wrapper-star">
        <div class="row">
            <div class="col col-md-6">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 text-center">
                            <h1 class="rating-num">
                                {{ $data['item']['book']->avg_rate }}</h1>
                            <div class="rating-container rating-md rating-animate">
                                <div class="rating">
                                    <span class="empty-stars">
                                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                    </span>
                                    <span class="filled-stars" style="width: {{ $data['item']['book']->computePercentRating() }}%;">
                                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class="glyphicon glyphicon-user"></span>{{ $data['item']['book']->reviews->count() }} total
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="row rating-desc">
                                @foreach($data['counter'] as $star => $count)
                                    <div class="col-xs-4 col-md-4 text-right">
                                        <span class="glyphicon glyphicon-star"></span>{{ $star }}
                                        <span class="glyphicon glyphicon-user"></span> {{ $count['countRewiewer'] }}
                                    </div>
                                    <div class="col-xs-7 col-md-8">
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $count['percentStar']  }}%">
                                                <span class="sr-only">{{ $count['percentStar'] }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- end 5 -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="request">
                    <h3>Your reivew's book was about</h3>
                    <a href="javascript:void(0)" id="{{ attrUser('see-also') }}" {{ modalLogin() }} class="btn btn-primary">
                       @if (auth()->check())
                            <i class="glyphicon glyphicon-pencil"></i> {{ 'Write Reivew' }}
                        @else
                            <i class="glyphicon glyphicon-log-inl"></i> {{ 'Login to write reivew' }}
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="box-form">
            <h4>Send reivewing for you: </h4>
            <div class="row box-review">
                <div class="col col-md-6">
                    <div class="content-form-request">
                        {!! Form::open([
                                'action' => 'Web\ReviewController@store',
                                'method' => 'POST',
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'id' => 'reivew-book-form',
                            ]) !!}
                                <div class="form-group">
                                    <label for="content">
                                        1. Star rating: <div id="star-review-book" class="pull-right"></div>
                                    </label>
                                </div>
                                {{ Form::hidden('book_id', $data['item']['book']->id) }}
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="content">
                                        2.  Title of reivew:
                                    </label>
                                        {!! Form::text('title', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('form.placeholder.name_book'),
                                            'required',
                                        ]) !!}
                                </div>
                                <div class="form-group">
                                    <label for="conent">
                                        3. This book was about:
                                    </label>
                                    {!! Form::textarea('content', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('form.placeholder.content_book'),
                                        'required',
                                    ]) !!}
                                </div>
                                <div class="pull-right">
                                    {!! Form::submit('Send', [
                                        'class' => 'btn btn-primary',
                                    ]) !!}
                                    <a href="javascript:void(0)" class="btn btn-default js-cancel">Cancel</a>
                                </div>
                                <div class="clearfix"></div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col col-md-6">

                </div>
            </div>
        </div>
    </div>
    <div class="review-block" id="review">
        <div class="row">
            @foreach($data['item']['book']->reviews as $review)
                <div class="col-sm-2 left">
                    <img src="{{ $review->user->avatarPath() }}" class="img-rounded">
                    <div class="review-block-name">
                        <a href="{{ action('Web\UserController@show', ['id' => $review->user->id]) }}">
                            {{ $review->user->name }}
                        </a>
                    </div>
                    <div class="review-block-date">{{ $review->created_at->format('F, d, Y') }}
                        <br>
                        {{ $review->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="col-sm-10 right">
                    <div class="rating-container rating-md rating-animate">
                        <div class="rating">
                            <span class="empty-stars">
                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                            </span>
                            <span class="filled-stars" style="width: {{  $review->computePercentRating() }}%;">
                                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="review-block-title">{{ $review->title }}</div>
                    <div class="review-block-description">
                        {{ $review->content }}
                    </div>
                    <div class="review-block-like">
                        <div class="pull-left">
                            @if(auth()->check() && $review->likes->contains('user_id', auth()->user()->id))
                                <span class="like-person">
                                    @if ($review->likes->count() -1)
                                        <strong>You and {{ $review->likes->count() -1 }} orthers</strong>
                                    @else
                                        <strong>You</strong>
                                    @endif
                                    thank this comment
                                </span>
                                <span class="request">Was this review helpful to you?</span>
                            @else
                                @if ($review->likes->count())
                                    <span class="like-person">
                                        <strong>{{ $review->likes->count() }} people</strong>
                                        thank this comment
                                    </span>
                                @endif
                                <span class="request">Was this review helpful to you?</span>
                                <a data-id= "{{ $review->id }}" href="javascript:void(0)" {{ modalLogin() }}
                                    class="btn btn-primary {{ attrUser('button-like') }} button-like-quickly">
                                    <span class="glyphicon glyphicon-hand-right"></span>
                                    Thanks
                                </a>
                            @endif
                        </div>
                        <div class="pull-right quick">
                            <a href="javascript:void(0)" {{ modalLogin() }} class="{{ attrUser('js-quick-rely') }} quick-rely">
                                Send Answer
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="commnet-form-request">
                            {!! Form::open([
                                    'action' => 'Web\ReviewController@handleComment',
                                    'method' => 'POST',
                                    'class' => 'form-horizontal comment-review-form',
                                    'role' => 'form',
                                ]) !!}
                                    {{ Form::hidden('review_id', $review->id) }}
                                    <div class="form-group">
                                        {!! Form::textarea('content', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('form.placeholder.name_book'),
                                            'required',
                                        ]) !!}
                                    </div>
                                    {!! Form::submit('Send', [
                                        'class' => 'btn btn-primary col-sm-offset-5 write-comment-for-review',
                                    ]) !!}
                                    <a href="javascript:void(0)"
                                        class="btn btn-default hidden-comment-form">Cancel
                                    </a>
                                    <div class="clearfix"></div>
                            {!! Form::close() !!}
                        </div>
                        <div class="box-comment">
                            @foreach($review->comments as $comment)
                                <div class="comment-review">
                                    <p><strong>{{ $comment->user->name }}</strong> has answered:</p>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            @endforeach
        </div>
    </div>
</div>
@endsection

