<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.avatar') }}</th>
        <td><img src="{{ $user->picture }}" class="img-circle user-profile-image-table img-thumbnail" /></td>
    </tr>

    <tr>
        <th>Username</th>
        <td>{{ $user->username }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.email') }}</th>
        <td>{{ $user->email }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.status') }}</th>
        <td>{!! $user->status_label !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.confirmed') }}</th>
        <td>{!! $user->confirmed_label !!}</td>
    </tr>


    @php $profile = $user->profile; @endphp
    @if($profile)
        <tr>
            <th>First Name</th>
            <td>{{ $profile->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $profile->last_name }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $profile->address }}</td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td>{{ $profile->contact_number }}</td>
        </tr>

        @if($profile->card_number)
            <tr>
                <th>Card Number</th>
                <td>{{ ccMask($profile->card_number) }}</td>
            </tr>
        @endif

        @if($profile->card_expire)
            <tr>
                <th>Card Expiration</th>
                <td>{{ $profile->card_expire }}</td>
            </tr>
        @endif

        @if($profile->card_cvv)
            <tr>
                <th>Card CVV</th>
                <td>{{ $profile->card_cvv }}</td>
            </tr>
        @endif


    @endif

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.created_at') }}</th>
        <td>{{ $user->created_at->format(config('base.date_format')) }} ({{ $user->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.last_updated') }}</th>
        <td>{{ $user->updated_at->format(config('base.date_format')) }} ({{ $user->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($user->trashed())
        <tr>
            <th>{{ trans('labels.backend.access.users.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $user->deleted_at->format(config('base.date_format')) }} ({{ $user->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>

