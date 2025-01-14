
$(".page-wrapper").attr("class", "page-wrapper " + localStorage.getItem('page-wrapper'));
if (localStorage.getItem("page-wrapper") === null) {
  $(".page-wrapper").addClass("compact-wrapper");
}

// toggle sidebar
$nav = $('.rock-sidebar-wrapper');
$header = $('.rock-page-header');
$toggle_nav_top = $('.toggle-sidebar');
$toggle_nav_top.click(function () {
  // $this = $(this);
  // $nav = $('.rock-sidebar-wrapper');
  $nav.toggleClass('close_icon');
  $header.toggleClass('close_icon');
  $(window).trigger('overlay');
});


$(window).on('overlay', function () {
  $bgOverlay = $(".bg-overlay");
  $isHidden = $nav.hasClass('close_icon');
  if ($(window).width() <= 1399 && !$isHidden && $bgOverlay.length === 0) {
    $('<div class="bg-overlay active"></div>').appendTo($('body'));
  }

  if ($isHidden && $bgOverlay.length > 0) {
    $bgOverlay.remove();
  }
});

$('.rock-sidebar-wrapper .back-btn').on('click', function (e) {
  $(".rock-page-header").toggleClass("close_icon");
  $(".rock-sidebar-wrapper").toggleClass("close_icon");
  $(window).trigger('overlay');
});

$("body").on("click", ".bg-overlay", function () {
  $header.addClass("close_icon");
  $nav.addClass("close_icon");
  $(this).remove();
});

/////

$body_part_side = $('.body-part');
$body_part_side.click(function () {
  $toggle_nav_top.attr('checked', false);
  $nav.addClass('close_icon');
  $header.addClass('close_icon');
});

//    responsive sidebar
var $window = $(window);
var widthwindow = $window.width();
(function ($) {
  "use strict";
  if (widthwindow <= 1399) {
    $toggle_nav_top.attr('checked', false);
    $nav.addClass("close_icon");
    $header.addClass("close_icon");
  }
})(jQuery);
$(window).resize(function () {
  var widthwindaw = $window.width();
  if (widthwindaw <= 1399) {
    $toggle_nav_top.attr('checked', false);
    $nav.addClass("close_icon");
    $header.addClass("close_icon");
  } else {
    $toggle_nav_top.attr('checked', true);
    $nav.removeClass("close_icon");
    $header.removeClass("close_icon");
  }
});

