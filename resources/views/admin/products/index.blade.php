@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('product-create')
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm Sản
                        phẩm</a>
                @endcan
                <div class="table-responsive">
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Nhà phân phối</th>
                                <th>Product Meta</th>
                                <th>Price</th>
                                <th>Giảm giá</th>
                                <th>Số lượng nhập</th>
                                <th>Số lượng xuất</th>
                                <th>SLT</th>
                                <th>Hot Deals</th>
                                <th>New viral</th>
                                <th>Most_sold</th>
                                <th>Ảnh Thumnail</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach ($products as $key => $product)
                                <tr id="{{ $product->id }}">
                                    <td>{{ $key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-primary">{{ $product->category->name }}</span>
                                    </td>
                                    <td>
                                        @if ($product->supplier)
                                            {{ $product->supplier->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>
                                        @foreach ($product->product_meta as $met)
                                            <span class="badge badge-dark">{{ $met->meta_key }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($product->reduced_price, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @php
                                            $totalQuantity = $totalQuantities[$product->id] ?? 0;
                                        @endphp
                                        {{ $totalQuantity }}
                                        <button title="Thêm số lượng">
                                            <a
                                                href="{{ route('inventories.create.product', ['product_id' => $product->id]) }}">
                                                <img src="{{ asset('backend/images/9080891_database_import_icon.svg') }}"
                                                    alt="Google" width="20" height="20">
                                            </a>
                                        </button>
                                    </td>
                                    <td>
                                        @php
                                            $totalOutgoingProduct = $outgoingProducts[$product->id] ?? 0;
                                        @endphp
                                        {{ $totalOutgoingProduct }}
                                        <button title="Xuất kho">
                                            <a
                                                href="{{ route('outgoing.products.create.product', ['product_id' => $product->id]) }}">
                                                <img src="{{ asset('backend/images/6619689_and_arrow_cart_ecommerce_export_icon.svg') }}"
                                                    alt="Google" width="20" height="20">
                                            </a>
                                        </button>
                                    </td>
                                    <td>
                                        @php
                                            $remainQuantity = $remainQuantities[$product->id] ?? 0;
                                        @endphp
                                        {{ $remainQuantity }}
                                    </td>
                                    <td>
                                        <select id="{{ $product->id }}"class="hotDeal_choose">
                                            @if ($product->hot_deals == 0)
                                                <option value="1"> Có</option>
                                                <option selected value="0">Không</option>
                                            @else
                                                <option selected value="1">Có</option>
                                                <option value="0">Không</option>
                                            @endif
                                        </select>
                                    </td>

                                    <td>
                                        <select class="newviral_choose" id="{{ $product->id }}">
                                            <option value="1" @if ($product->new_viral == 1) selected @endif>Yes
                                            </option>
                                            <option value="0" @if ($product->new_viral == 0) selected @endif>No
                                            </option>
                                        </select>
                                    </td>

                                    <td>
                                        <select class="mostsold_choose" id="{{ $product->id }}">
                                            <option value="1" @if ($product->most_sold == 1) selected @endif>Yes
                                            </option>
                                            <option value="0" @if ($product->most_sold == 0) selected @endif>No
                                            </option>
                                        </select>
                                    </td>


                                    <td>
                                        @if ($product->image_product)
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                alt="Product Image" style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <select id="{{ $product->id }}"class="trangthai_choose">
                                            @if ($product->status == 0)
                                                <option value="1">Hiển thị</option>
                                                <option selected value="0">Không</option>
                                            @else
                                                <option selected value="1">Hiển thị</option>
                                                <option value="0">Không</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                         <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}"
                                                title="Edit">
                                                <img src="{{ asset('backend/images/185042_edit_modify_icon.svg') }}"
                                                    alt="Google" width="20" height="20">
                                            </a>
                                            <a href="{{ route('products.show',$product->id) }}"
                                                class="btn btn-warning">Xem</a>
                                            <a href="{{ route('skus.create.product', ['product_id' => $product->id]) }}"
                                                class="btn btn-warning">SKU</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <img src="{{ asset('backend/images/185090_delete_garbage_icon.svg') }}"
                                                    alt="Google" width="20" height="20">
                                            </button>
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
