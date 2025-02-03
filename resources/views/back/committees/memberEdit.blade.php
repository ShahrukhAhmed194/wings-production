@extends('back.layouts.master')
@section('title', 'Edit Committee Member')

@section('head')
    <!-- Select 2 -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('master')
<form action="{{route('back.committees.memberEdit', $committeeMember->id)}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <h5 class="mb-0 d-inline-block">Edit Committee Member</h5>

                    <a href="{{route('back.committees.edit', $committeeMember->committee_id)}}" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Member*</label>
                        <select name="member" class="form-control form-control-sm" data-live-search="true" disabled>
                            <option value="" disabled>Select Member</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{$user->id == $committeeMember->committe_id}}>{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Designation*</b></label>

                                <input type="text" class="form-control form-control-sm" name="designation" value="{{old('designation') ?? $committeeMember->designation}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Position*</b></label>

                                <input type="number" class="form-control form-control-sm" name="position" value="{{old('position') ?? $committeeMember->position}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Description*</b></label>

                        <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description') ?? $committeeMember->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <img class="img-thumbnail uploaded_img" src="{{$committeeMember->img_paths['small']}}">

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
                <div class="card-footer">
                    <button class="btn btn-success">Update</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
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
