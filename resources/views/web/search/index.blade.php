@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <hgroup class="mb20">
        <h1>Search Results</h1>
        <h2 class="lead">
            <strong class="text-danger">{{ $books->total() }}</strong>
            results were found for the search for
            <strong class="text-danger">
                @if(app('request')->has('q'))
                    {{ app('request')->get('q') }}
                @endif

                @if(app('request')->has('category'))
                    {{ app('request')->get('category') }}
                @endif
            </strong>
        </h2>
    </hgroup>
    <div class="row">
        <section class="col-xs-8 col-sm-6 col-md-9">
            @foreach($books as $book)
                <article class="search-result row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <a href="{{ action('Web\BookController@index', ['slug' => $book->slug]) }}"
                            title="Lorem ipsum" class="thumbnail">
                            <img src="{{ asset('images/book/'.$book->image) }}" alt="Lorem ipsum" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <ul class="meta-search">
                            <li>
                                <i class="glyphicon glyphicon-calendar"></i>
                                <span>{{ $book->publish_date->format('d/m/Y') }}</span>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ $book->author->name }}</span>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-tags"></i>
                                <span>{{ $book->category->name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                        <h3>
                            <a href="{{ action('Web\BookController@index', ['slug' => $book->slug]) }}"
                            title="">
                                {{ $book->title }}
                            </a>
                        </h3>
                        <p>{{ mb_strimwidth($book->description, 0, 300, '...') }}</p>
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
                    <span class="clearfix"></span>
                </article>
            @endforeach
        </section>
        <section class="col-md-3">
            <h4><i class="glyphicon glyphicon-tags"></i>{{ trans('common.text.categories') }}</h4>
            <div class="category-box-search">
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
        </section>
    </div>
    <div class="center">
        {{ $books->links('vendor.pagination.search_book') }}
    </div>
@endsection
