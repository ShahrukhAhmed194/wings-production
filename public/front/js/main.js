$(document).ready(function(){
	// Disable anchor tag
	$("a[href='#']").click(function (e) { e.preventDefault(); });
});

// Alert Script
const Toast = Swal.mixin({
    toast: true,
    position: 'center-center',
    showConfirmButton: false,
    background: '#E5F3FE',
    timer: 4000
});
function cAlert(type, text){
    Toast.fire({
        icon: type,
        title: text
    });
}

// Custom loader
function cLoader(type = 'show'){
    if(type == 'show'){
        $('.loader').show();
    }else{
        $('.loader').hide();
    }
}

// Disabled link
// $(document).on('click', '.disabled', function(){
//     return preventDefault();
// });
$(".disabled").click(function(e) {
  e.preventDefault();
});

// Home Gallery Tabs
$(document).on('click', '.gallery_tab ul li', function(){
    $('.gallery_tab ul li').removeClass('active');

    $(this).addClass('active');
});

// Top fixed nav
$(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 92) {
        $('.main_header').addClass('fixed_main_header');
    }else {
        $('.main_header').removeClass('fixed_main_header');
    }
});

// Uploaded image get url
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.uploaded_img').attr('src', e.target.result);
            $('.uploaded_img').show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).on('change', ".image_upload", function(){
    readURL(this);
});
