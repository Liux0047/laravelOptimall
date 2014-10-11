<script type="text/javascript">
    //change the small img on click of color icon
    var colorIconHoverFunc = function() {
        var modelId = $(this).attr("data-model-id");
        var productId = $(this).attr("data-product-id");
        var imgHolder = $(this).parent().parent().parent().find(".small-view-link");
        imgHolder.find("img").remove();
        imgHolder.append(
            "<img src='{{ asset('images/preloader.gif') }}' data-original='{{ asset('images/gallery') }}/" + modelId + "/" + productId +
            "/{{ Config::get('optimall.smallViewImg') }}'>"
        );
        renderRetinaImg(imgHolder.find("img"));
        imgHolder.find("img").lazyload();

        $(".color-icon-link").removeClass("color-icon-active");
        $(this).addClass("color-icon-active");
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