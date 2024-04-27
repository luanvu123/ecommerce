@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('product-create')
                    <button class="button" type="button" onclick="window.location='{{ route('products.create') }}'">
                        <span class="button__text">Add Product</span>
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
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Nhà phân phối</th>
                                {{-- <th>Product Meta</th> --}}
                                <th>Price</th>
                                <th>Giảm giá</th>
                                <th>Số lượng nhập</th>
                                <th>Số lượng xuất</th>
                                <th>SLT</th>
                                <th>Hot Deals</th>
                                <th>New viral</th>
                                <th>Bán chạy</th>
                                <th>Ảnh Thumnail</th>
                                <th>Status</th>
                                <th>Người nhập</th>
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

                                    {{-- <td>
                                        @foreach ($product->product_meta as $met)
                                            <span class="badge badge-dark">{{ $met->meta_key }}</span>
                                        @endforeach
                                    </td> --}}
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
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" id="hotDealCheckbox_{{ $product->id }}"
                                                class="hotDeal_checkbox" value="{{ $product->hot_deals }}"
                                                {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                            <label class="terms-label" for="hotDealCheckbox_{{ $product->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                                                    class="checkbox-svg">
                                                    <mask fill="white" id="path-1-inside-{{ $product->id }}">
                                                        <rect height="200" width="200"></rect>
                                                    </mask>
                                                    <rect mask="url(#path-1-inside-{{ $product->id }})" stroke-width="40"
                                                        class="checkbox-box" height="200" width="200"></rect>
                                                    <path stroke-width="15" d="M52 111.018L76.9867 136L149 64"
                                                        class="checkbox-tick"></path>
                                                </svg>
                                            </label>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('.hotDeal_checkbox').change(function() {
                                                    var hotDeal_val = $(this).is(':checked') ? '1' :
                                                        '0'; // Convert checkbox state to '1' or '0'
                                                    var product_id = $(this).attr('id').replace('hotDealCheckbox_',
                                                        ''); // Extract product ID from checkbox ID

                                                    $.ajax({
                                                        url: "{{ route('hotDeal-choose') }}",
                                                        method: "GET",
                                                        data: {
                                                            hotDeal_val: hotDeal_val,
                                                            product_id: product_id
                                                        },
                                                    });
                                                });
                                            });
                                        </script>
                                    </td>




                                    <td>
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" id="newviralCheckbox_{{ $product->id }}"
                                                class="newviral_checkbox" value="{{ $product->new_viral }}"
                                                {{ $product->new_viral == 1 ? 'checked' : '' }}>
                                            <label class="terms-label" for="newviralCheckbox_{{ $product->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                                                    class="checkbox-svg">
                                                    <mask fill="white" id="path-1-inside-{{ $product->id }}">
                                                        <rect height="200" width="200"></rect>
                                                    </mask>
                                                    <rect mask="url(#path-1-inside-{{ $product->id }})" stroke-width="40"
                                                        class="checkbox-box" height="200" width="200"></rect>
                                                    <path stroke-width="15" d="M52 111.018L76.9867 136L149 64"
                                                        class="checkbox-tick"></path>
                                                </svg>

                                            </label>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('.newviral_checkbox').change(function() {
                                                    var newviral_val = $(this).is(':checked') ? '1' :
                                                        '0'; // Convert checkbox state to '1' or '0'
                                                    var product_id = $(this).attr('id').replace('newviralCheckbox_',
                                                        ''); // Extract product ID from checkbox ID

                                                    $.ajax({
                                                        url: "{{ route('newviral-choose') }}",
                                                        method: "GET",
                                                        data: {
                                                            newviral_val: newviral_val,
                                                            id: product_id // Use extracted product ID
                                                        },
                                                    });
                                                });
                                            });
                                        </script>
                                    </td>

                                    <td>
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" id="mostsoldCheckbox_{{ $product->id }}"
                                                class="mostsold_checkbox" value="{{ $product->most_sold }}"
                                                {{ $product->most_sold == 1 ? 'checked' : '' }}>
                                            <label class="terms-label" for="mostsoldCheckbox_{{ $product->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                                                    class="checkbox-svg">
                                                    <mask fill="white" id="path-1-inside-{{ $product->id }}">
                                                        <rect height="200" width="200"></rect>
                                                    </mask>
                                                    <rect mask="url(#path-1-inside-{{ $product->id }})"
                                                        stroke-width="40" class="checkbox-box" height="200"
                                                        width="200"></rect>
                                                    <path stroke-width="15" d="M52 111.018L76.9867 136L149 64"
                                                        class="checkbox-tick"></path>
                                                </svg>

                                            </label>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('.mostsold_checkbox').change(function() {
                                                    var mostsold_val = $(this).is(':checked') ? '1' :
                                                        '0'; // Convert checkbox state to '1' or '0'
                                                    var product_id = $(this).attr('id').replace('mostsoldCheckbox_',
                                                        ''); // Extract product ID from checkbox ID

                                                    $.ajax({
                                                        url: "{{ route('mostsold-choose') }}",
                                                        method: "GET",
                                                        data: {
                                                            mostsold_val: mostsold_val,
                                                            id: product_id
                                                        },

                                                    });
                                                });
                                            });
                                        </script>

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
                                        <label class="plane-switch">
                                            <input type="checkbox" id="statusCheckbox_{{ $product->id }}"
                                                class="plane-switch" value="{{ $product->status ? '1' : '0' }}"
                                                {{ $product->status ? 'checked' : '' }}>
                                            <div>
                                                <div>
                                                    <svg viewBox="0 0 13 13">
                                                        <path
                                                            d="M1.55989957,5.41666667 L5.51582215,5.41666667 L4.47015462,0.108333333 L4.47015462,0.108333333 C4.47015462,0.0634601974 4.49708054,0.0249592654 4.5354546,0.00851337035 L4.57707145,0 L5.36229752,0 C5.43359776,0 5.50087375,0.028779451 5.55026392,0.0782711996 L5.59317877,0.134368264 L7.13659662,2.81558333 L8.29565964,2.81666667 C8.53185377,2.81666667 8.72332694,3.01067661 8.72332694,3.25 C8.72332694,3.48932339 8.53185377,3.68333333 8.29565964,3.68333333 L7.63589819,3.68225 L8.63450135,5.41666667 L11.9308317,5.41666667 C12.5213171,5.41666667 13,5.90169152 13,6.5 C13,7.09830848 12.5213171,7.58333333 11.9308317,7.58333333 L8.63450135,7.58333333 L7.63589819,9.31666667 L8.29565964,9.31666667 C8.53185377,9.31666667 8.72332694,9.51067661 8.72332694,9.75 C8.72332694,9.98932339 8.53185377,10.1833333 8.29565964,10.1833333 L7.13659662,10.1833333 L5.59317877,12.8656317 C5.55725264,12.9280353 5.49882018,12.9724157 5.43174295,12.9907056 L5.36229752,13 L4.57707145,13 L4.55610333,12.9978962 C4.51267695,12.9890959 4.48069792,12.9547924 4.47230803,12.9134397 L4.47223088,12.8704208 L5.51582215,7.58333333 L1.55989957,7.58333333 L0.891288881,8.55114605 C0.853775374,8.60544678 0.798421006,8.64327676 0.73629202,8.65879796 L0.672314689,8.66666667 L0.106844414,8.66666667 L0.0715243949,8.66058466 L0.0715243949,8.66058466 C0.0297243066,8.6457608 0.00275502199,8.60729104 0,8.5651586 L0.00593007386,8.52254537 L0.580855011,6.85813984 C0.64492547,6.67265611 0.6577034,6.47392717 0.619193545,6.28316421 L0.580694768,6.14191703 L0.00601851064,4.48064746 C0.00203480725,4.4691314 0,4.45701613 0,4.44481314 C0,4.39994001 0.0269259152,4.36143908 0.0652999725,4.34499318 L0.106916826,4.33647981 L0.672546853,4.33647981 C0.737865848,4.33647981 0.80011301,4.36066329 0.848265401,4.40322477 L0.89131128,4.45169723 L1.55989957,5.41666667 Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <span class="street-middle"></span>
                                                <span class="cloud"></span>
                                                <span class="cloud two"></span>

                                            </div>
                                        </label>
                                        <script>
                                            $(document).ready(function() {
                                                $('.plane-switch').change(function() {
                                                    var trangthai_val = $(this).is(':checked') ? '1' :
                                                        '0'; // Convert checkbox state to '1' or '0'
                                                    var id = $(this).attr('id').replace('statusCheckbox_',
                                                        ''); // Extract product ID from checkbox ID

                                                    $.ajax({
                                                        url: "{{ route('trangthai-choose') }}",
                                                        method: "GET",
                                                        data: {
                                                            trangthai_val: trangthai_val,
                                                            id: id
                                                        },
                                                    });
                                                });
                                            });
                                        </script>
                                    </td>



                                    <td>{{ $product->user->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}"
                                            title="Edit">Sửa
                                        </a>
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-warning">Xem</a>
                                        <a href="{{ route('skus.create.product', ['product_id' => $product->id]) }}"
                                            class="btn btn-default">SKU</a>
                                        {{-- <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <img src="{{ asset('backend/images/185090_delete_garbage_icon.svg') }}"
                                                    alt="Google" width="20" height="20">
                                            </button>
                                        </form> --}}
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
