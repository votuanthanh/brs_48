@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="col-md-12">
    @include('web.user.include.profile')
    @include('web.user.include.tab')

    @switch($tabCurrent)
        @firstcase(config('settings.tab.favorite_book'))
            @include('web.user.tabs.favorite_book')
        @breakcase

        @case(config('settings.tab.request_book'))
            @include('web.user.tabs.request_book')
        @breakcase

        @case(config('settings.tab.review_book'))
            @include('web.user.tabs.review')
        @breakcase

        @case(config('settings.tab.reading_book'))
            @include('web.user.tabs.reading')
        @breakcase

        @case(config('settings.tab.read_book'))
            @include('web.user.tabs.read')
        @breakcase

        @case(config('settings.tab.following_users'))
            @include('web.user.tabs.following')
        @breakcase

        @case(config('settings.tab.followers'))
            @include('web.user.tabs.followers')
        @breakcase

    @endswitch
</div>
@endsection
