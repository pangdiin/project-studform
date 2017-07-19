@extends('frontend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>Account</small>
    </h1>
@endsection
@section('content')
    <div class="row" style="margin-top: 120px;background-color: white;">
        <br>
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist" style="font-family: Museo-300;background-color: white;">
                    <li role="presentation" class="active">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.profile') }}</a>
                    </li>

                    <li role="presentation" >
                        <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                    </li>
                    @if ($logged_in_user->canChangePassword())
                        <li role="presentation">
                            <a href="#password" aria-controls="password" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.change_password') }}</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" style="background-color: #f5f8fa;">
                    <div role="tabpanel" class="tab-pane mt-30 active" id="profile">
                        @include('frontend.user.account.tabs.profile')
                    </div><!--tab panel profile-->

                    <div role="tabpanel" class="tab-pane mt-30" id="edit">
                        @include('frontend.user.account.tabs.edit')
                    </div><!--tab panel profile-->

                    @if ($logged_in_user->canChangePassword())
                        <div role="tabpanel" class="tab-pane mt-30" id="password">
                            @include('frontend.user.account.tabs.change-password')
                        </div><!--tab panel change password-->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection