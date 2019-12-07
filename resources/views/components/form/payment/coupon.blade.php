	<span class="text-teal mr-1"><strong>Tem um coupon de desconto?</strong></span>
	<input type="text" name="coupon" placeholder="COUPON" class="text-uppercase mr-2" id="coupon" style="border: 0;
    border-bottom: 1px solid lightgrey;
    background: transparent;">
    <button class="btn btn-xs btn-teal" id="validate-coupon" data-url="{{route('coupons.validate')}}">Validar coupon</button>
	<div class="valid-feedback"></div>
	<div class="invalid-feedback"></div>