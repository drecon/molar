@if(isset($moip_return_checkout))
	@include('moip.checkout')
@else
	@include('moip.infos')
@endif