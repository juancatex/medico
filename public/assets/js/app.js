$(document).ready(function ($) {
    var $wrapper = $('.main-wrapper');
    var $pageWrapper = $('.page-wrapper');
    var $slimScrolls = $('.slimscroll');
    var $sidebarOverlay = $('.sidebar-overlay');
   

  

    function sidebar_overlay($target) {
        if ($target.length) {
            $target.toggleClass('opened');
            $sidebarOverlay.toggleClass('opened');
            $('html').toggleClass('menu-opened');
            $sidebarOverlay.attr('data-reff', '#' + $target[0].id);
        }
    }
    $(document).on('click', '#mobile_btn', function () {
        var $target = $($(this).attr('href'));
        sidebar_overlay($target);
        $wrapper.toggleClass('slide-nav');
        $('#chat_sidebar').removeClass('opened');
        return false;
    });
    $(document).on('click', '#task_chat', function () {
        var $target = $($(this).attr('href'));
        console.log($target);
        sidebar_overlay($target);
        return false;
    });
    $sidebarOverlay.on('click', function () {
        var $target = $($(this).attr('data-reff'));
        if ($target.length) {
            $target.removeClass('opened');
            $('html').removeClass('menu-opened');
            $(this).removeClass('opened');
            $wrapper.removeClass('slide-nav');
        }
        return false;
    });
 
    
   
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }
    if ($('.floating').length > 0) {
        $('.floating').on('focus blur', function (e) {
            $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    }
  
    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: '7px',
            color: '#ccc',
            wheelStep: 10,
            touchScrollStep: 100
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $('.sidebar .slimScrollDiv').height(wHeight);
        $(window).resize(function () {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $('.sidebar .slimScrollDiv').height(rHeight);
        });
    }
    var pHeight = $(window).height();
    $pageWrapper.css('min-height', pHeight);
    $(window).resize(function () {
        var prHeight = $(window).height();
        $pageWrapper.css('min-height', prHeight);
    });
    
    if ($('.center').length > 0) {
        $('.center').slick({
            centerMode: true,
            arrows: false,
            centerPadding: '30px',
            slidesToShow: 3,
            responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            }]
        });
    }
    
    if ($('.dash-count .counter-up').length > 0) {
        $('.dash-count .counter-up').counterUp({
            delay: 15,
            time: 1500
        });
    }
   
    if (screen.width >= 992) {
        $(document).on('click', '#toggle_btn', function () {
            if ($('body').hasClass('mini-sidebar')) {
                $('body').removeClass('mini-sidebar');
                $('.subdrop + ul').slideDown();
            } else {
                $('body').addClass('mini-sidebar');
                $('.subdrop + ul').slideUp();
            }
            return false;
        });
        $(document).on('mouseover', function (e) {
            e.stopPropagation();
            if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
                var targ = $(e.target).closest('.sidebar').length;
                if (targ) {
                    $('body').addClass('expand-menu');
                    $('.subdrop + ul').slideDown();
                } else {
                    $('body').removeClass('expand-menu');
                    $('.subdrop + ul').slideUp();
                }
                return false;
            }
        });
    }
    
     
});
