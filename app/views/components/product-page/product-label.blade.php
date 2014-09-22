@if ($productLabelId == 0 || $productLabelId == 1)
<span class='label label-lg label-danger'>促销</span> 
@elseif ($productLabelId == 2)
<span class='label label-lg label-warning'>热卖</span> 
@elseif ($productLabelId == 3)
<span class='label label-lg label-success'>新品</span> 
@elseif ($productLabelId == 4)
<span class='label label-lg label-info'>推荐</span> 
@elseif ($productLabelId == 5)
<span class='label label-lg label-primary'>经典</span> 
@endif