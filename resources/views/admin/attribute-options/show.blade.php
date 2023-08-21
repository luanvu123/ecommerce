<!-- resources/views/attribute-options/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Attribute Option Details</h1>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $option->id }}</td>
        </tr>
        <tr>
            <th>Value:</th>
            <td>{{ $option->value }}</td>
        </tr>
        <tr>
            <th>Attribute:</th>
            <td>{{ $option->attribute->name }}</td>
        </tr>
    </table>
    <a href="{{ route('attribute-options.edit', $option->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('attribute-options.destroy', $option->id) }}" method="post" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this option?')">Delete</button>
    </form>
    <a href="{{ route('attribute-options.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
