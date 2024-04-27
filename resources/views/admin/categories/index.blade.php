@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                  @can('product-create')
                    <button class="button" type="button" onclick="window.location='{{ route('categories.create') }}'">
                        <span class="button__text">Add Category</span>
                        <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                width="24" xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" x2="12" y1="5" y2="19"></line>
                                <line x1="5" x2="19" y1="12" y2="12"></line>
                            </svg></span>
                    </button>
                @endcan
                 <br/>
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
                                        <div class="checkbox-wrapper-5">
                                            <div class="check">
                                                <input type="checkbox" id="cateCheckbox_{{ $category->id }}"
                                                    class="cate_checkbox" {{ $category->status == 1 ? 'checked' : '' }}>
                                                <label for="cateCheckbox_{{ $category->id }}"></label>
                                            </div>
                                        </div>
                                    </td>

                                    <script>
                                        $(document).ready(function() {
                                            $('.cate_checkbox').change(function() {
                                                var trangthai_val = $(this).is(':checked') ? '1' :
                                                '0';
                                                var id = $(this).attr('id').replace('cateCheckbox_',
                                                '');

                                                $.ajax({
                                                    url: "{{ route('cate-choose') }}",
                                                    method: "GET",
                                                    data: {
                                                        trangthai_val: trangthai_val,
                                                        id: id
                                                    },
                                                });
                                            });
                                        });
                                    </script>

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
