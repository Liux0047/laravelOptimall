@extends ('layouts.admin-base')

@section ('content')
    <div class="container content-container content-no-header">
        <div class="page-header">
            @include('components.page-frame.message-bar')
            <h1>
                {{ $pageTitle }}
            </h1>
        </div>

        {{ Form::open(array('action'=>'AdminFunctionController@postNewCoupon', 'onsubmit'=>'return confirmSubmit();')) }}
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" name="coupon_code" value="{{ $couponCode }}">
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="text" class="form-control" name="expiry_date" value="{{ $expiryDate }}">
        </div>
        <label for="discount_type">Discount Type</label>
        <select class="form-control" name="discount_type">
            <option value="2">Percentage off</option>
            <option value="1">Amount off</option>
        </select>
        <br>

        <div class="form-group">
            <label for="discount_value">Discount Value</label>
            <input type="text" class="form-control" name="discount_value">
        </div>
        <label for="discount_type">Coupon Rules</label>
        <select class="form-control" name="coupon_rule">
            @foreach($discountRules as $key => $discountRule)
            <option value="{{ $key }}">{{ $discountRule }}</option>
            @endforeach
        </select>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close() }}
        <br>

        <p>
            Suggested Codes:
            {{ $suggestedStr }}
        </p>

    </div>
@stop

@section('script')
    @parent
    <script type="text/javascript">
        function confirmSubmit() {
            return confirm('确认添加优惠券?');
        }


    </script>
@stop