@extends('back.layouts.master')
@section('title', 'Edit News')

@section('master')
<form action="{{route('back.news.update', $news->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-md-8">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Title*</b></label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{old('title') ?? $news->title}}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Short Description</b></label>

                                <textarea class="form-control form-control-sm" name="short_description" cols="30" rows="3">{{old('short_description') ?? $news->short_description}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Description*</b></label>

                                <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description') ?? $news->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <img class="img-thumbnail uploaded_img" src="{{$news->img_paths['small']}}">

                                    <div class="form-group text-center">
                                        <label><b>Featured image</b></label>
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta title</b></label>

                                <input type="text" class="form-control form-control-sm" name="meta_title" value="{{old('meta_title') ?? $news->meta_title}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta description</b></label>

                                <input type="text" class="form-control form-control-sm" name="meta_description" value="{{old('meta_description') ?? $news->meta_description}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta tags</b></label>

                                <input type="text" class="form-control form-control-sm" name="meta_tags" value="{{old('meta_tags') ?? $news->meta_tags}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 400,
                filebrowserUploadUrl: "{{route('imageUpload')}}?",
                allowedContent: true // Allows all HTML content
            });
        });
    </script>
@endsection
