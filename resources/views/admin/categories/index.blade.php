@extends('layouts.app')

@section('content')
    <div class="containe-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('product-create')
                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm Thể
                        loại</a>
                @endcan
                <div class="table-responsive">
                    <table class="table" id="tableevent">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Parent Category</th>
                                <th>Trạng thái</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr id="{{ $category->id }}">
                                    <td>{{ $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon"
                                                class="img-thumbnail">
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
                                            <a class="btn btn-info"
                                                href="{{ route('categories.show', $category->id) }}">Show</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                            @csrf
                                            {{-- @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button> --}}
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
@endsection
