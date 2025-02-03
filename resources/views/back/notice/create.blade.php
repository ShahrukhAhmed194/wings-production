@extends('back.layouts.master')
@section('title', 'Create Notice')

@section('master')
<form action="{{route('back.notice.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Title*</b></label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{old('title')}}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Description*</b></label>

                                <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label><b>Also Send Mail to</b></label>

                        <select name="send_mail_to" class="form-control form-control-sm">
                            <option value="">None</option>
                            <option value="All">All</option>
                            <option value="Executive Committee">Executive Committee</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Create</button>
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
                disableNativeSpellChecker : false,
                allowedContent: true // Allows all HTML content
            });
        });
    </script>
@endsection
