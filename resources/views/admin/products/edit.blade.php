@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-5">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif


            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                        placeholder="Name" id="slug" onkeyup="ChangeToSlug()">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Đường dẫn:</strong>
                                    <input type="text" name="slug" value="{{ $product->slug }}" class="form-control"
                                        placeholder="Đường dẫn" id="convert_slug">
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
                                                @if ($category->id === $product->category_id ? 'selected' : '') selected @endif>
                                                {{ $category->name }}
                                            </option>
                                            @if ($category->children)
                                                @foreach ($category->children as $child)
                                                    @if ($child->status == 1)
                                                        <option value="{{ $child->id }}"
                                                            @if ($child->id === $product->category_id ? 'selected' : '') selected @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="supplier_id">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control">
                                        <option value="">Select a supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $supplier->id == $product->supplier_id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Detail:</strong>
                                    <textarea class="form-control" id="ckeditor2" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                                </div>
                            </div>
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea class="form-control" id="ckeditor4" name="description" placeholder="Description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                                        placeholder="Price">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Giá giảm:</strong>
                                    <input type="text" name="reduced_price" value="{{ $product->reduced_price }}"
                                        class="form-control" placeholder="reduced_price">
                                    @error('reduced_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Thumbmail:</strong>
                                    <input type="file" name="image_product" class="form-control-file">
                                    @if ($product->image_product)
                                        <img src="{{ asset('storage/' . $product->image_product) }}" alt="Product Image"
                                            style="width: 200px;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Hot Deals:</strong>
                                    <select id="{{ $product->id }}"name="hot_deals"class="hotDeal_choose">
                                        @if ($product->hot_deals == 0)
                                            <option value="1"> Có</option>
                                            <option selected value="0">Không</option>
                                        @else
                                            <option selected value="1">Có</option>
                                            <option value="0">Không</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    <select id="{{ $product->id }}"name="status"class="trangthai_choose">
                                        @if ($product->status == 0)
                                            <option value="1">Hiển thị</option>
                                            <option selected value="0">Không</option>
                                        @else
                                            <option selected value="1">Hiển thị</option>
                                            <option value="0">Không</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>New Viral:</strong>
                                    <select id="{{ $product->id }}"name="new_viral"class="newviral_choose">
                                        @if ($product->new_viral == 0)
                                            <option value="1">Hiển thị</option>
                                            <option selected value="0">Có</option>
                                        @else
                                            <option selected value="1">Có</option>
                                            <option value="0">Không</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="meta">Product Meta</label><br>
                                    @foreach ($list_metas as $key => $met)
                                        @if ($met->status == 1)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="meta[]"
                                                    value="{{ $met->id }}"
                                                    @if ($product->product_meta->contains($met->id)) checked @endif>
                                                <label class="form-check-label"
                                                    for="meta">{{ $met->meta_key }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Bán chạy:</strong>
                                    <select id="{{ $product->id }}"name="most_sold"class="mostsold_choose">
                                        @if ($product->most_sold == 0)
                                            <option value="1">Có</option>
                                            <option selected value="0">Không</option>
                                        @else
                                            <option selected value="1">Có</option>
                                            <option value="0">Không</option>
                                        @endif
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
                            @if ($productImages->isNotEmpty())
                                @foreach ($productImages as $productImage)
                                    <div class="col-md-3 mb-3" id="product-image-row-{{ $productImage->id }}">
                                        <div class="card image-card">
                                            <a href="#" onclick="deleteImage({{ $productImage->id }});"
                                                class="btn btn-danger">Delete</a>
                                            <img src="{{ asset('uploads/products/small/' . $productImage->name) }}"
                                                alt="" class="w-100 card-img-top">
                                            <div class="card-body">
                                                <input type="text" name="caption[]"
                                                    value="{{ $productImage->caption }}" class="form-control" />

                                                <input type="hidden" name="image_id[]" value="{{ $productImage->id }}"
                                                    class="form-control" />

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <style>
                            #image-wrapper {
                                display: flex;
                                flex-wrap: wrap;
                                justify-content: space-between;
                            }

                            .col-md-3.mb-3 {
                                flex: 0 0 calc(25% - 20px);
                                /* Chỉnh kích thước cho 4 cột trong 1 hàng, cách nhau 20px */
                                margin-bottom: 20px;
                            }

                            .card {
                                width: 100%;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                overflow: hidden;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            }

                            .card img {
                                width: 100%;
                                height: 200px;
                                object-fit: cover;
                            }

                            .card-body {
                                padding: 10px;
                            }

                            .card-body input[type="text"] {
                                width: 100%;
                                border: 1px solid #ccc;
                                border-radius: 3px;
                                padding: 5px;
                                margin-top: 10px;
                            }

                            .btn-danger {
                                position: absolute;
                                top: 5px;
                                right: 5px;
                                padding: 5px 10px;
                                color: #fff;
                                background-color: #dc3545;
                                border: none;
                                border-radius: 3px;
                                cursor: pointer;
                                transition: background-color 0.3s;
                            }

                            .btn-danger:hover {
                                background-color: #c82333;
                            }
                        </style>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend/js/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        var product_id = {{ $product->id }}
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            uploadprogress: function(file, progress, bytesSent) {
                $("button[type=submit]").prop('disabled', true);
            },
            url: "{{ route('product-images.store') }}",
            params: {
                product_id: product_id
            },
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


        function deleteImage(id) {
            if (confirm("Are you sure you want to delete?")) {
                var URL = "{{ route('product-images.delete', 'ID') }}";
                newURL = URL.replace('ID', id)

                $("#product-image-row-" + id).remove();

                $.ajax({
                    url: newURL,
                    data: {},
                    method: 'delete',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = '{{ route('products.edit', $product->id) }}';
                    }
                });
            }
        }
    </script>
@endsection
