@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Shipping Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('shippings.create') }}"> Create New Shipping</a>
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
            <th>Shipping Price</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($shippings as $shipping)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $shipping->name }}</td>
            <td>{{ $shipping->price }}</td>
             <td>
                        <select id="{{ $shipping->id }}"class="shipping_choose">
                            @if ($shipping->status == 0)
                                <option value="1">Hoạt động</option>
                                <option selected value="0">Ngừng hoạt động</option>
                            @else
                                <option selected value="1">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>
                            @endif
                        </select>
                    </td>
            <td>
                <form action="{{ route('shippings.destroy',$shipping->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('shippings.show',$shipping->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('shippings.edit',$shipping->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $shippings->links() !!}
@endsection

