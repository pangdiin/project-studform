<div class="">
    <div class="slick_carousel">
        @foreach($view->getList(1) as $l => $item)
            @if($item->thumbnail)
                <a href="{{ $item->path ? route($item->path, $item) : '#' }}">
                    <div><img src="{{ asset($item->thumbnail) }}" > </div>
                    <div class="col-sm-12">
                        @if($item->brand)
                            <div class="col-sm-6">

                                <img src="{{ asset($item->brand->image) }}" style="width:170px;height:65px;margin-left:5px;">
                                
                            </div>

                            <div class="col-sm-6" id="bgTeal">
                                <div>
                                    <h5>{{ $item->brand->name }}</h5>
                                    <p>{!! str_limit(strip_tags($item->description), 100, '...') !!}</p>
                                    <h4> >&nbspLearn More </h4>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-6">

                                <img src="{{ asset($item->image) }}" style="width:170px;height:65px;margin-left:5px;">
                                
                            </div>

                            <div class="col-sm-6" id="bgTeal">
                                <div>
                                    <h5>{{ $item->name }}</h5>
                                    <p>{!! str_limit(strip_tags($item->description), 100, '...') !!}</p>
                                    <h4> >&nbspLearn More </h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </a>
            @else
                <a href="{{ $item->path ? route($item->path, $item) : '#' }}">
                    <div><img src="{{ asset($item->image) }}" > </div>
                    <div class="col-sm-12">
                        @if($item->brand)
                            <div class="col-sm-6">

                                <img src="{{ asset($item->brand->image) }}" style="width:170px;height:65px;margin-left:5px;">
                                
                            </div>

                            <div class="col-sm-6" id="bgTeal">
                                <div>
                                    <h5>{{ $item->brand->name }}</h5>
                                    <p>{!! str_limit(strip_tags($item->description), 100, '...') !!}</p>
                                    <h4> >&nbspLearn More </h4>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-6">

                                <img src="{{ asset($item->image) }}" style="width:170px;height:65px;margin-left:5px;">
                                
                            </div>

                            <div class="col-sm-6" id="bgTeal">
                                <div>
                                    <h5>{{ $item->name }}</h5>
                                    <p>{!! str_limit(strip_tags($item->description), 100, '...') !!}</p>
                                    <h4> >&nbspLearn More </h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </a>

            @endif
        @endforeach
    </div>
</div>
