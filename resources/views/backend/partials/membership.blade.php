<div class="box box-primary ">
    <div class="box-header with-border">
        <h3 class="box-title">Recently Added Membership</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body" style="min-height: 408px;max-height: 408px;">
       <div class="table-responsive">
           <table id="content-table" class="data-table table table-condensed table-hover" >
                <thead>
                    <tr >
                        <th class="text-center">Name</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Last Modified</th>
                    </tr>
                </thead>
                @if(count($memberships))

                    @foreach($memberships as $m => $membership)
                        <tr class="text-center clickable-row" data-toggle="tooltip" data-placement="top" title="Click here" onclick="window.location.href='{{ route('admin.membership.show', $membership) }}'" style="cursor:pointer;">
                            <td>{{ $membership->name }}</td>
                            <td>{{ number_format($membership->cost) }}</td>
                            <td>{{ $membership->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
              
                @else
                    <tr>
                        <td colspan="4"> No membership available</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="box-footer text-center">
        <a href="{{ route('admin.membership.index') }}" class="uppercase">View All Membership</a>
    </div>
</div>