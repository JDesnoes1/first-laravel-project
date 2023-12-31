@extends('admin.admin_master')

@section('admin')
    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

    <div class="py-12">
    <div class="container">
    <div class="row">


    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Slider</div>
            <div class="card-body">


            <form action="{{ url('/slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Update Slider title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $sliders->title }}">
                </div>

                <div class="form-group">
                    <label for="sliderDesc" class="form-label">Update Slider description</label>
                    <input type="text" name="description" class="form-control" id="sliderDesc" value="{{ $sliders->description }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Update Slider Image</label>
                    <input type="file" name="image" class="form-control" id="exampleFormControlInput1" value="{{ $sliders->image }}">
                </div>

                <div class="form-group">
                    <img src="{{ asset($sliders->image) }}" style="width: 300px; height: 400px;" alt="">
                </div>
                
                <button type="submit" class="btn btn-primary">Update Slider</button>
            </form>
            </div>
            </div>    
        </div>

            </div>    
        </div>
    </div>
@endsection
