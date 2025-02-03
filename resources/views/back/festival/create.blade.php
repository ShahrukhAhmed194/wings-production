@extends('back.layouts.master')
@section('title', 'Create Festival')

@section('head')
    <!-- Select 2 -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('master')
<form action="{{ route('back.festival.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <a href="{{ route('back.festival.index') }}" class="btn btn-success btn-sm float-left mr-2"><i class="fas fa-arrow-left"></i> Back</a>
                    <h5 class="mb-0 d-inline-block text-center">Create Festival</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-thumbnail uploaded_img" src="{{asset('img/default-img.png')}}">

                            <div class="form-group text-center">
                                <label><b>Featured image</b></label>
                                <div class="custom-file text-left">
                                    <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                                    <label class="custom-file-label">Choose file...</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Main Title *</b></label>

                                <input type="text" class="form-control form-control-sm" name="main_title" placeholder="main title" value="{{old('main_title')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Title *</b></label>

                                <input type="text" class="form-control form-control-sm" name="title" placeholder="title" value="{{old('title')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Contact Number *</b></label>
                                <input type="text" class="form-control form-control-sm" placeholder="contact number" name="contact" value="{{old('contact')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Festival Date *</b></label>
                                <input type="date" class="form-control form-control-sm" name="festival_date" value="{{old('festival_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Registration Last Date *</b></label>
                                <input type="date" class="form-control form-control-sm" name="registration_last_date" value="{{old('registration_last_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Registration Fee *</b></label>
                                <input type="number" class="form-control form-control-sm" step="any" placeholder="fee amount" name="fee_amount" value="{{old('fee_amount')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Guest Fee *</b></label>
                                <input type="number" class="form-control form-control-sm" step="any" placeholder="guest fee amount" name="guest_fee_amount" value="{{ old('guest_fee_amount') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Description*</b></label>

                        <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" placeholder="Description here" required>{{old('description')}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="card border-light mt-3 shadow">
                            <div class="card-footer">
                                <button class="btn btn-success btn-block">Create</button>
                                <br>
                                <small><b>NB: *</b> marked are required field.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
    <!-- Select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        // Select2
        $('.selectpicker').selectpicker();

        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 400,
                filebrowserUploadUrl: "{{route('imageUpload')}}?",
                disableNativeSpellChecker : false,
                allowedContent: true // Allows all HTML content
            });
        });
    </script>
@endsection
