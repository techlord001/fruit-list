@php
    // Sort the items alphabetically by label
    $fruits = $fruits->sortBy('label');
@endphp

<h1>Fruits Index</h1>

<ul>
    @foreach ($fruits as $fruit)
        @include('fruits.partials.fruit', ['fruit' => $fruit])
    @endforeach
</ul>
