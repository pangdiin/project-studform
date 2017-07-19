@if ($breadcrumbs)
    <ol class="breadcrumb" style="font-size: 15px;">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a data-toggle="tooltip" title="Click here" href="{{ $breadcrumb->url }}" style="cursor: pointer;">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active" style="cursor: default;">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endif