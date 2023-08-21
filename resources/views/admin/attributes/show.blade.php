<!-- resources/views/attributes/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Attribute Details</h1>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $attribute->id }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $attribute->name }}</td>
        </tr>
    </table>
    <a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('attributes.destroy', $attribute->id) }}" method="post" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this attribute?')">Delete</button>
    </form>
    <a href="{{ route('attributes.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
