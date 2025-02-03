@extends('back.layouts.master')
@section('title', 'Edit Slider')

@section('master')
<form action="{{route('back.sliders.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card border-light mt-3 shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Title</b></label>
                        <input type="text" class="form-control form-control-sm" name="text_1" value="{{old('text_1') ?? $slider->text_1}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Description</b></label>

                        <textarea id="editor" class="form-control" name="description" cols="30" rows="3">{{old('description') ?? $slider->description}}</textarea>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <img class="img-thumbnail uploaded_img" style="width: 70%" src="{{$slider->img_paths['medium']}}">

                    <div class="form-group">
                        <label><b>Slider Image</b></label>
                        <div class="custom-file text-left">
                            <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-success">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection
