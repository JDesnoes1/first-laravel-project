@extends('admin.admin_master')

@section('admin')
<div class="col-lg-12">
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Create slider</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Slider Title</label>
                <input type="text" class="form-control" name="title" placeholder="Slider title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Slider description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Slider Image</label>
                <input type="file" class="form-control-file" name="image">
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>

</div>

@endsection