<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\NewsController;
use App\Http\Controllers\Back\NoticeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\CommitteeController;
use App\Http\Controllers\Back\FrontendController;
use App\Http\Controllers\Back\GalleryController;
use App\Http\Controllers\Back\MemberController;
use App\Http\Controllers\Back\OtherPageController;
use App\Http\Controllers\Back\SliderController;

Route::get('/clear',function (){
   Artisan::call('cache:clear');
   Artisan::call('route:clear');
   Artisan::call('config:clear');
   Artisan::call('view:clear');
   return "clear";
});

/*basic page related routes*/
Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::post('member-list', [PageController::class, 'membersTable'])->name('members.table');
Route::get('member-details/{user}', [PageController::class, 'memberDetails'])->name('memberDetails');
Route::post('member-details-request', [PageController::class, 'memberDetailsRequest'])->name('memberDetailsRequest');
Route::get('gallery/{gallery}', [PageController::class, 'gallery'])->name('gallery');
Route::get('committee/member/{id}', [PageController::class, 'committeeMember'])->name('committeeMember');
Route::post('contact-us', [PageController::class, 'contactUsSubmit'])->name('contactUs');
Route::get('news/{news}', [PageController::class, 'newsDetails'])->name('newsDetails');

/*auth related routes*/
Auth::routes();
Route::get('auth-redirect', [AuthController::class, 'redirect'])->name('authRedirect');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerSubmit']);

