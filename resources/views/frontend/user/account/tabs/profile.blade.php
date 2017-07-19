<table class="table table-striped table-hover" style="font-family: Museo-300;">
    <tr>
        <th>{{ trans('labels.frontend.user.profile.avatar') }}</th>
        <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image-table img-circle img-thumbnail" /></td>
    </tr>
    <tr>
        <th>Username</th>
        <td>{{ $logged_in_user->name }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.email') }}</th>
        <td>{{ $logged_in_user->email }}</td>
    </tr>

    @if(count($logged_in_profile))
        <tr>
            <th>First Name</th>
            <td>{{ $logged_in_profile->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $logged_in_profile->last_name }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $logged_in_profile->address }}</td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td>{{ $logged_in_profile->contact_number }}</td>
        </tr>

        @if($logged_in_profile->card_number)
            <tr>
                <th>Card Number</th>
                <td>{{ ccMask($logged_in_profile->card_number) }}</td>
            </tr>
        @endif

        @if($logged_in_profile->card_expire)
            <tr>
                <th>Card Expiration</th>
                <td>{{ $logged_in_profile->card_expire }}</td>
            </tr>
        @endif

        @if($logged_in_profile->card_cvv)
            <tr>
                <th>Card CVV</th>
                <td>{{ $logged_in_profile->card_cvv }}</td>
            </tr>
        @endif

    @endif
    <tr>
        <th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
        <td>{{ $logged_in_user->created_at->format(config('base.date_format')) }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
        <td>{{ $logged_in_user->updated_at->format(config('base.date_format')) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
    </tr>

</table>