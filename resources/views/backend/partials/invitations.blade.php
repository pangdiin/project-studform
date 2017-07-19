<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Invitation</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body" style="min-height: 408px;max-height: 408px;">
        <div class="table-responsive">
            <table id="users-table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Date sent</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                @if(count($invites))

                    @foreach($invites as $i => $invite)
                        <tr class="text-center clickable-row" data-toggle="tooltip" data-placement="top" title="Click here" onclick="window.location.href='{{ route('admin.invite.show', $invite) }}'" style="cursor:pointer;">
                            <td>{{ $invite->first_name }} {{ $invite->last_name }}</td>
                            <td>{{ $invite->email }}</td>
                            <td>{{ $invite->created_at->diffForHumans() }}</td>
                            <td>
                                @if($invite->status==1)
                                    <span class="label label-warning">Pending</span>
                                @elseif($invite->status==2)
                                    <span class="label label-success">Complete</span>
                                @else 
                                    <span class="label label-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
              
                @else
                    <tr>
                        <td colspan="4" class="text-center"> No membership available</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="box-footer text-center">
        <a href="{{ route('admin.invite.index') }}" class="uppercase">View All Invitations</a>
    </div>
</div>