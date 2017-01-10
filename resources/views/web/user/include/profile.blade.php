<div class="card hovercard">
    <div class="card-background">
        <img class="card-bkimg" alt="" src="{{ $user->avatarPath() }}">
        <!-- http://lorempixel.com/850/280/people/9/ -->
    </div>
    @if(auth()->check())
        @if($user->id != $authUser->id)
            @if($authUser->following->contains('id', $user->id))
                <a href="javascript:void(0)" class="btn btn-info btn-relationship action-relate"
                    data-id="{{ $user->id }}">
                    {{ trans('common.user.following') }}
                </a>
            @else
                <a href="javascript:void(0)" class="btn btn-default btn-relationship action-relate"
                    data-id="{{ $user->id }}">
                    {{ trans('common.user.follow') }}
                </a>
            @endif
        @endif
    @else
        <a href="javascript:void(0)" {{ modalLogin() }} class="btn btn-info btn-relationship">
            {{ trans('common.user.follow') }}
        </a>
    @endif
    <div class="useravatar">
        <img alt="" src="{{ $user->avatarPath() }}">
    </div>
    <div class="card-info"> <span class="card-title">{{ $user->name }}</span>
        <br>
        @if(auth()->check())
            @if($user->id == $authUser->id)
                <a href="#" data-toggle=modal data-target=#auth-modal class="edit-profile">
                    {{ trans('form.button.edit_profile') }}
                </a>
            @endif
        @else
            <a {{ modalLogin() }}  href="#" class="edit-profile">{{ trans('form.button.edit_profile') }}</a>
        @endif
    </div>
</div>
