
  (function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");
    });

    $(document).ready(function () { 

        $(".toggle-button").click( function (){
            $(this).parent().toggleClass("menu-collapsed");
        });       

        /*-- resize parallax size --*/
        $('ul#filter li a').click(function(e) {              
           $(window).trigger('resize.px.parallax');
        });       

        /*-- tooltip --*/
        $('[data-toggle="tooltip"]').tooltip();

        /*-- Button Up --*/
        var btnUp = $('<div/>', { 'class': 'btntoTop' });
        btnUp.appendTo('body');
        $(document).on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });

        /*-- Site title --*/
        if( $('a').hasClass('custom-logo-link') && $('a.custom-logo-link img').attr('src') != ''){
            $('h1.site-title').css({'display': 'none'});
        }
        else{
            $('h1.site-title').css({'display': 'block'});   
        }

        /*-- Mobile menu --*/
        if($('#elvinaa-main-menu-wrapper').length) {
            $('#elvinaa-main-menu-wrapper .nav li.dropdown').append(function () {
              return '<i class="fa fa-angle-down" aria-hidden="true"></i>';
            });
            $('#elvinaa-main-menu-wrapper .nav li.dropdown .fa').on('click', function () {
              $(this).parent('li').children('ul').slideToggle();
            });
        }

        /*-- Window scroll function --*/
        $(window).on('scroll', function () {
          /* sticky header */        
            var sticky = $('header'),
            scroll = $(window).scrollTop();            
            if (scroll > 250) {
                $('.loader-wrapper').after('<div class="header-outer"></div>');
                $('.header-outer').filter(function() {
                    return this.textContent === '';
                }).slice(0, -1).remove();
                $('.header-outer').css({'margin-top': '250px'}); 
                sticky.addClass('fixed');   
            }
            else {               
                $('.header-outer').remove();
                sticky.removeClass('fixed');
                
            }
        });

        /*-- Slider --*/
        $('.slider').flexslider({
            animation: "fade",
            slideshow: true,
            directionNav: true,
            controlNav: true,
            animationSpeed: 1500,
            prevText: "<i class='fa fa-angle-left'>",
            nextText: "<i class='fa fa-angle-right'>"

        });
        $('.slider .slides li').css('height', $(window).height());
    });    

})(this.jQuery);