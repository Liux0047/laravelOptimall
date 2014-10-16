<p>
    物流公司：{{{ $company }}}
</p>
<p>
    快递单号：{{{ $trackingNumber }}}
</p>
<p>
    单号状态：{{{ $status }}}
</p>

@if (count($shippingRoutes))
<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th>时间</th>
            <th>到达地点</th>
        </tr>
    </thead>

    <tbody>
        @foreach($shippingRoutes as $shippingRoute)
        <tr>
            <td>{{{ $shippingRoute->time }}}</td>
            <td>{{{ $shippingRoute->content }}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif