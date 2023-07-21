@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Meta List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('metas.create') }}"> Create New Meta</a>
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
            <th>Meta Key</th>
            <th>Meta Value</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($metas as $meta)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $meta->meta_key }}</td>
                <td>{{ $meta->meta_value }}</td>
                <td>
                    <form action="{{ route('metas.destroy', $meta->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('metas.show', $meta->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('metas.edit', $meta->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $metas->links() !!}

@endsection

