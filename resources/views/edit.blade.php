@extends('layout.app')

@section('title', 'Edit')

@section('content')
 
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12" style='max-width: 600px;'>
            <h3>Edit item</h3>
            <form action="{{ route('list.update', $item) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" class="form-control" id="item" name="value" placeholder="e.g. Item #1" value="{{ $item->value }}">
                </div>

                @if ($item->image_path != "" || $item->image_path != null)
                    <label for="preview-image">Current image</label>
                    <div class="form-group" id="preview-image">
                        <img src="{{ asset('img/uploads/' . $item->image_path) }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remove" id="removeImage"> Remove image
                    </div>
                @endif

                <div class="form-group" id="imageUpload">
                    <label for="image">Image <small>(optional)</small></label>
                    <input type="file" class="form-control-file" id="image" name="image_path">
                    <small class="form-text text-muted">Choose a thumbnail for your item</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection