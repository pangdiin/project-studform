<div class="box box-danger ">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Members</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body no-padding" style="min-height: 408px;max-height: 408px;">
        @if(count($users))
            <ul class="users-list clearfix">
                @foreach($users as $u => $user)
                    <li>
                        <img src="{{ $user->picture }}" alt="User Image">
                        <a class="users-list-name" href="{{ route('admin.access.user.show', $user) }}">{{ $user->name }}</a>
                        <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>            
        @else
            <div class="text-center">
                There are no users registered yet.
            </div>
        @endif
            
        </ul>
    </div>
    <div class="box-footer text-center">
        <a href="javascript:void(0)" class="uppercase">View All Users</a>
    </div>
</div>