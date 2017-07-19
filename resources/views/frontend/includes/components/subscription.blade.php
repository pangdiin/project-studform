@permission('customer-subscribe')
    @if($logged_in_subscription && $logged_in_subscription->isExpired())
    <div class="alert alert-danger">
        <strong>Subscription Expired!</strong> Your current subscription is expired. You will not be able to access some of the features within the site. Please update your subscription to maximize the usage of the system
    </div>
    @elseif(!$logged_in_subscription)
        <div class="alert alert-danger clearfix">
            <strong>No Subscription</strong> You do not have any active subscription on the site. You will not be able to access some of the features within the site. Please update your subscription to maximize the usage of the system <a href="{{ route('frontend.subscribe.index') }}" class="btn btn-outline btn-flat pull-right">Subscribe Now!</a>
        </div>
    @endif
@endauth