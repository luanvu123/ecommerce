@extends('layouts.app')

@section('content')
    <style>
        .image-card {
            position: relative;
        }

        .image-card .btn-danger {
            position: absolute;
            right: 20px;
            top: 20px;
        }
    </style>
    <div class="py-5">
        <div class="container">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <h2 class="pb-3">Create Product</h2>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                        id="slug" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Đường dẫn:</strong>
                                    <input type="text" name="slug" class="form-control" placeholder="Đường dẫn"
                                        id="convert_slug">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Detail:</strong>
                                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="Price">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Giá giảm:</strong>
                                    <input type="text" name="reduced_price" class="form-control"
                                        placeholder="reduced_price">
                                    @error('reduced_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Thumbmail:</strong>
                                    <input type="file" name="image_product" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Category:</strong>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id !== null)
                                                @continue
                                            @endif
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == old('category_id')) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                            @if ($category->children)
                                                @foreach ($category->children as $child)
                                                    <option value="{{ $child->id }}"
                                                        @if ($child->id == old('category_id')) selected @endif>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Hot Deals:</strong>
                                    <select name="status" class="form-control">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>New Viral:</strong>
                                    <select name="new_viral" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Most Sold:</strong>
                                    <select name="most_sold" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <h2 class="pb-3 mt-3">Upload Image</h2>
                                <div class="mb-3">
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="image-wrapper">

                        </div>

                    </div>
                </div>
                <div class="my-3 ">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Create</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function deleteImage(id) {
            if (confirm("Are you sure you want to delete?")) {
                $("#product-image-row-" + id).remove();
            }
        }
    </script>
    <script src="{{ asset('backend/js/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            uploadprogress: function(file, progress, bytesSent) {
                $("button[type=submit]").prop('disabled', true);
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                var html = `<div class="col-md-3 mb-3" id="product-image-row-${response.image_id}">
                            <div class="card image-card">
                                <a href="#" onclick="deleteImage(${response.image_id});" class="btn btn-danger">Delete</a>
                                <img src="${response.imagePath}" alt="" class="w-100 card-img-top">
                                <div class="card-body">
                                    <input type="text" name="caption[]"  value="" class="form-control"/>
                                    <input type="hidden" name="image_id[]" value="${response.image_id}"/>
                                </div>
                            </div>
                        </div>`;
                $("#image-wrapper").append(html);
                $("button[type=submit]").prop('disabled', false);
                this.removeFile(file);
            }
        });
    </script>
@endsection
