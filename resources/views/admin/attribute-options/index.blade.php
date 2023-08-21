<!-- resources/views/attribute-options/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Attribute Options</h1>
    <a href="{{ route('attribute-options.create') }}" class="btn btn-primary">Create Attribute Option</a>
    <table class="table" id="tableevent">
        <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Attribute</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributeOptions as $option)
                <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->value }}</td>
                    <td>{{ $option->attribute->name }}</td>
                    <td>
                        <a href="{{ route('attribute-options.show', $option->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('attribute-options.edit', $option->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('attribute-options.destroy', $option->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this option?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
