@extends('front.layouts.gallery')
<!DOCTYPE html>
<html lang="en">
@section('head')
    @include('meta::manager', [
        'title' => ($settings_g['title'] ?? env('APP_NAME')) . ' -> ' . ($settings_g['slogan'] ?? 'Home')
    ])
@endsection

@section('master')

@php
    $categories = \App\Models\SecondGalleryCategory::all();
    $images = \App\Models\SecondGalleryItem::all();
@endphp
<section id="gallery-1" class="bg-color-01 wide-80 gallery-section division mt-5">
    <div class="container">
        <div class="row">	
            <div class="col-lg-10 offset-lg-1">
                <div class="section-title mb-60 text-center mt-60">	

                    <!-- Transparent Header -->	
                    <h2 class="tra-header txt-color-02">Our Gallery</h2>	

                    <!-- Title 	-->	
                    <h3 class="h3-xl txt-color-01">Beautiful Skin Starts Here</h3>	

                    <!-- Text -->	
                    <p class="p-lg txt-color-05">Aliquam a augue suscipit, luctus neque purus ipsum neque undo dolor 
                        primis libero tempus, blandit a cursus varius at magna tempor
                    </p>
                        
                </div>	
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="masonry-filter mb-40">
                    <button data-filter="*" class="is-checked">All</button>
                    @foreach ($categories as $category)
                        <button data-filter=".item-{{$category->id}}">{{$category->name}}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">	
            <div class="col-md-12 gallery-items-list">
                <div class="masonry-wrap grid-loaded">
                    @foreach ($images as $key => $image)
                    <div class="masonry-item item-{{$image->sec_gallery_category_id}}">
                        <div class="hover-overlay"> 
                            <img class="img-fluid" src="{{ asset('uploads/second-gallery/' . $image->image) }}"  height="100%" width="100%" alt="{{ $image->english_title }}" />			
                            <div class="item-overlay"></div>
                            <div class="image-description white-color">
                                <div class="image-data">
                                    <h5 class="h5-sm"><a class="image-link" href="{{ asset('uploads/second-gallery/' . $image->image) }}">{{$image->english_title}}</a></h5>
                                </div>																										 
                            </div> 
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>	
        </div>
    </div>
</section>
@endsection
</body>
</html>