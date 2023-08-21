<!-- resources/views/attributes/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Attribute</h1>
    <form action="{{ route('attributes.update', $attribute->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $attribute->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
