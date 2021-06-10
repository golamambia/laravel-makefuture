jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 50) {
    jQuery(".header_area").addClass("fix");
  } else {
    jQuery(".header_area").removeClass("fix");
  }
});

 




	jQuery(document).ready(function() {
        jQuery(".menu li").find("ul").parent().append("<span></span>");
       jQuery(".menuButton").click(function() {
           jQuery( ".menuButton" ).toggleClass( "arrow_change" );
		 	jQuery(".menuButton + ul").slideToggle(); 
		});
	   jQuery(".menu ul li span").click(function(){
           if(jQuery("span").parent().children("ul").is(":visible")){
               jQuery(this).parent().siblings().children("ul").slideUp();
           }
            jQuery(this).parent().children("ul").slideToggle();  
    });
    });
 
 jQuery(".myAccount span").click(function() {
           jQuery( ".myAccount span" ).toggleClass( "arrow_change" );
		 	jQuery(".myAccountDropdown").slideToggle(); 
		});





jQuery('.ourpartners-carousel').owlCarousel({
    loop:false,
    autoplay:true,
    margin:10,
    dots:true,
    nav:false,
    navText:[],
    autoplayHoverPause: true,
    responsive:{
      0:{
        items:2
      },
      480:{
        items:2
      },
      992:{
        items:4
      },
      1199:{
        items:5
      }
    }
  });

$(document).ready(function () {
  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  var totalslides = 10;
 var syncedSecondary = true;

  bigimage
    .owlCarousel({
      items: 1,
      slideSpeed: 2000,
      nav: false,
      autoplay: true,
      dots: false,
      loop: true,
      responsiveRefreshRate: 200,
      navText: [
        '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
        '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
      ],
    })
    .on("changed.owl.carousel", syncPosition);

 thumbs
   .on("initialized.owl.carousel", function () {
     thumbs.find(".owl-item").eq(0).addClass("current");
   })
   .owlCarousel({
     items: 3,
     dots: false,
     nav: false,
     navText: [
       '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
       '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
     ],
     margin: 15,
     smartSpeed: 200,
     slideSpeed: 500,
     slideBy: 1,
     responsiveRefreshRate: 100,
     responsive: {
       0: {
         items: 2,
         nav: true,
       },
       600: {
         items: 3,
         nav: false,
       },
       1000: {
         items: 4,
         nav: true,
         loop: false,
       },
     },
   })
   .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs.find(".owl-item.active").first().index();
    var end = thumbs.find(".owl-item.active").last().index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});










$('.sub-menu ul').hide();
$(".sub-menu a").click(function () {
  $(this).parent(".sub-menu").children("ul").slideToggle("100");
  $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});