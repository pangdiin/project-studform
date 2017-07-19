@if(isset($data) && is_array($data))
    <ul>
        @foreach($data as $r => $row)
            <li>
                <label>
                    {!! Form::checkbox('menus['. $r['id'] .']', $row['id'], false) !!}
                    {{ $row['title'] }}
                </label>
                @include('backend.menu.forms.components.checkbox', ['data' => array_get($row, 'children')])
            </li>
        @endforeach
    </ul>
@endif
