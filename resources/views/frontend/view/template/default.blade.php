@php $count = 1; @endphp

<div class="col-sm-12" id="descHolder" style="width: 101.3%;">


    @foreach($view->getList(1) as $l => $item)
        @if($count == 1)
            <div class="col-sm-4 tile-1">
                <a href="{{ route('frontend.page.show', $item) }}">
                    <div class="descHoldertext">
                        <span style="font-family:Museo-300 !important;">
                            {!! str_limit(strip_tags($item->content), 100, '...') !!}
                            <br><br>
                            &gt; Learn More 
                        </span>
                    </div>
                </a>
            </div>
        @elseif($count == 2)
            <div class="col-sm-5 tile-2" >
                <div>
                    <a href="{{ route('frontend.page.show', $item) }}"><img src="{{ asset($item->image) }}"></a>
                </div>
            </div>
        @else
             <div class="col-sm-3 tile-3">
               <a href="{{ route('frontend.page.show', $item) }}"><div class="descHoldertext">
                    <span style="font-family:Museo-300 !important;">
                        <h4>{{ $item->name }}</h4>
                        {!! str_limit(strip_tags($item->content), 100, '...') !!}
                        <br><br>
                        &gt; Learn More 
                    </span>
                </div></a>
            </div>
        @endif
        @php 
            if($count < 3) { $count++; }else{ $count = 1; }  
        @endphp
    @endforeach
</div>