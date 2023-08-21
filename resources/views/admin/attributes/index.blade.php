<!-- resources/views/attributes/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Attributes</h1>
    <a href="{{ route('attributes.create') }}" class="btn btn-primary">Create Attribute</a>
    <table class="table" id="tableevent">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>
                        <a href="{{ route('attributes.show', $attribute->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('attributes.destroy', $attribute->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this attribute?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
