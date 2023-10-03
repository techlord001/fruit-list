<li>{{ $fruit->label }}
    @if($fruit->children->isNotEmpty())
        <ul>
            @foreach($fruit->children as $child)
                @include('fruits.partials.fruit', ['fruit' => $child])
                <!-- Edit button -->
                <a href="{{ route('fruits.edit', ['id' => $fruit->id]) }}">Edit</a>
            @endforeach
        </ul>
    @endif
<!-- Edit button -->
<a href="{{ route('fruits.edit', ['id' => $fruit->id]) }}">Edit</a>
</li>