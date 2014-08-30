<script type="text/javascript">
    //change the small img on click of color icon
    function changeSmallImg(modelId, prodcutId) {
    	$("#small-view-" + modelId + " img").remove();
    	$("#small-view-" + modelId).append(
    		"<img src='{{ asset('images/gallery') }}/" + modelId + "/" + prodcutId + "/medium-view-3.jpg'>");
    }

    var colorIconClickFunc = function() {
        $(".color-icon-link").removeClass("color-icon-clicked");
        $(this).addClass("color-icon-clicked");
    }
    $(".color-icon-link").click(colorIconClickFunc);
    
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
    $(document).ready(function() {
    	ratyInit();
    });
</script>