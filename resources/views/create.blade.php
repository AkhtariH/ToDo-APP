@extends('layout.app')

@section('title', 'Create')

@section('content')

    
    <div class="row" style="justify-content: center !important;">
        <div class="col-md-12" style='max-width: 600px;'>
            <h3>Add item to your ToDo list</h3>
            <form action="{{ route('list.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" class="form-control" id="item" name="value" placeholder="e.g. Item #1">
                </div>
                <div class="form-group">
                    <label for="image">Image <small>(optional)</small></label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-text text-muted">Choose a thumbnail for your item</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



@endsection