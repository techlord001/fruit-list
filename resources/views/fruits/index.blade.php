<h1>Fruits Index</h1>

<ul>
    @foreach ($fruits as $fruit)
        @include('fruits.partials.fruit', ['fruit' => $fruit])
    @endforeach
</ul>