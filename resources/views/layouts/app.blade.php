<!DOCTYPE html>
@include('include.message')
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Book Reviewing - @yield('title')</title>
        {{ Html::style(elixir('css/app.css')) }}
        {{ Html::style('bower/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}
        {{ Html::style('bower/raty/lib/jquery.raty.css') }}
        @yield('style')
    </head>
    <body>
        @include('patials.header')
        <div class="wrapper">
            <div class="main">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            <div id="wrapper-modal-auth">
                @include('include.modal.user.auth')
            </div>
        </div>
        @include('patials.footer')
        {{ Html::script(elixir('js/app.js')) }}
        {{ Html::script('bower/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}
        {{ Html::script('js/laroute.js') }}
        {{ Html::script('bower/jquery-confirm/jquery.confirm.min.js') }}
        {{ Html::script('bower/raty/lib/jquery.raty.js') }}
        {{ Html::script('bower/noty/js/noty/jquery.noty.js')}}
        {{ Html::script('bower/typeahead.js/dist/typeahead.bundle.min.js') }}
        @yield('script')
        <script type="text/javascript">
            //SEACH FUNCTION
            $(document).ready(function($) {
                var books = new Bloodhound(getBloodhoundSettings('book'));
                var users = new Bloodhound(getBloodhoundSettings('user'));

                books.initialize();
                users.initialize();
                $(".search-input").typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                }, {
                    source: books,

                    // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                    name: 'bookLists',

                    limit : 3,

                    // the key from the array we want to display (name,id,email,etc...)
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>',
                        ],
                        header: [
                            '<div class="list-group"><p>BOOKS</p>'
                        ],
                        suggestion: function (datum) {
                            if (datum.status) {
                                return datum.view;
                            }
                            return '<div class="list-group-item">Nothing found.</div>';
                        },
                        display: function(suggestion) {
                           return suggestion.suggest;
                        }
                    }
                }, {
                    source: users,

                    // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                    name: 'userList',

                    limit : 3,

                    // the key from the array we want to display (name,id,email,etc...)
                    templates: {
                        empty: [

                        ],
                        header: [
                            '<div class="list-group"><p>USER</p>'
                        ],
                        suggestion: function (datum) {
                            if (datum.status) {
                                return datum.view;
                            }
                            return '<div class="list-group-item">Nothing found.</div>';
                        }
                    },
                    display: function(suggestion) {
                        return suggestion.name;
                    }
                });
            });

            //set blood hound setting
            function getBloodhoundSettings(type) {

              return {
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                /**
                 * Must return the identifier for the datum
                 */
                identify: function(datum) {
                    if (datum) {
                        return datum.id;
                    }
                },

                /**
                 * Fetch data from remote source using ajax
                 */
                remote: {
                  url: laroute.action('Web\SearchController@find'),

                  /**
                   * Prepare the settings for ajax request
                   */
                  prepare: function (query, settings) {
                    settings.type = "GET";
                    settings.contentType = "application/json; charset=UTF-8";
                    settings.data = {
                      'q' : query,
                      'type' : type
                    };

                    return settings;
                  }
                }
              }
            }
        </script>
    </body>
</html>
