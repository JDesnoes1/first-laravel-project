<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brands
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="container">
    <div class="row">


    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Brand</div>
            <div class="card-body">


            <form action="{{ url('brand/update/'.$brands->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Update Brand Name</label>
                    <input type="text" name="brand_name" class="form-control" id="exampleFormControlInput1" value="{{ $brands->brand_name }}">

                    @error('brand_name')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Update Brand Image</label>
                    <input type="file" name="brand_image" class="form-control" id="exampleFormControlInput1" value="{{ $brands->brand_image }}">

                    @error('brand_image')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group">
                    <img src="{{ asset($brands->brand_image) }}" style="width: 300px; height: 400px;" alt="">
                </div>
                
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
            </div>
            </div>    
        </div>

            </div>    
        </div>
    </div>
</x-app-layout>
