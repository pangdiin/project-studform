@for ($i = 0; $i < $columns; $i++)
    <div class="{{ (isset($column) && $column > 0) ? ('col-sm-' . (12 / $column)) : 'media' }}">
        
    </div>
@endfor




@if(count($links))
    @foreach($links as $l => $link)
        >
	    	<a 
	    		href="{{ $link->link }}"
	    	>
                {{ $link->title }}
                @if(count($link->nodes))
                	<ul class="{{ $type=="dropdown" ? 'dropdown-menu' : 'medial-list'}}">
	                    @include('frontend.menu.partials.node', ['links' => $link->nodes, 'isChild' => true, 'type' => null])
	                </ul>
                @endif
	    	</a>
    	</div>
    @endforeach
@endif
