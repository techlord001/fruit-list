<!-- Delete -->
<form method="post" action="{{ route('fruits.destroy', ['id' => $fruit->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>