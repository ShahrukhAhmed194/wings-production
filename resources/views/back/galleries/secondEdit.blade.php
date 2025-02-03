@extends('back.layouts.master')
@section('title', 'Edit Gallery')

@section('head')

{{-- <link rel="stylesheet" href="{{asset('back/css/dropzone-custom.css')}}"> --}}
<style>
    .dropzone {
        min-height: 150px;
        border: 1px dotted #34673D;
        background: white;
        padding: 30px 10px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
    }
    .dropzone p {
        margin-top: 10%;
        font-size: 16px;
        font-weight: 700;
    }
</style>
@endsection

@section('master')
<div class="row">
    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <form action="{{route('back.second.gallery.category.update', $category->id)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Category Name*</b></label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{old('name') ?? $category->name}}">
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

            <form action="{{route('back.second.gallery.uploadPhoto')}}" method="POST" enctype="multipart/form-data" single>
                @csrf
                <div class="card-body">
                    <div class="form-group" onclick="document.getElementById('image').click();">
                        <div class="dropzone" >
                            <p>Click Here to Upload</p>
                            <input name="image" accept="image/*" id="image" type="file" multiple style="display: none;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Image Info(English) *</b></label>
                        <input type="text" class="form-control form-control-sm" name="english_title" value="{{old('english')}}">
                    </div>
                    <div class="form-group">
                        <label><b>Image Info(Arabic) *</b></label>
                        <input type="text" class="form-control form-control-sm" name="arabic_title" value="{{old('arabic')}}">
                    </div>
                </div>
                <input type="hidden" name="sec_gallery_category_id" value="{{$category->id}}">
                <input type="hidden" name="position" value="1000">

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="mb-0">Change Position</h5>
            </div>

            <form action="{{ route('back.second.gallery.changePhotoPosition') }}" method="POST">
                @csrf
                <ul class="moveContent npnls" id="sortable">
                    @foreach($second_gallery_items as $order => $item)
                        <div class="card p-2">
                            <li class="sortable-item" data-id="{{ $item->id }}">
                                <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                <div class="row align-items-center g-3">
                                    <div class="col-4 d-flex align-items-center">
                                        <i class="fa fa-arrows-alt me-2"></i>
                                        <img src="{{ $item->image_url }}" alt="Gallery Image" class="img-fluid" style="max-width: 100px;">
                                    </div>
                                    <div class="col-4">
                                        <span class="fw-bold d-block">{{$item->english_title}}</span>
                                        <span class="fw-bold d-block">{{$item->arabic_title}}</span>
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                        <a href="{{ route('back.second.gallery.deletePhoto', $item->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>                                
                            </li>
                        </div>
                    @endforeach
                </ul>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">Update Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function () {
        $("#sortable").sortable({
            update: function (event, ui) {
                $("#sortable li").each(function (index) {
                    $(this).find("input[name='position[]']").val($(this).attr("data-id"));
                });
            }
        });
    });
</script>
@endsection
