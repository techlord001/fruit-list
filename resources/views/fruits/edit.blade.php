<!-- resources/views/fruits/edit.blade.php -->
<h1>Edit Fruit</h1>

<form method="post" action="{{ route('fruits.update', ['id' => $fruit->id]) }}">
    @csrf
    @method('PUT')
    
    <label for="label">Label:</label>
    <input type="text" name="label" id="label" value="{{ $fruit->label }}" required>

    <button type="submit">Save</button>
</form>