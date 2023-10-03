<li>{{ $fruit->label }}
    @if($fruit->children->isNotEmpty())
        <ul>
            @foreach($fruit->children as $child)
                @include('fruits.partials.fruit', ['fruit' => $child])
            @endforeach
        </ul>
    @endif
</li>