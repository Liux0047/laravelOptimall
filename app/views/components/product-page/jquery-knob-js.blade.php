<script type="text/javascript">
$('#overall_rating.knob').knob({
    min: 0,
    max: 100,
    step: 1,
    thickness: 0.25,
    width: 100,
    height: 100,
    fgColor: "#df6c4f",
    readOnly: true
});
$('#design_rating.knob').knob({
    min: 0,
    max: 100,
    step: 1,
    thickness: 0.2,
    width: 75,
    height: 75,
    fgColor: "#ecd06f",
    readOnly: true
});
$('#comfort_rating.knob').knob({
    min: 0,
    max: 100,
    step: 1,
    thickness: 0.2,
    width: 75,
    height: 75,
    fgColor: "#3c948b",
    readOnly: true
});
$('#quality_rating.knob').knob({
    min: 0,
    max: 100,
    step: 1,
    thickness: 0.2,
    width: 75,
    height: 75,
    fgColor: "#1a99aa",
    readOnly: true
});

//temp ratings
var currentOverllRating = 0;
var currentQualityRating = 0;
var currentDesignRating = 0;
var currentComfortRating = 0;
//final ratings
var endOverllRating = ({{ ($model->average_design_rating + $model->average_comfort_rating + $model->average_quality_rating) / 3 }})*20;
var endQualityRating = ({{ $model->average_quality_rating or 0 }})*20;
var endDesignRating = ({{ $model->average_design_rating or 0 }})*20;
var endComfortRating = ({{ $model->average_comfort_rating or 0 }})*20;

var refreshIntervalId;
$('#user_review_tab[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    refreshIntervalId = setInterval(incrementRating, 20);
});



function incrementRating(){
    if (currentOverllRating < endOverllRating){
        currentOverllRating += endOverllRating/100;
        $('#overall_rating.knob').val(currentOverllRating).trigger('change');
    }
    else {                    
        endIncrementRating();
    }
    if (currentQualityRating < endQualityRating){
        currentQualityRating += endQualityRating/100;
        $('#quality_rating.knob').val(currentQualityRating).trigger('change');
    }
    else {
        endIncrementRating();
    }
    if (currentDesignRating < endDesignRating){
        currentDesignRating += endDesignRating/100;
        $('#design_rating.knob').val(currentDesignRating).trigger('change');
    }
    else {
        endIncrementRating();
    }
    if (currentComfortRating < endComfortRating){
        currentComfortRating += endComfortRating/100;
        $('#comfort_rating.knob').val(currentComfortRating).trigger('change');
    }
    else {
        endIncrementRating();
    }
}

function endIncrementRating (){                
    clearInterval(refreshIntervalId);                
    $('#overall_rating.knob').val(endOverllRating).trigger('change');
    $('#quality_rating.knob').val(endQualityRating).trigger('change');
    $('#design_rating.knob').val(endDesignRating).trigger('change');
    $('#comfort_rating.knob').val(endComfortRating).trigger('change');                
}


</script>