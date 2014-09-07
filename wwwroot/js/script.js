//prevent dropdown collapse accidentally closed
$(function() {
    window.prettyPrint && prettyPrint();
    $(document).on('click', '.yamm .dropdown-menu', function(e) {
        e.stopPropagation();
    });
});
//enable dropdown
$(document).ready(function() {
    //enable dropdown on hover
    //also add hovered class to hovered dropdown menu
    $('.navbar .dropdown-hover').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(150).slideDown(200);
        $(this).addClass("open");
        //$('.dropdown').removeClass("open");
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(0).slideUp(1);
        $(this).removeClass("open");
    });

    //enable lazy load
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
});

/*
 * Modal modification to vertical align center
 * http://codepen.io/anon/pen/LeBlm
 */
function adjustModalMaxHeightAndPosition() {
    $('.modal').each(function() {
        if ($(this).hasClass('in') == false) {
            $(this).show();
        }
        ;
        var contentHeight = $(window).height() - 60;
        var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
        var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;

        $(this).find('.modal-content').css({
            'max-height': function() {
                return contentHeight;
            }
        });

        $(this).find('.modal-body').css({
            'max-height': function() {
                return (contentHeight - (headerHeight + footerHeight));
            }
        });

        $(this).find('.modal-dialog').css({
            'margin-top': function() {
                return -($(this).outerHeight() / 2);
            },
            'margin-left': function() {
                return -($(this).outerWidth() / 2);
            }
        });
        if ($(this).hasClass('in') == false) {
            $(this).hide();
        }
        ;
    });
}
;
$(window).resize(adjustModalMaxHeightAndPosition).trigger("resize");

/*
 * This code will prevent unexpected menu close when using some components (like accordion, forms, etc)
 */
$(document).on('click', '.yamm .dropdown-menu', function(e) {
    e.stopPropagation()
})


//auto calculate the top banner height
$('.navbar').affix({
    offset: {
        top: $('.top-banner').height()
    }
});

//lazy load fade in effect
$("img.lazy").lazyload({
    effect: "fadeIn",
    effectspeed: 600,
    failure_limit: 15
});
//trigger a fake scroll to lazy load image
$(document).ready(function() {
    $('body,html').scroll();

    $('.nav-tabs li a').on('shown.bs.tab', function(e) {
        $(window).trigger("scroll");
    });
})


//baidu analytics
/*
 var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
 document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F97599e376911217c874380e476e60e0c' type='text/javascript'%3E%3C/script%3E"));
 */