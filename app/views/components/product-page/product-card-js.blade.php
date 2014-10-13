<script type="text/javascript">
    //change the small img on click of color icon
    var colorIconHoverFunc = function() {
        if (!$(this).hasClass("color-icon-active")) {
            var modelId = $(this).attr("data-model-id");
            var productId = $(this).attr("data-product-id");

            //get the img holder, <a> tag
            var imgHolder = $(this).parent().parent().parent().find(".small-view-link");

            imgHolder.fadeOut(400, function () {

                // replace with the new image
                imgHolder.find("img").remove();
                imgHolder.append(
                    "<img src='{{ asset('images/preloader.gif') }}' data-original='{{ asset('images/gallery') }}/" + modelId + "/" + productId +
                    "/{{ Config::get('optimall.smallViewImg') }}'>"
                );

                //render retina support and init lazyload
                renderRetinaImg($(this).find("img"));
                $(this).find("img").lazyload();


                //fadeIn animation to prevent preloader showing even if img has been loaded
                $(this).fadeIn( {
                    duration: 400,
                    start: function () {
                        $(window).trigger("scroll");
                    }
                });
            });

            $(".color-icon-link").removeClass("color-icon-active");
            $(this).addClass("color-icon-active");

        }


    };


    var ratyInit = function () {
        $('.raty-star').raty({
            path: "{{ asset('plugins/raty-2.7.0/images') }}",
            readOnly: true,
            halfShow: true,
            scoreName: "",
            score: function() {
                return $(this).attr('data-score');
            }
        });
    }

    function productCardInit () {
        $(".shop-item-details .color-icon-link").mouseover(colorIconHoverFunc);
        ratyInit();
    }

    $(document).ready(function() {
    	productCardInit();
    });

    $(".wide-home-display").hover(function(){
        $(this).find(".card-salient").addClass("lift-up-full");
        $(this).find(".card-hidden").addClass("lift-up-full");
        $(window).scroll();
    }, function(){
        $(this).find(".card-salient").removeClass("lift-up-full");
        $(this).find(".card-hidden").removeClass("lift-up-full");
    });
    </script>