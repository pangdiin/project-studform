@if(count($links))
    @foreach($links as $l => $link)

        <li
            @if(count($link->nodes))
                class="{{ $isChild ? 'dropdown-submenu' : 'dropdown' }} {{ menu()->isActiveRoute($link) }}"
            @else
                class="{{ $type=="dropdown" ? '' : 'media' }} {{ menu()->isActiveRoute($link) }}"
            @endif
        >
            <a 
                
                @if(count($link->nodes))
                    @if($type == "dropdown")
                        class="dropdown-toggle disabled {{ isset($li_class) ? $li_class : '' }}" data-toggle="dropdown" 
                    @endif
                @else
                    class="{{ isset($li_class) ? $li_class : '' }}"
                @endif
                href="{{ $link->link }}"
             id="footer-items" >

                {{ $link->title }}
                @if($type=="dropdown" && count($link->nodes))
                    <b class="caret"></b> 
                @endif
                
            </a>
            @if(count($link->nodes))
                <ul class="{{ $type=="dropdown" ? 'dropdown-menu' : 'medial-list'}}">
                    @include('frontend.menu.partials.node', ['links' => $link->nodes, 'isChild' => true, 'type' => $type ])
                </ul>
            @endif

        </li>
    @endforeach
@endif