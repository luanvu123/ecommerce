@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Icon</th>
            <th>Parent Category</th>
            <th>Trạng thái</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    @if ($category->icon)
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" class="img-thumbnail">
                    @else
                        No icon available.
                    @endif
                </td>
                <td>{{ $category->parentCategory->name ?? '-' }}</td>
                <td>
                    <select id="{{ $category->id }}"class="cate_choose">
                        @if ($category->status == 0)
                            <option value="1">Hiển thị</option>
                            <option selected value="0">Không</option>
                        @else
                            <option selected value="1">Hiển thị</option>
                            <option value="0">Không</option>
                        @endif
                    </select>
                </td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>

    {!! $categories->links() !!}
@endsection
