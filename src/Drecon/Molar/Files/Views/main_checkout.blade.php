@if(isset($moip_return_checkout))
	@include('molar.checkout')
@else
	@include('molar.infos')
@endif