<script type="text/javascript">
    //change the small img on click of color icon
    var colorIconHoverFunc = function() {
        var modelId = $(this).attr("data-model-id");
        var productId = $(this).attr("data-product-id");
        $(this).parent().parent().parent().find(".small-view-link img").remove();
        $(this).parent().parent().parent().find(".small-view-link").append(
            "<img src='{{ asset('images/gallery') }}/" + modelId + "/" + productId +
            "/{{ Config::get('optimall.smallViewImg') }}'>"
        );
        renderRetinaImg($(this).parent().parent().parent().find(".small-view-link img"));

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