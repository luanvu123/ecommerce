@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">poster List</div>

                    <div class="card-body">
                        <a href="{{ route('posters.create') }}" class="btn btn-primary mb-3">Add poster</a>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="tableevent" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Ảnh Thumnail</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="order_position">
                                @foreach ($posters as $key => $poster)
                                    <tr id="{{ $poster->id }}">
                                        <td>{{ $key }}</td>
                                        <td>{{ $poster->title_poster }}</td>
                                        <td>{{ $poster->description_poster }}</td>
                                        <td>
                                            @if ($poster->image_poster)
                                                <img src="{{ asset('/storage/' . $poster->image_poster) }}"
                                                    alt="poster Image" style="width: 100px;">
                                            @endif
                                        </td>
                                        <td>
                                            <select id="{{ $poster->id }}" class="poster_choose">
                                                @if ($poster->status == 0)
                                                    <option value="1">Hiển thị</option>
                                                    <option selected value="0">Không</option>
                                                @else
                                                    <option selected value="1">Hiển thị</option>
                                                    <option value="0">Không</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('posters.edit', $poster->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('posters.destroy', $poster->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this poster?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
