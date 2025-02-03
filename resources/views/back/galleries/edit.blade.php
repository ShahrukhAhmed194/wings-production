@extends('back.layouts.master')
@section('title', 'Edit Gallery')

@section('head')

<style>
    .moveContent {
    }
    .moveContent li {
        border: 1px solid #ddd;
        background: #717384;
        color: #fff;
        padding: 5px 12px;
        margin: 7px 0;
        border-radius: 3px;
        transition: .1s;
    }
    .moveContent li img {
        height: 80px;
        display: inline-block;
        max-width: 115px;
        object-fit: cover;
    }
    .moveContent li:hover {
        cursor: pointer
    }
    .editImageBox {
        position: relative;
    }
    .editImageBox .delete {
        position: absolute;
        top: 5px;
        right: 7px;
        font-size: 27px;
        color: #E02D1B;
        z-index: 99;
    }
    .editImageBox .edit {
        position: absolute;
        top: 50px;
        right: 7px;
        font-size: 27px;
        color: #258391;
        z-index: 99;
    }
    .editImageBox .delete:hover, .editImageBox .edit:hover {
        cursor: pointer;
        color: #161711;
    }
</style>

<link rel="stylesheet" href="{{asset('back/css/dropzone-custom.css')}}">
@endsection

@section('master')
<div class="row">
    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <form action="{{route('back.galleries.update', $gallery->id)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Gallery Name*</b></label>

                        <input type="text" class="form-control form-control-sm" name="name" value="{{old('name') ?? $gallery->name}}">
                    </div>

                    <div class="form-group">
                        <label><b>Position*</b></label>

                        <input type="number" class="form-control form-control-sm" name="position" value="{{old('position') ?? $gallery->position}}">
                    </div>

                    <div class="form-group">
                        <label><b>Category</b></label>

                        <select name="category" class="form-control form-control-sm">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $gallery->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="mb-0">Upload Image</h5>
            </div>

            <form action="{{route('back.galleries.update', $gallery->id)}}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="dropzone">
                        <div class="fallback">
                            <input name="file" accept="image/*" type="file" multiple />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('back.galleries.edit', $gallery->id)}}" class="btn btn-success btn-block">Done</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="mb-0">Change Position</h5>
            </div>

            <form action="{{route('back.galleries.changePhotoPosition')}}" method="POST">
                @csrf

                <div class="card-body">
                    <ul class="moveContent npnls">
                        @foreach($gallery->GalleryItems as $item)
                            <li class="{{$item->id}}">
                                <i class="fa fa-arrows-alt"></i>
                                <img src="{{$item->img_paths['small']}}" >

                                <input type="hidden" name="position[]" value="{{$item->id}}">

                                <div class="float-right">
                                    <a href="{{route('back.galleries.deletePhoto', $item->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <!-- dropzone -->
    <script src="{{asset('back/js/dropzone.js')}}"></script>

    <script src="{{asset('back/js/jquery-sortable.js')}}"></script>

    <script>
        $(function () {
            $(".moveContent").sortable();
        });

        // dropzone
        $(".dropzone").dropzone({
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
            // previewTemplate: document.getElementById('preview-template').innerHTML,
            url: "{{route('back.galleries.uploadPhoto', $gallery->id)}}",
            success: function(file, response){
                this.on("addedfile", function(file) {
                    // Check if file already exists in the dropzone
                    let existingFiles = this.getAcceptedFiles();
                    if (existingFiles.some(existingFile => existingFile.name === file.name)) {
                        this.removeFile(file);
                        alert("File already added.");
                    }
                });
                this.on("success", function(file, response) {
                    // Append hidden input with file ID to the form
                    $('.dropzone').append('<input type="hidden" name="gallery_items[]" value="'+ response.file_id+'">');
                });
            }
        });
    </script>
@endsection
