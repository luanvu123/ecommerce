@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Meta</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('metas.index') }}"> Back</a>
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

    <form action="{{ route('metas.update', $meta->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Meta Key:</strong>
                    <input type="text" name="meta_key" value="{{ $meta->meta_key }}" class="form-control"
                        placeholder="Meta Key">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Meta Value:</strong>
                    <input type="text" name="meta_value" value="{{ $meta->meta_value }}" class="form-control"
                        placeholder="Meta Value">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select id="{{ $meta->id }}"name="status"class="meta_choose">
                        @if ($meta->status == 0)
                            <option value="1">Hiển thị</option>
                            <option selected value="0">Không</option>
                        @else
                            <option selected value="1">Hiển thị</option>
                            <option value="0">Không</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
