//prevent dropdown collapse accidentally closed
$(function () {
    window.prettyPrint && prettyPrint();
    $(document).on('click', '.yamm .dropdown-menu', function (e) {
        e.stopPropagation();
    });
});

/*
 * retina image support
 * http://www.sitepoint.com/css-techniques-for-retina-displays/
 */
var isRetina = (
window.devicePixelRatio > 1 ||
(window.matchMedia && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5),(-moz-min-device-pixel-ratio: 1.5),(min-device-pixel-ratio: 1.5)").matches)
);
if (isRetina) {
    var images = $('img.retina-alt.lazy');
    images.each(function (i) {
        var lowres = $(this).attr('data-original');
        var highres = replaceRetinaImg(lowres);
        $(this).attr('data-original', highres);
    });
}
function renderRetinaImg(element) {
    if (isRetina) {
        var lowres = $(element).attr('data-original');
        var highres = replaceRetinaImg(lowres);
        $(element).attr('data-original', highres);
    }
}
function replaceRetinaImg(lowresPath) {
    var suffix = lowresPath.substring(lowresPath.lastIndexOf('.'));
    var prefix = lowresPath.substring(0, lowresPath.lastIndexOf('.'));
    return prefix + "@2x" + suffix;
}


/*
 * Modal modification to vertical align center
 * http://codepen.io/anon/pen/LeBlm
 */
function adjustModalMaxHeightAndPosition() {
    $('.modal').each(function () {
        if (!$(this).hasClass('in')) {
            $(this).show();
        }
        ;
        var contentHeight = $(window).height() - 60;
        var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
        var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;

        $(this).find('.modal-content').css({
            'max-height': function () {
                return contentHeight;
            }
        });

        $(this).find('.modal-body').css({
            'max-height': function () {
                return (contentHeight - (headerHeight + footerHeight));
            }
        });

        $(this).find('.modal-dialog').css({
            'margin-top': function () {
                return -($(this).outerHeight() / 2);
            },
            'margin-left': function () {
                return -($(this).outerWidth() / 2);
            }
        });
        if (!$(this).hasClass('in')) {
            $(this).hide();
        }
        ;
    });
}
;
$(document).ready(function () {
    adjustModalMaxHeightAndPosition();
});
$(window).resize(adjustModalMaxHeightAndPosition).trigger("resize");

/*
 * This code will prevent unexpected menu close when using some components (like accordion, forms, etc)
 */
$(document).on('click', '.yamm .dropdown-menu', function (e) {
    e.stopPropagation();
});


//auto calculate the top banner height
$('.navbar').affix({
    offset: {
        top: $('.top-banner').height()
    }
});

// float box toggle function
function toggleFloatBox() {
    if ($("#float_box").hasClass("float-box-shown")) {
        $("#float_box").removeClass("float-box-shown");
        $("#float_box").addClass("float-box-hidden");
    } else {
        $("#float_box").removeClass("float-box-hidden");
        $("#float_box").addClass("float-box-shown");
    }
}


//trigger a fake scroll to lazy load image
$(document).ready(function () {

    $('.nav-tabs li a').on('shown.bs.tab', function (e) {
        $(window).trigger("scroll");
    });

    //enable dropdown on hover
    //also add hovered class to hovered dropdown menu
    $('.navbar .dropdown-hover').hover(function () {
        $(this).addClass("open");
        $(this).find('.dropdown-menu').stop(true, true).hide().delay(150).slideDown(200);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(0).slideUp(1);
        $(this).removeClass("open");
    });


    //lazy load fade in effect
    $("img.lazy").lazyload({
        effect: "fadeIn",
        effectspeed: 600,
        failure_limit: 15
    });

    //trigger a scroll to enable lazyload
    $('body,html').scroll();

});
 