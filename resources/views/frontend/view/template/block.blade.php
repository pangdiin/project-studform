@php 
$count = 1; 
@endphp

<div class="col-sm-12" id="descHolder" style="width: 100%;font-family:Museo-300 !important;">
    @foreach($view->getList(1) as $l => $item)
        @if($count == 1)
            <div class="col-sm-4 hidden-xs">
                <a href="#">
                    <div class="certHoldertext">
                        <span>
                       
                        </span>
                    </div>
                </a>
            </div>
        @elseif($count == 2)
            <div class="col-sm-4">
                <a >
                    <div class="certHoldertext tile-6" >
                        <h4>{{ $item->name }}</h4>
                        <div>
                            <span style="font:13px Museo-300;padding-top: 10px;">
                                {!! $item->content !!}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @else
            <div class="col-sm-4">
                <a href="{{ route('frontend.page.show', $item) }}">
                <div class="certHoldertextDL">
                    <span style="font-family:Museo-300;">
                        Download<br>
                        Product<br>
                        Materials
                    </span>
                </div>
                </a>
            </div>
        @endif
        @php 
            if($count < 3) { $count++; }else{ $count = 1; }  
        @endphp
    @endforeach
</div>