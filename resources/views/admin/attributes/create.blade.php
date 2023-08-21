<!-- resources/views/attributes/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create Attribute</h1>
    <form action="{{ route('attributes.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
