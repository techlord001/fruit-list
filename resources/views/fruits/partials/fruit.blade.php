<li>{{ $fruit->label }}
    @if ($fruit->children->isNotEmpty())

        @php
            // Sort the items alphabetically by label
            $fruits = $fruit->children->sortBy('label');
        @endphp
        
        <ul>
            @foreach ($fruits as $fruit)
                @include('fruits.partials.fruit', ['fruit' => $fruit])
                <!-- Edit button -->
                <a href="{{ route('fruits.edit', ['id' => $fruit->id]) }}">Edit</a>
            @endforeach
        </ul>
    @endif
    <!-- Edit button -->
    <a href="{{ route('fruits.edit', ['id' => $fruit->id]) }}">Edit</a>
</li>