/*member panel*/
Route::middleware(['auth','history'])->prefix('user')->group(function () {
    Route::get('form', [UserController::class, 'form'])->name('user.form');
    Route::post('form', [UserController::class, 'formSubmit']);
    Route::get('member/pay', [UserController::class, 'pay'])->name('user.pay');
    Route::get('profile', [UserController::class, 'userDashboard'])->name('userDashboard');
    Route::get('profile-edit', [UserController::class, 'profileEdit'])->name('user.profileEdit');
    Route::post('profile-edit', [UserController::class, 'profileUpdate']);
    Route::get('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('change-password', [UserController::class, 'changePasswordSubmit']);
    Route::get('registration-fees', [UserController::class, 'registrationFees'])->name('user.registrationFees');
});

// Image Upload
Route::post('image-upload',  [PageController::class, 'imageUpload'])->name('imageUpload');
// Database Page
Route::get('{slug}', [PageController::class, 'page'])->name('page');

/*
 * backend related routes
 * */
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    /*members related routes*/
    Route::get('members/report', [MemberController::class, 'report'])->name('back.members.report');
    Route::get('members/payment/report', [MemberController::class, 'paymentReport'])->name('back.members.payment.report');
    Route::resource('members', MemberController::class, ['as' => 'back']);
    Route::get('members/dd/unpaid/{user}edit', [MemberController::class, 'unpaidEdit'])->name('back.member.unpaid.edit');
    Route::post('members/table', [MemberController::class, 'membersTable'])->name('back.member.table');
    Route::post('members/approve/or/cancel/{user}/{status}', [MemberController::class, 'approveOrCancel'])->name('back.member.approveOrCancel');

    /*dashboard related routes*/
    Route::get('/', [OtherPageController::class, 'dashboard']);
    Route::get('dashboard', [OtherPageController::class, 'dashboard'])->name('dashboard');

    // Page CRUD
    Route::get('pages/remove-image/{page}', [App\Http\Controllers\Back\PageController::class, 'removeImage'])->name('admin.pages.removeImage');
    Route::resource('pages', \App\Http\Controllers\Back\PageController::class, ['as' => 'back']);

    // Menus
    Route::get('menus', [MenuController::class, 'index'])->name('back.menus.index');
    Route::post('menus/store', [MenuController::class, 'store'])->name('back.menus.store');
    Route::post('menus/store/menu-item', [MenuController::class, 'storeMenuItem'])->name('back.menus.storeMenuItem');
    Route::post('menus/menu-item/position', [MenuController::class, 'menuItemPosition'])->name('back.menus.menuItemPosition');
    Route::get('menus/destroy/{menu}', [MenuController::class, 'destroy'])->name('back.menus.destroy');
    Route::get('menus/item/destroy/{menu_item}', [MenuController::class, 'destroyItem'])->name('back.menus.destroyItem');
    Route::post('menus/item/edit-ajax', [MenuController::class, 'editItemAjax'])->name('back.menus.editItemAjax');
    Route::post('menus/item/update', [MenuController::class, 'updateItem'])->name('back.menus.updateItem');

    /*admin profile related routes*/
    Route::get('profile/update-profile', [AdminController::class, 'update_profile_page'])->name('admin.update-profile');
    Route::post('profile/update-profile/action', [AdminController::class, 'update_profile'])->name('back.admins.update.action');
    Route::post('profile/update-password', [AdminController::class, 'update_password'])->name('admin.password-update');
    Route::resource('admins', AdminController::class, ['as' => 'back']);

    /*news resource*/
    Route::resource('news', NewsController::class, ['as' => 'back']);

    /*Notice resource*/
    Route::resource('notice', NoticeController::class, ['as' => 'back']);

    /*commit related routes*/
    Route::get('committees/member-create/{committee}', [CommitteeController::class, 'memberCreate'])->name('back.committees.memberCreate');
    Route::post('committees/member-create/{committee}', [CommitteeController::class, 'memberStore']);
    Route::delete('committees/member-destroy/{id}', [CommitteeController::class, 'memberDestroy'])->name('back.committees.memberDestroy');
    Route::get('committees/member-edit/{id}', [CommitteeController::class, 'memberEdit'])->name('back.committees.memberEdit');
    Route::post('committees/member-edit/{id}', [CommitteeController::class, 'memberUpdate']);
    Route::resource('committees', CommitteeController::class, ['as' => 'back']);

    /* Gallery related routes */
    Route::post('galleries/upload-photo/{id}', [GalleryController::class, 'uploadPhoto'])->name('back.galleries.uploadPhoto');
    Route::get('galleries/delete-photo/{id}', [GalleryController::class, 'deletePhoto'])->name('back.galleries.deletePhoto');
    Route::post('galleries/change-photo-position', [GalleryController::class, 'changePhotoPosition'])->name('back.galleries.changePhotoPosition');
    Route::get('galleries/category', [GalleryController::class, 'category'])->name('back.galleries.category');
    Route::get('galleries/category/create', [GalleryController::class, 'categoryCreate'])->name('back.galleries.categoryCreate');
    Route::resource('galleries', GalleryController::class, ['as' => 'back']);

    Route::get('second/gallery/index', [GalleryController::class, 'secondGalleryIndex'])->name('back.second.gallery.index');
    Route::get('second/gallery/edit/{category_id}', [GalleryController::class, 'secondGalleryEdit'])->name('back.second.gallery.edit');
    Route::post('second/gallery/Store/category', [GalleryController::class, 'secondGalleryStoreCategory'])->name('back.second.gallery.category.store');
    Route::delete('second/gallery/delete/category/{category}', [GalleryController::class, 'secondGalleryDeleteCategory'])->name('back.second.gallery.category.destroy');
    Route::patch('second/gallery/update/category/{category}', [GalleryController::class, 'secondGalleryUpdateCategory'])->name('back.second.gallery.category.update');
    Route::post('second/gallery/upload-photo', [GalleryController::class, 'secondGalleryuploadPhoto'])->name('back.second.gallery.uploadPhoto');
    Route::get('second/gallery/delete-photo/{id}', [GalleryController::class, 'secondGallerydeletePhoto'])->name('back.second.gallery.deletePhoto');
    Route::post('second/gallery/change-photo-position', [GalleryController::class, 'secondGallerychangePhotoPosition'])->name('back.second.gallery.changePhotoPosition');
    Route::post('show/second/gallery', [GalleryController::class, 'showSecondGallery'])->name('front.second.gallery.show');
    // Route::get('second/gallery/images-with-category', [GalleryController::class, 'getSecondGalleryImagesWithCategory'])->name('front.second.gallery.image.category');

    /*frontend related routes*/
    Route::get('frontend/general', [FrontendController::class, 'general'])->name('back.frontend.general');
    Route::post('frontend/general', [FrontendController::class, 'generalStore']);

    Route::post('sliders/position', [SliderController::class, 'position'])->name('back.sliders.position');
    Route::get('sliders/delete/{slider}', [SliderController::class, 'destroy'])->name('back.sliders.delete');
    Route::resource('sliders', SliderController::class, ['as' => 'back']);
});
